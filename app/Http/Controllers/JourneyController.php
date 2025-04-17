<?php

namespace App\Http\Controllers;

use App\Events\GeoInformation;
use App\Models\Content;
use App\Models\Journey;
use App\Services\GeoService;
use App\Services\MediaLibrary\CustomPathGenerator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Exceptions\MediaCannotBeDeleted;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class JourneyController extends BaseController
{
    protected GeoService $geoService;

    public function __construct(GeoService $geoService)
    {
        parent::__construct();
        $this->geoService = $geoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Application|Factory|View
    {
        $jobsInProcess = DB::table('jobs')->count() + DB::table('failed_jobs')->count();
        $journeys = Journey::latest()->paginate(10);
        $countGeo = [];
        foreach ($journeys as $journey) {
            $countGeo[$journey->id] = Media::where('model_id', $journey->id)
                ->where('model_type', 'App\Models\Journey')
                ->whereJsonLength('custom_properties', 0)
                ->count();
        }

        return view('/admin/journey.index', compact('journeys', 'jobsInProcess', 'countGeo'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function journeys(): View|Factory|\Illuminate\Foundation\Application
    {
        $contents = Content::with('category')
            ->where('single', true)
            ->where('active', true)
            ->orderByDesc(
                'created_at'
            )->simplePaginate(3);
        return view('freudefoto/home', [
            'contents' => $contents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin/journey.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //https://laraveldaily.com/post/multiple-file-upload-with-dropzone-js-and-laravel-medialibrary-package
        $validated = $request->validate([
            'name_of_route' => 'required|string|max:255|unique:journeys',
        ]);
        $request->merge(['active' => $request->has('active')]);
        $request->merge(['user_id' => Auth::user()->id]);
        $journey = Journey::create($request->all());
        try {
            $this->saveToStorage($request, $journey);
//            event(new GeoInformation($journey));
        } catch (FileDoesNotExist|FileIsTooBig $e) {
            Log::error($e->getMessage());
        }

        return redirect()->route('dispatcher.index')
            ->with('success', 'Journey created successfully.');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws FileException
     */
    public function storeMedia(Request $request): JsonResponse
    {
        $path = storage_path(env('STORAGE_PATH')) . '/' . Auth::user()->id . '/';
        CustomPathGenerator::createPath($path);
        $file = $request->file('file');
        $file->move($path, $file->getClientOriginalName());
        return response()->json([
            'name' => $file->getClientOriginalName(),
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Journey $journey
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->merge(['active' => $request->has('active')]);
        $validated = $request->validate([
            'name_of_route' => 'required|string|max:255',
            'id' => 'required|integer',
            'start_date' => 'required|date',
            'active' => 'nullable|boolean',
            'description' => 'nullable|string',
        ]);
        $journey = Journey::findBySlug($id);
        $journey->update($validated);

        try {
            $this->saveToStorage($request, $journey);
        } catch (FileDoesNotExist|FileIsTooBig $e) {
            Log::error($e->getMessage());
        }
        $jobs = DB::table('jobs');
        if ($jobs->count()) {
            return redirect('/dispatcher/index');
        }
        return redirect()->route('journey.index')
            ->with('success', 'Journey updated successfully');
    }


    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    protected function saveToStorage(Request $request, Journey $journeyModel): void
    {
        foreach ($request->input('images', []) as $file) {
            if (empty($file)) {
                continue;
            }
            $this->saveMediaFile($journeyModel, $file, 'images');
        }
        foreach ($request->input('gpx', []) as $file) {
            if (empty($file)) {
                continue;
            }
            $this->saveMediaFile($journeyModel, $file, 'gpx');
        }
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    private function saveMediaFile(Journey $journeyModel, string $file, string $mediaType): void
    {
        $journeyModel
            ->addMedia(storage_path(env('STORAGE_PATH') . Auth::user()->id . '/' . $file))
            ->toMediaCollection($mediaType);
    }

    /**
     * @param string $journey
     * @return Factory|View|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function show(string $slug): Factory|\Illuminate\Foundation\Application|View|Redirector|RedirectResponse
    {
//        try {
//            $journeyModel = Journey::findBySlug((string)$slug);
//            $journey = $journeyModel->where('active', true)->firstOrFail();
//
//        } catch (ErrorException $e) {
//            Log::debug($e->getMessage());
//            return redirect('/', 303);
//        }
        $journey = Journey::where('slug', $slug)->where('active', true)->first();

        $path = $url = '';
        $media = [];
//        if ($journey->hasMedia('gpx') || $journey->hasMedia('images')) {
//            if($journey->hasMedia('images')) {
//                $media = $journey->getMedia('images');
//            }
//            elseif($journey->hasMedia('gpx')) {
//                $media = $journey->getMedia('gpx');
//
//            }
//            if(count($media) > 0) {
//                $urlMedia = $media[0]->getUrl();
//                $url = Str::beforeLast($urlMedia, '/');
//                $path = pathinfo($media[0]->getPath(), PATHINFO_DIRNAME);
//            }
//        }

        return view('freudefoto.journey.show', compact('journey', 'url', 'path'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Journey $journey
     * @return Application|Factory|View
     */
    public function edit(Journey $journey): Factory|View|Application
    {

        $mediaGpx = $mediaImages = [];
        $path = $url = '';
        if ($journey->hasMedia('gpx') || $journey->hasMedia('images')) {
            $mediaGpx = $journey->getMedia('gpx')->sortBy('order_column');
            $mediaImages = $journey->getMedia('images')->sortBy('order_column');
            if (count($mediaGpx) > 0) {
                $urlMedia = $mediaGpx[0]->getUrl();
                $url = Str::beforeLast($urlMedia, '/');
                $path = pathinfo($mediaGpx[0]->getPath(), PATHINFO_DIRNAME);
            }
        }
        return view('/admin/journey.edit', compact('journey', 'mediaGpx', 'mediaImages', 'url', 'path'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Journey $journey
     * @return RedirectResponse
     */
    public function destroy(Journey $journey): RedirectResponse
    {
        $journey->delete();

        return redirect()->route('journey.index')->with('success', 'Journey deleted successfully');
    }

    public function updateMedia(Request $request): JsonResponse
    {
        Media::setNewOrder($request['order']);
        $journey = Journey::findBySlug($request['slug']);
        if ($journey) {
            GeoInformation::dispatch($journey);
            return response()->json([
                'success' => false,
            ]);
        }
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * @throws MediaCannotBeDeleted
     */
    public function deleteMedia(Request $request, $id): JsonResponse
    {
        $journey = Journey::findBySlug($request['slug']);
        $mediaItems = $journey->getMedia($request['type']);
        foreach ($mediaItems as $mediaItem) {
            if ($mediaItem->id === (int)$id) {
                Storage::deleteDirectory($mediaItem->getPath());

                Storage::delete($mediaItem->file_name);
            }
        }
        Media::where('id', $id)->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    public function upload(Request $request): JsonResponse
    {
        $fileName = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('uploads', $fileName, 'public');
        $response = [
            'success' => true,
            'file' => (object)[
                'url' => '/storage/' . $path,
            ]
        ];
        return response()->json($response);
    }

    public function uploadXXX(Request $request): JsonResponse
    {
        $images = $request->file('file');

        foreach ($images as $index => $image) {
            $path = $image->store('images', 'public');
            Media::create([
                'model_type' => 'App\Models\Journey',
                'model_id' => 1,
                'disk' => 'public',
                'collection_name' => 'images',
                'size' => 500,
                'manipulations' => '[]',
                'generated_conversions' => '[]',
                'custom_properties' => '[]',
                'responsive_images' => '[]',
                'name' => $image,
                'file_name' => $path,
                'order_column' => $index + 1,
            ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Display uploaded images
     */
    public function preview()
    {
        $images = Media::orderBy('order_column', 'asc')->get();
        return response()->json($images);
    }
}

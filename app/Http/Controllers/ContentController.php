<?php

namespace App\Http\Controllers;

use App\Enums\Websites;
use App\Models\Category;
use App\Models\Content;
use App\Models\Tag;
use App\Services\ImageService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ContentController extends BaseController
{
    public function index(): View|Factory|Application
    {
        $contents = Content::with('category')->get();
        return view('admin/content.index', [
            'contents' => $contents
        ]);
    }

    public function create(): View|Factory|Application
    {
        $websites = Websites::cases();
        $contentWebsite = env('APP_BASE_DOMAIN');
        $categories = Category::get()->pluck('name', 'id');
        $contentCategory = $categories->get(0);
        return view(
            'admin/content.createOrUpdate',
            compact('categories', 'websites', 'contentWebsite', 'contentCategory')
        );
    }

    public function store(Request $request): RedirectResponse
    {
        $slug = Str::slug($request->header);
        $request->merge(['slug' => $slug]);
        $request->merge(['active' => $request->has('active')]);
        $request->merge(['single' => $request->has('single')]);

        $content = Content::create($request->all());
        $tags = $this->createTags($request->input('tags'));
        $this->saveToStorage($request, $content);
        if ($tags) {
            $content->tags()->sync($tags);
        }
        $jobs = DB::table('jobs');
        if ($jobs->count()) {
            return redirect('/dispatcher/index');
        }
        return redirect('contents');
    }

    public function edit($id): View
    {
        $content = Content::find($id);
        $categories = Category::get()->pluck('name', 'id');
        $websites = Websites::cases();
        $contentWebsite = $content->website;
        $contentCategory = $content->category_id;
        $tags = implode(', ', $content->tags()->pluck('name')->toArray());
        return view(
            'admin/content.createOrUpdate',
            compact('content', 'tags', 'categories', 'websites', 'contentWebsite', 'contentCategory')
        );
    }

    public function update(Request $request, $id): Application|Redirector|RedirectResponse
    {
        $tagsRequest = json_decode($request->input('tags'));
        $tags = [];
        foreach ($tagsRequest as $tag) {
            $tags[] = $tag->value;
        }
        $content = Content::find($id);
        request()->validate([
            'header' => ['required'],
            'date' => ['required'],
        ]);
        $tags = $this->createTags($tags);
        $request->merge(['active' => $request->has('active')]);
        $request->merge(['single' => $request->has('single')]);
        $content->update($request->all());
        $content->tags()->sync($tags);
        $this->saveToStorage($request, $content);
        $jobs = DB::table('jobs');
        if ($jobs->count()) {
            return redirect('/dispatcher/index');
        }
        return redirect('contents');
    }


    public function destroy(Content $content): Application|Redirector|RedirectResponse
    {
        $mediaItems = $content->getMedia('*');

        if ($mediaItems->isNotEmpty()) {
            foreach ($mediaItems as $mediaItem) {
                Log::debug('$mediaItem->getPath(thumb)');
                Log::debug($mediaItem->getPath('thumb'));
                File::delete($mediaItem->getPath('thumb'));
                File::delete($mediaItem->getPath('preview'));
                File::delete($mediaItem->getPath('square'));
                File::delete($mediaItem->getPath());
            }
        }
        if ($content->slug) {
            Storage::deleteDirectory('public/' . $content->slug);
        }
        Media::where('model_id', $content->id)->delete();
        $content->find($content->id)->tags()->detach();
        $content->delete();

        return redirect()->route('contents.index')->with('success', 'Content deleted successfully');
    }

    protected function saveToStorage($request, $content): void
    {
        foreach ($request->input('upload', []) as $file) {
            if (empty($file)) {
                continue;
            }
            $path = storage_path(env('STORAGE_PATH')) . Auth::user()->id . '/' . $file;
            if (File::mimeType($path) === 'image/jpeg') {
                $mediaItem = $content->addMedia($path)->toMediaCollection('images');
                $mediaItem->meta = $content->header;
                $mediaItem->headline = $content->header;
                $mediaItem->description = $content->text;
                $mediaItem->keywords = implode(', ', $content->tags()->pluck('name')->toArray());
                $mediaItem->website = $content->website;
                $mediaItems = $content->getMedia('images');
                $date = ImageService::parseData('T -createdate', $mediaItems[0]->getPath(), '');
                if($date === '-' || empty($date)) $date = Carbon::now();
                $mediaItem->date = $date;
                if ($mediaItem->headline == '') {
                    $mediaItem->headline = $content->header = ImageService::parseData(
                        'Headline',
                        $mediaItems[0]->getPath()
                    );
                    $mediaItem->meta = $content->metadescription = $content->header;
                }
                if ($content->text == '') {
                    $mediaItem->description = $content->text = ImageService::parseData(
                        'Description',
                        $mediaItems[0]->getPath()
                    );
                }
                if ($mediaItem->keywords === '') {
                    $mediaItem->keywords = ImageService::parseData('Keywords', $mediaItems[0]->getPath());
                    $tags = $this->createTags($mediaItem->keywords);
                    $content->tags()->sync($tags);
                }
            } else {
                $mediaItem = $content->addMedia($path)->toMediaCollection();
            }
            $content->save();
            $mediaItem->save();
        }
    }

    public function prepareTags($tags): array|\Illuminate\Support\Collection
    {
        if(is_array($tags)) return $tags;
        $replaced = Str::replace(' ', '#', $tags);
        $replaced = Str::replace(',', '#', $replaced);
        $explode = Str::of($replaced)->explode('#');
        return collect($explode)->filter();
    }

    /**
     * @param $tags
     * @return array
     */
    private function createTags($tags): array
    {
        $tagsArray = $this->prepareTags($tags);
        return collect($tagsArray)->map(function (string $tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        })->all();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function storeMedia(Request $request): JsonResponse
    {
        $file = $request->file('file');
        $path = storage_path(env('STORAGE_PATH')) . Auth::user()->id . '/';
        $file->move($path, $file->getClientOriginalName());
        if (File::exists($path)) {
            return response()->json([
                'error' => false,
                'success' => true,
                'name' => $file->getClientOriginalName(),
                'original_name' => $file->getClientOriginalName(),
            ]);
        }
        return response()->json([
            'error' => true,
            'message' => 'File upload error',
        ]);
    }

    public function download($id): BinaryFileResponse
    {
        $media = Media::findOrFail($id);
        return response()->download($media->getPath(), $media->file_name);
    }

    /**
     */
    public function deleteMedia(Request $request, $id): JsonResponse
    {
        $this->mediaToDelete($request['slug'], $id, $request['type']);
        return response()->json([
            'success' => true,
        ]);
    }

    protected function mediaToDelete($slug, $id, $type): void
    {
        if (empty($slug)) {
            return;
        }
        $content = Content::findBySlug($slug);
        if ($content) {
            $mediaItems = $content->getMedia($type);
            foreach ($mediaItems as $mediaItem) {
                if ($mediaItem->id === (int)$id) {
                    Log::debug('delete media:' . $mediaItem->id);
//                    File::delete($mediaItem->getPath('thumb'));
//                    File::delete($mediaItem->getPath('preview'));
//                    File::delete($mediaItem->getPath('square'));
//                    File::delete($mediaItem->getPath());
                }
            }
            Media::where('id', $id)->delete();
        }
    }
}

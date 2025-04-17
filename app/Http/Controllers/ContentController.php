<?php

namespace App\Http\Controllers;

use App\Enums\Websites;
use App\Models\Category;
use App\Models\Content;
use App\Services\StorageService;
use App\Services\TagService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
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
        $tags = TagService::createTags($request->input('tags'));
        StorageService::saveToStorage($request, $content);
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
        request()->validate([
            'header' => ['required'],
            'date' => ['required'],
        ]);
        $request->merge(['active' => $request->has('active')]);
        $request->merge(['single' => $request->has('single')]);
        $content = Content::find($id);
        $content->update($request->all());

        $tagsRequest = json_decode($request->input('tags'));
        $tags = [];
        if($tagsRequest) {
            foreach ($tagsRequest as $tag) {
                $tags[] = $tag->value;
            }
            $tags = TagService::createTags($tags);
            $content->tags()->sync($tags);
        }
        StorageService::saveToStorage($request, $content);
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
                File::delete($mediaItem->getPath(Config::get('conversions.journey.400x400')));
                File::delete($mediaItem->getPath(Config::get('conversions.journey.300x300')));
                File::delete($mediaItem->getPath(Config::get('conversions.journey.w300xh300')));
                File::delete($mediaItem->getPath(Config::get('conversions.journey.w600xh600')));
                File::delete($mediaItem->getPath(Config::get('conversions.journey.w800xh800')));
                File::delete($mediaItem->getPath(Config::get('conversions.journey.800x800')));
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
                    File::delete($mediaItem->getPath());
                }
            }
            Media::where('id', $id)->delete();
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use App\Models\Media;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;

class MediaController extends BaseController
{
    public function index(): View|Factory|Application
    {
        $categories = Category::whereHas('contents', function($q){
            $q->where('active', true)
                ->whereLike('contents.website', config('app.base_domain_path') . '%');

        })->orderBy('name')->get();

        return view(config('app.base_domain_path', env('APP_BASE_DOMAIN_NAME')) . '/media.index', compact('categories'));
    }

    public function streetphotoindex(): View|Factory|Application
    {
        $contents = Content::
            whereLike('website', config('app.base_domain_path') . '%')
            ->where('active', true)
            ->orderByDesc('date')
            ->get();

        $contentGrouped = $contents->groupBy(function ($item, $key) {
            return $item->created_at->format('m');
        });

        return view(config('app.base_domain_path', env('APP_BASE_DOMAIN_NAME')) . '/media.index', compact( 'contentGrouped'));
    }
    public function adminmedia(): View|Factory|Application
    {
        $contents = Content::with('category')
            ->where('single', false)
            ->where('active', true);
        $categories = Category::with('contents')->get();
        return view('admin/media.index', compact('categories'));
    }

    public function edit(): View|Factory|Application
    {
        $medias = Media::where('process', null)->latest()->simplePaginate(20);
        return view('media.edit', [
            'medias' => $medias,
            'urls' => [
                ['URL' => env('APP_BASE_DOMAIN_NAME'), 'name' => env('APP_BASE_DOMAIN_NAME')],
                ['URL' => env('APP_BERLINER_PHOTO_BLOG_DOMAIN_NAME'), 'name' => env('APP_BERLINER_PHOTO_BLOG_DOMAIN_NAME')],
                ['URL' => env('APP_STREET_PHOTO_BLOG_DOMAIN_NAME'), 'name' => env('APP_STREET_PHOTO_BLOG_DOMAIN_NAME')],
                ['URL' => env('APP_FREUDE_NOW_BLOG_DOMAIN_NAME'), 'name' => env('APP_FREUDE_NOW_BLOG_DOMAIN_NAME')],
            ]
        ]);
    }

    public function store(): RedirectResponse
    {
        $validated = request()->validate([
            'medias.*.id' => ['required', Rule::exists('medias', 'id')],
            'medias.*.headline' => ['required', 'string', 'min:3'],
            'medias.*.keywords' => ['required', 'string', 'min:0'],
            'medias.*.description' => ['required', 'string', 'min:0'],
            'medias.*.URL' => ['required'],
            'medias.*.process' => ['nullable'],
        ]);
        $input = Collection::make($validated['medias']);
        Media::query()->whereKey($input->pluck('id'))
            ->each(function (Media $media) use ($input) {
                $record = $input->firstWhere('id', $media->id) ?? [];
                $media->process =  isset($record['process']) ? 1 : null;
                $media->headline = $record['headline'] ?? null;
                $media->meta = $media->headline;
                $media->description = $record['description'] ?? null;
                $media->URL = $record['URL'] ?? null;
                $media->keywords = $record['keywords'] ?? null;

                $media->save();
            });

        return back()->with('success', 'updated!');
    }

    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:4096'
        ]);

        if ($request->hasFile('file')) {
            $imageName = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('uploads', $imageName, 'public');
            return response()->json(['location' => asset('storage/' . $path)]);
        }

        return response()->json(['error' => 'File upload failed.'], 422);
    }
}

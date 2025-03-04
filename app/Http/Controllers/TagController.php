<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagController extends BaseController
{
    public function tag($tagId)
    {
        if (is_numeric($tagId)) {
            $tag = Tag::find($tagId);
            if ($tag === null) {
                return redirect()->to('/')
                    ->with(
                        'message',
                        'The page you looked for was not found, but you might be interested in this.'
                    )->setStatusCode(308);
            }

            return redirect()->to('/tag/' . $tag->name)
                ->with(
                    'message',
                    'The page you looked for was not found, but you might be interested in this.'
                );
        }
        $tag = Tag::where('name', $tagId)->first();

        if ($tag === null) {
            $slug = request()->get('slug');
            if ($slug) {
                $similarPage = Content::where('slug', 'like', '%' . Str::slug(Str::words($slug, 1, '')) . '%')
                    ->first();
                if ($similarPage) {
                    return redirect()->to('/single/' . $similarPage->slug)
                        ->with(
                            'message',
                            'The page you looked for was not found, but you might be interested in this.'
                        )->setStatusCode(308);
                }
            }
            $input = request()->all();
            $tag = Tag::where('name', $input)->first();
            if ($tag) {
                return redirect()->to('/tag/' . $tag->name)
                    ->with(
                        'message',
                        'The page you looked for was not found, but you might be interested in this.'
                    );
            }
            return redirect()->to('/')
                ->with(
                    'message',
                    'The page you looked for was not found, but you might be interested in this.'
                )->setStatusCode(308);
        }

        $contents = $tag
            ->contents()
            ->with('category')
            ->whereDate('date', '<=', Carbon::now('Europe/Berlin'))
            ->orderBy('date', 'desc')
            ->where('active', true)
            ->simplePaginate(5);

        return view(
            config('app.base_domain_path', env('APP_BASE_DOMAIN_NAME')) . '/tags/index',
            compact('contents', 'tag')
        );
    }

    public function index()
    {
        $tags = json_encode(Tag::orderBy('name')->get());
        return view('admin/tag.update', compact('tags'));
    }

    public function update(Request $request, $tagId): JsonResponse
    {
        $tag = Tag::find($tagId);
        $request->validate(['name' => 'required|string|max:255']);
        $tag->update(['name' => $request->name]);

        return response()->json(['success' => true]);
    }

    public function display(): JsonResponse
    {
        return response()->json(Tag::orderBy('name')->get());
    }

    public function tags(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => Tag::select(DB::raw('name as value'))->get()
        ]);
    }
}

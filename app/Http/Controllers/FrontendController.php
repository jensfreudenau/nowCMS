<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;
use \Illuminate\Support\Facades\Request as RequestFacade;

class FrontendController extends BaseController
{
    public function index(Request $request): View
    {
        $contents = Content::with('category')
            ->where('single', false)
            ->where('active', true)
            ->whereDate('date', '<=', Carbon::now('Europe/Berlin'))
            ->whereLike('website', config('app.base_domain_path') . '%')
            ->orderByDesc('created_at')
            ->simplePaginate(config('app.blog_entries_per_page'));

        $heading = $meta = 'Reisen';
        if (config('app.base_domain_path') === '') {
            Log::error($request->fullUrl());
        }
        return view(
            config('app.base_domain_path', env('APP_BASE_DOMAIN_NAME')) . '/home',
            compact('contents', 'heading', 'meta')
        );
    }

    /**
     * @param Request $request
     * @param $slug
     * @return Factory|\Illuminate\Contracts\View\View|Application|RedirectResponse|Redirector
     */
    public function single(
        Request $request,
        $slug
    ): Factory|\Illuminate\Contracts\View\View|Application|RedirectResponse|Redirector {
        $queryString = $request->getQueryString();

        if (Str::contains($queryString, 'slug')) {
            $slug = Str::afterLast($queryString, '=');
            return redirect('/single/' . $slug, 303);
        }
        if (Str::contains($queryString, 'name')) {
            $name = Str::afterLast($queryString, '=');
            return redirect('/getCategory/' . $name, 303);
        }
        $content = Content::with('category')->where('slug', $slug)->first();
        if (empty($content)) {
            return redirect('/');
        }
        $tags = $content?->tags->pluck('name', 'id');
        return view(
            config('app.base_domain_path', env('APP_BASE_DOMAIN_NAME')) . '/single',
            compact('content', 'tags')
        );
    }


    public function search(Request $request): \Illuminate\Contracts\View\View|Factory|Application
    {
        $search = $request->input('search');
        $contents = Content::where('active', true)
            ->whereAny(
                [
                    'header',
                    'text',
                ],
                'like',
                "%$search%"
            )
            ->orderBy('date', 'desc')
            ->with('category')
            ->whereLike('website', config('app.base_domain_path') . '%')
            ->simplePaginate(config('app.blog_entries_per_page'));

        return view(config('app.base_domain_path', env('APP_BASE_DOMAIN_NAME')) . '/home', compact('contents'));
    }
}

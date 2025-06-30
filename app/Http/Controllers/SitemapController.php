<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $domain = Request::getHost();
        return response()->view('sitemaps/sitemap', [
            'domain' => $domain,
        ])->header('Content-Type', 'application/xml');
    }

    public function content(): Response
    {
        $contents = Content::canShow()->get();
        $domain = Request::getHost();
        return response()->view('sitemaps/sitemap-content', [
            'contents' => $contents,
            'domain' => $domain,
        ])->header('Content-Type', 'application/xml');
    }

    public function categories(): Response
    {
        $categories = Category::whereHas('contents', function ($q) {
            $q
                ->where('active', true)
                ->whereLike('contents.website', config('app.base_domain_path') . '%');
        })->orderBy('name')->get();
        $domain = Request::getHost();
        return response()->view('sitemaps/sitemap-categories', [
            'categories' => $categories,
            'domain' => Request::getHost(),
        ])->header('Content-Type', 'application/xml');
    }

    public function images(): Response
    {
        $contents = Content::canShow()->get();
        return response()->view('sitemaps/sitemap-images', [
            'contents' => $contents,
            'domain' => Request::getHost(),
        ])->header('Content-Type', 'application/xml');
    }
}

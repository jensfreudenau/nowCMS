<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use App\Models\Tag;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $contents = Content::active()->get();
        $domain = Request::getHost();
        return response()->view('sitemaps/sitemap', [
            'domain' => $domain,
        ])->header('Content-Type', 'text/xml');
    }
    public function content(): Response
    {
        $contents = Content::active()->get();
        $domain = Request::getHost();
        return response()->view('sitemaps/sitemap-content', [
            'contents' => $contents,
            'domain' => $domain,
        ])->header('Content-Type', 'text/xml');
    }
    public function categories(): Response
    {
        $categories = Category::whereHas('contents', function ($q) {
            $q->where('active', true)
                ->whereLike('contents.website', config('app.base_domain_path') . '%');
        })->orderBy('name')->get();
        $domain = Request::getHost();
        return response()->view('sitemaps/sitemap-categories', [
            'categories' => $categories,
            'domain' => $domain,
        ])->header('Content-Type', 'text/xml');
    }
    public function images(): Response
    {
        $categories = Category::whereHas('contents', function ($q) {
            $q->where('active', true)
                ->whereLike('contents.website', config('app.base_domain_path') . '%');
        })->orderBy('name')->get();
        return response()->view('sitemaps/sitemap-images', [
            'categories' => $categories,
            'domain' =>  Request::getHost(),
        ])->header('Content-Type', 'text/xml');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BerlinerPhotoblogController extends BaseController
{
    public function index()
    {
        $contents = Content::with('category')
            ->where('single', false)
            ->where('active', true)
            ->whereLike('website', Str::before( config('app.berliner_photo_blog_domain'), '.') . '%')
            ->orderByDesc('created_at')
            ->simplePaginate(5);

        return view('home', compact('contents'));
   }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    public function __construct()
    {
        $categories = Category::whereHas('contents', function ($query) {
            return $query->where('active', true)->whereLike('website', config('app.base_domain_path') . '%');
        })->get();
        // Sharing is caring
        View::share('categories', $categories);
    }
}

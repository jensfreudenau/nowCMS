<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __invoke(Request $request): Application|array|string|Translator|null
    {
        return __("general.hello_world");
    }
}

<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View as NamespaceView;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultSimpleView('pagination::simple-tailwind');
        $this->loadEnvironmentFromDomain();
//        Model::preventLazyLoading();
    }

    protected function loadEnvironmentFromDomain(): void
    {

        Config::set('app.blog_entries_per_page', env('BLOG_ENTRIES_PER_PAGE'));
        if (request()->getHost() == env('APP_BERLINER_PHOTO_BLOG_DOMAIN')) {
            Config::set('app.blog_entries_per_page', env('BERLINER_PHOTO_BLOG_ENTRIES_PER_PAGE'));
        }
        elseif(request()->getHost() == env('APP_STREET_PHOTO_BLOG_DOMAIN')) {
            Config::set('app.blog_entries_per_page', env('STREET_PHOTO_BLOG_ENTRIES_PER_PAGE'));
        }
        $domain = Request::getHost();
        Config::set('app.base_domain', $domain);
        $domain = Str::replace('blog.', 'blog_', $domain);
        Config::set('app.base_domain_path', Str::before($domain, '.'));
    }
}

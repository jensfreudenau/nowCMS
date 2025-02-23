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


        $domain = $this->getDomain(request()->getHost());
        if ($domain === false) {
            $domain = env('APP_BASE_DOMAIN');
        }
        Config::set('app.base_domain', $domain);
        Config::set('app.base_domain_path', Str::before($domain, '.'));
    }

    /**
     * @param $url
     * @return false|string
     */
    protected function getDomain($url): false|string
    {
        $pieces = parse_url($url);
        $domain = $pieces['host'] ?? $pieces['path'];
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{0,63}\.[a-z\.]{1,5})$/i', $domain, $regs)) {
            return $regs['domain'];
        }
        return false;
    }
}

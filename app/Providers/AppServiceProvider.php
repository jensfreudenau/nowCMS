<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultSimpleView('pagination::simple-tailwind');
        $domain = Request::getHost();
        if($domain === Config::get('domains.domain.freude_now_blog_domain')) {
            Paginator::defaultSimpleView('pagination::simple-blog_freude-now');

        }

        $this->loadEnvironmentFromDomain();
//        Model::preventLazyLoading();
    }

    protected function loadEnvironmentFromDomain(): void
    {
        $domain = Request::getHost();
        if (in_array($domain, Config::get('domains.domain'))) {
            Config::set('app.base_domain', $domain);
        }
        $this->setEntriesPerPage($domain);
        $this->setDomainPath($domain);
    }


    private function setEntriesPerPage($domain): void
    {
        if($domain === Config::get('domains.domain.freude_now_blog_domain')) {
            Config::set('app.blog_entries_per_page', Config::get('domains.entries.freude_now_blog_entries_per_page'));
        } elseif($domain === Config::get('domains.domain.berliner_photo_blog_domain')) {
            Config::set('app.blog_entries_per_page', Config::get('domains.entries.berliner_photo_blog_entries_per_page'));
        } elseif($domain === Config::get('domains.domain.freude_foto_domain')) {
            Config::set('app.blog_entries_per_page', Config::get('domains.entries.freude_foto_domain_entries_per_page'));
        } elseif($domain === Config::get('domains.domain.street_photo_blog_domain')) {
            Config::set('app.blog_entries_per_page', Config::get('domains.entries.street_photo_blog_entries_per_page'));
        } else {
            Config::set('app.blog_entries_per_page', env('BLOG_ENTRIES_PER_PAGE'));
        }
    }

    private function setDomainPath(false|string $host): void
    {
        $parts = explode('.', $host);
        $numParts = count($parts);
        if ($numParts >= 2) {
            $domainPart = $parts[$numParts - 2];
            Config::set('app.base_domain_path', Config::get('domains.path.' . $domainPart));
        } else {
            Config::set('app.base_domain_path', Config::get('domains.path.freudefoto'));
        }
    }
}

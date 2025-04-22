<!doctype html>
<html lang="en" class="h-full">
<head>
    @stack('meta_after')
    <x-feed-links/>
    <!-- Matomo -->
    <script>
        var _paq = window._paq = window._paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['disableCookies']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="https://www.freude-now.de/matomo/";
            _paq.push(['setTrackerUrl', u+'matomo.php']);
            _paq.push(['setSiteId', '5']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <!-- End Matomo Code -->
    @vite(['resources/css/app.css','resources/sass/app.scss', 'resources/js/app.js'])
    @include('feed::links')

</head>


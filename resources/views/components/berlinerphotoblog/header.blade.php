<!doctype html>
<html lang="en" class="h-full">
<head>
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
            _paq.push(['setSiteId', '4']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- End Matomo Code -->
    @vite(['resources/css/app.css','resources/sass/berlinerphotoblog.scss', 'resources/js/app.js'])
    <x-meta />
</head>


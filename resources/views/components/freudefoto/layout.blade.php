<x-freudefoto.header />
@stack('meta')
<body class="h-full bg-nord">
<div class="min-h-screen">
    <header class="black">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="font-thin text-7xl tracking-wide text-gray-300 left-0">
                <a href="/">{{config('domains.titles.freudefoto_title')}}</a>
            </h1>
        </div>
    </header>

    @stack('js')
    <main class=" text-white">
        <div class="mx-auto py-6 sm:px-6 lg:px-8 text-lg ">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 text-black ">
                <x-freudefoto.main-nav />
                {{ $slot }}
            </div>
        </div>
    </main>
    <x-freudefoto.footer />
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const toggleButton = document.getElementById('theme-toggle');
        const root = document.documentElement;

        // Theme aus localStorage laden
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            root.classList.add('dark');
        } else {
            root.classList.remove('dark');
        }

        toggleButton.addEventListener('click', () => {
            const isDark = root.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    });
    // JavaScript für das Hamburger Menü
    document.getElementById("menu-btn").addEventListener("click", function() {
        document.getElementById("mobile-menu").classList.toggle("hidden");
    });
</script>
@stack('js_after')
</body>
</html>

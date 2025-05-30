<x-blog_freude-now.header />

<x-slot:meta>Jens Freudenau's Blog</x-slot:meta>

<body class="justify-center mx-auto px-4 pt-8 flex flex-col md:flex-row font-mono text-sm font-normal antialiased sm:px-8 white text-nord-1 dark:bg-nord-1  dark:text-nord-7">
<div class="p-4 h-screen">
    <header class="mt-6">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <img class="mr-4 h-16 float-left" src="{{ URL::asset('images/jens_blog2.webp') }} " alt="Jens Freudenau's Blog">
            <div class="mt-2">
                <h1 class="text-lg font-bold"><a href="/" class="">{{config('domains.titles.freude_now_blog_title')}}</a></h1>
                    <x-blog_freude-now.main-nav />
            </div>
        </div>
    </header>
    <main class="p-7 dark:bg-nord-0  shadow-md">
        <div class="pb-5 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="space-y-4">
                <div class="flex-col md:flex-row ">{{ $slot }}</div>
            </div>
        </div>
    </main>
    <x-blog_freude-now.footer/>
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

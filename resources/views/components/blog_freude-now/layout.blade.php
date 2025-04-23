<x-blog_freude-now.header />

<x-slot:meta>Jens Freudenau's Blog</x-slot:meta>

<body class="justify-center mx-auto px-4 pt-8 flex flex-col md:flex-row font-mono text-sm font-normal antialiased sm:px-8">
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
    <main class="p-7">
        <button id="toggle-theme" class="px-4 py-2 bg-gray-200 dark:bg-gray-800 rounded hover:bg-gray-300 dark:hover:bg-gray-700">
            Theme wechseln
        </button>
        <div class="pb-5 mx-auto max-w-7xl sm:px-6 lg:px-8 shadow-md">
            <div class="space-y-4">
                <div class="flex-col md:flex-row ">{{ $slot }}</div>
            </div>
        </div>
    </main>
    <x-blog_freude-now.footer/>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const toggleButton = document.getElementById('toggle-theme');
        const root = document.documentElement;

        // Theme aus localStorage laden
        const savedTheme = localStorage.getItem('theme');
        console.log(savedTheme);
        if (savedTheme === 'dark') {
            root.classList.add('dark');
        } else {
            root.classList.remove('dark');
        }

        toggleButton.addEventListener('click', () => {
            console.log('click');
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

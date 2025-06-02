<x-berlinerphotoblog.header />
<x-slot:meta>{{config('domains.titles.berliner_photo_blog_title')}}</x-slot:meta>
<body class="h-full text-white">
<div class="min-h-screen ">
    <header class="bg-nord-5">
        <div class="mx-auto max-w-5xl px-4 py-6 sm:px-6 lg:px-1">
            <h1 class="font-thin text-7xl text-center text-black">
                <a href="/">{{config('domains.titles.berliner_photo_blog_title')}}</a>
            </h1>
        </div>
    </header>
    <x-berlinerphotoblog.main-nav />

    <main class="bg-nord-5">
        <div class="mx-auto max-w-7xl py-2 sm:px-6 lg:px-8 text-lg">
            <div class="space-y-4">
                <div class="flex flex-row">
                    <div class="basis-3/3">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-berlinerphotoblog.footer/>

</div>

<script>
    // document.addEventListener('DOMContentLoaded', () => {
    // const toggleButton = document.getElementById('theme-toggle');
    // const root = document.documentElement;
    // // Theme aus localStorage laden
    // const savedTheme = localStorage.getItem('theme');
    // if (savedTheme === 'dark') {
    //     root.classList.add('dark');
    // } else {
    //     root.classList.remove('dark');
    // }

    // toggleButton.addEventListener('click', () => {
    //     const isDark = root.classList.toggle('dark');
    //     localStorage.setItem('theme', isDark ? 'dark' : 'light');
    // });
    // });
    // Toggle mobile menu
    document.getElementById('menu-toggle').addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    // Toggle mobile dropdown
    document.getElementById('mobile-dropdown-toggle').addEventListener('click', () => {
        document.getElementById('mobile-dropdown-menu').classList.toggle('hidden');
    });
    document.getElementById('mobile-dropdown-toggle-journey').addEventListener('click', () => {
        document.getElementById('mobile-dropdown-menu-journey').classList.toggle('hidden');
    });
    // Toggle desktop dropdown
    const dropdownButton = document.getElementById('dropdown-button');
    const dropdownMenu = document.getElementById('dropdown-menu');
    dropdownButton.addEventListener('click', (e) => {
        e.preventDefault();
        dropdownMenu.classList.toggle('hidden');
    });
    // Toggle desktop dropdown
    const dropdownButtonJourney = document.getElementById('dropdown-button-journey');
    const dropdownMenuJourney = document.getElementById('dropdown-menu-journey');
    dropdownButtonJourney.addEventListener('click', (e) => {
        e.preventDefault();
        dropdownMenuJourney.classList.toggle('hidden');
    });

    // Optional: Close dropdown on outside click
    document.addEventListener('click', (e) => {
        if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
    // const mobileMenuButton = document.querySelector('button');
    // const mobileMenu = document.querySelector('.md\\:hidden ul');
    //
    // mobileMenuButton.addEventListener('click', () => {
    //     mobileMenu.classList.toggle('hidden');
    // });
    // JavaScript für das Hamburger Menü
    // document.getElementById("menu-btn").addEventListener("click", function() {
    //     document.getElementById("mobile-menu").classList.toggle("hidden");
    // });
</script>
@stack('js_after')
</body>
</html>

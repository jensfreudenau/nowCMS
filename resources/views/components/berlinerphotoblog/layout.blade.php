<x-berlinerphotoblog.header />
<x-slot:meta>{{config('domains.titles.berliner_photo_blog_title')}}</x-slot:meta>
<body class="h-full">
<div class="min-h-screen ">
    <header class="">
        <div class="mx-auto max-w-5xl px-4 py-6 sm:px-6 lg:px-1">
            <h1 class="font-thin text-7xl text-center ">
                <a href="/">{{config('domains.titles.berliner_photo_blog_title')}}</a>
            </h1>
        </div>
    </header>
    <x-berlinerphotoblog.main-nav />
    <main class="pt-10">
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
</script>
@stack('js_after')
</body>
</html>

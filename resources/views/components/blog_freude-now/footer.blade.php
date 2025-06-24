<footer class="sticky my-16 top-[100vh]">
    <div class="w-full mx-auto max-w-screen-xl pl-4 md:flex md:items-left md:justify-between">
        <span class="text-sm sm:text-left ">
            © {{\Carbon\Carbon::now()->format('Y')}}
            <a href="https://freude-now.de/" class="hover:underline">freude-now™</a>
            </span>
        <ul class="pr-9 flex flex-wrap items-center mt-3 text-sm font-medium sm:mt-0">
            <li class="grid gap-2 sm:grid-cols-[auto_1fr] sm:[&amp;_q]:col-start-1">
                <x-link  class="pl-3" target="_blank" href="https://github.com/jensfreudenau"><i class="fa-brands fa-github"></i></x-link>
            </li>
            <li class="grid gap-2 sm:grid-cols-[auto_1fr] sm:[&amp;_q]:col-start-1">
                <x-link  class="pl-3" href="https://berlinerphotoblog.de/">Berliner Photo Blog</x-link>
            </li>

            <li class="grid gap-2 sm:grid-cols-[auto_1fr] sm:[&amp;_q]:col-start-1">
                <x-link  class="pl-3" href="https://streetphotoberlin.com/">Street photos from Berlin</x-link>
            </li>
            <li class="grid gap-2 sm:grid-cols-[auto_1fr] sm:[&amp;_q]:col-start-1">
                <x-link  class="pl-3" href="https://freudefoto.de/">Jens' Reisefotos</x-link>
            </li>
            <li class="grid gap-2 sm:grid-cols-[auto_1fr] sm:[&amp;_q]:col-start-1">
                <x-link class="pl-3" href="https://freude-now.de/impressum.html">Impressum</x-link>
            </li>
        </ul>
    </div>
</footer>

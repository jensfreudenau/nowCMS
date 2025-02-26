<footer class="bg-white border border-gray-200 shadow-mdsticky top-[100vh]">
    <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-left md:justify-between">
        <span class="pl-9 text-sm sm:text-left ">
            © {{\Carbon\Carbon::now()->format('Y')}}
            <a href="https://freude-now.de/" class="hover:underline">freude-now™</a>
            </span>
        <ul class="pr-9 flex flex-wrap items-center mt-3 text-sm font-medium sm:mt-0">
            <li>
                <x-link href="#">About</x-link>
            </li>
            <li>
                <x-link href="https://berlinerphotoblog.de/">Berliner Photo Blog</x-link>
            </li>
            <li>
                <x-link href="https://freudefoto.de/">freude foto</x-link>
            </li>
            <li>
                <x-link href="https://blog.freude-now.de/">Jens Freudenau's Blog</x-link>
            </li>
            <li>
                <x-link href="https://freude-now.de/impressum.html">Impressum</x-link>
            </li>
        </ul>
    </div>
</footer>

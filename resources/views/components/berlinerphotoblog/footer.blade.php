<footer class="bg-gray-50 shadow sticky top-[100vh]">
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
                <x-link href="https://blog.freude-now.de/">Jens Freudenau's Blog</x-link>
            </li>
            <li>
                <x-link href="https://streetphotoberlin.com/">Street Photo Berlin</x-link>
            </li>
            <li>
                <x-link href="https://freudefoto.de/">Jens' Reisefotos</x-link>
            </li>
            <li>
                <x-link href="https://freude-now.de/impressum.html">Impressum</x-link>
            </li>
        </ul>
    </div>
</footer>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Select all dropdown toggle buttons
        const dropdownToggles = document.querySelectorAll(".dropdown-toggle")

        dropdownToggles.forEach((toggle) => {
            toggle.addEventListener("click", () => {
                // Find the next sibling element which is the dropdown menu
                const dropdownMenu = toggle.nextElementSibling

                // Toggle the 'hidden' class to show or hide the dropdown menu
                if (dropdownMenu.classList.contains("hidden")) {
                    // Hide any open dropdown menus before showing the new one
                    document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                        menu.classList.add("hidden")
                    })

                    dropdownMenu.classList.remove("hidden")
                } else {
                    dropdownMenu.classList.add("hidden")
                }
            })
        })

        // Clicking outside of an open dropdown menu closes it
        window.addEventListener("click", function (e) {
            if (!e.target.matches(".dropdown-toggle")) {
                document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                    if (!menu.contains(e.target)) {
                        menu.classList.add("hidden")
                    }
                })
            }
        })

        // Mobile menu toggle

        const mobileMenuButton = document.querySelector('.mobile-menu-button')
        const mobileMenu = document.querySelector('.navigation-menu')

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden')
        })


    })

</script>

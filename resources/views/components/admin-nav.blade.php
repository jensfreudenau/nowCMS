<div class="hidden sm:flex sm:items-center sm:ms-6 bg-white">
    <div class="flex h-16 items-center justify-between">
        <x-nav-link href="/adminmedia" :active="request()->is('adminmedia')">Media</x-nav-link>
        <x-nav-link href="/contents" :active="request()->is('contents')">Content</x-nav-link>
        <x-nav-link href="/categories/list" :active="request()->is('categories/list')">Kategorien</x-nav-link>
        <x-nav-link href="/dispatcher/index" :active="request()->is('dispatcher/index')">Dispatcher</x-nav-link>
        <x-nav-link href="/journey" :active="request()->is('journey')">Journey</x-nav-link>
        <x-nav-link href="/tags/index" :active="request()->is('/tags/index')">Tags</x-nav-link>
        <x-nav-link href="/users/index" :active="request()->is('/users/index')">Users</x-nav-link>
        <x-nav-link href="/log-viewer" :active="request()->is('log-viewer')">Logs</x-nav-link>
    <div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>
</div>


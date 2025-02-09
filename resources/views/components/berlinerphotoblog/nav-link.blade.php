@props(['active' => false])

<a class="'text-gray-700 hover:bg-gray-700 hover:text-white shadow-sm px-3 py-2 text-sm font-medium"
   aria-current="{{ $active ? 'page': 'false' }}"
    {{ $attributes }}
>{{ $slot }}</a>


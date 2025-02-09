@props(['active' => false])

<a class="
{{ $active ? 'border-2 border-blue-950 text-black': 'text-gray-700 hover:bg-gray-700 hover:text-white'}}
    rounded-md px-3 py-2 text-sm font-medium"
   aria-current="{{ $active ? 'page': 'false' }}"
    {{ $attributes }}
>{{ $slot }}</a>


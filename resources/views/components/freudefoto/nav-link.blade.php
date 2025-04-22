@props(['active' => false])

<a class="
{{ $active ? '  text-gray-400': 'text-gray-400'}}
    rounded-md px-3 py-2 "
   aria-current="{{ $active ? 'page': 'false' }}"
    {{ $attributes }}
>{{ $slot }}</a>


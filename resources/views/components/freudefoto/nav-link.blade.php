@props(['active' => false])

<a class="text-nord-6 rounded-md px-3 py-2 "
   aria-current="{{ $active ? 'page': 'false' }}"
    {{ $attributes }}
>{{ $slot }}</a>


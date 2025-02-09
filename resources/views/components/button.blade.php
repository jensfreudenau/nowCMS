<a {{ $attributes->merge(
    [
        'class' => 'relative
        inline-flex
        items-center
        px-4
        py-2
        text-sm
        font-medium
        text-gray-700
        bg-white border
        border-gray-300
        rounded-md
        dark:bg-gray-800
        dark:border-gray-600
        dark:text-gray-300
        dark:active:bg-gray-700
        dark:hover:bg-gray-500
        dark:active:text-gray-300'
        ]) }}>{{ $slot }}</a>

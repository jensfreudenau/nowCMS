<a type="button"
{{ $attributes->merge([
    'class' =>
                'text-white
                bg-gray-800
                hover:bg-pink-900
                focus:outline-none
                focus:ring-4
                focus:ring-pink-300
                font-medium
                rounded-lg
                text-sm
                px-3
                py-2
                me-2
                mb-2
                dark:bg-pink-900
                dark:hover:bg-pink-700
                dark:focus:ring-pink-700
                dark:border-pink-700'
    ])}}>
    {{$slot}}
</a>


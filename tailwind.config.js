import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './src/**/*.{html,js}'
    ],
    layers: {
        'no-tailwindcss': {
            // Add any styles you want to disable here
            '.no-tailwindcss': {
                all: 'unset',
            },
        },
    },
    theme: {
        extend: {
            colors: {
                'nord': {
                    0: '#2E3440',
                    1: '#3B4252',
                    2: '#434C5E',
                    3: '#4C566A',
                    4: '#D8DEE9',
                    5: '#E5E9F0',
                    6: '#ECEFF4',
                    7: '#8FBCBB',
                    8: '#88C0D0',
                    9: '#81A1C1',
                    10: '#5E81AC',
                    11: '#BF616A',
                    12: '#D08770',
                    13: '#EBCB8B',
                    14: '#A3BE8C',
                    15: '#B48EAD',
                    16: '#292F3B',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    safelist: [
        'text-nord-0',
        'text-nord-1',
        'text-nord-2',
        'text-nord-3',
        'text-nord-4',
        'text-nord-5',
        'text-nord-6',
        'text-nord-7',
        'text-nord-8',
        'text-nord-9',
        'text-nord-10',
        'text-nord-11',
        'text-nord-12',
        'text-nord-13',
        'text-nord-14',
        'text-nord-15',
        {pattern: /hljs+/}
    ],
    plugins: [
        forms, require('tailwind-highlightjs')
    ],
};

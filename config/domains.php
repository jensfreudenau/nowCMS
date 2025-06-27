<?php

return [
    'path' => [
        'freudefoto' => env('APP_FREUDEFOTO_PATH'),
        'travle_now' => env('APP_TRAVEL_NOW_PATH'),
        'streetphotoberlin' => env('APP_STREETPHOTO_PATH'),
        'freude-now' => env('APP_FREUDE_NOW_BLOG_PATH'),
        'berlinerphotoblog' => env('APP_BERLINER_PHOTO_BLOG_PATH'),
    ],
    'name' => [
        'freude-now' => env('APP_FREUDE_NOW_BLOG_DOMAIN_NAME'),
        'freude_now_blog_domain' => env('APP_FREUDE_NOW_BLOG_DOMAIN_NAME'),
        'street_photo_blog_domain' => env('APP_STREET_PHOTO_BLOG_DOMAIN_NAME'),
        'freude_foto_domain' => env('APP_FREUDE_FOTO_DOMAIN_NAME'),
        'berliner_photo_blog_domain' => env('APP_BERLINER_PHOTO_BLOG_DOMAIN_NAME'),
    ],
    'domain' => [
        'freude-now' => env('APP_FREUDE_NOW_BLOG_DOMAIN'),
        'freude_now_blog_domain' => env('APP_FREUDE_NOW_BLOG_DOMAIN'),
        'street_photo_blog_domain' => env('APP_STREET_PHOTO_BLOG_DOMAIN'),
        'freude_foto_domain' => env('APP_FREUDE_FOTO_DOMAIN'),
        'travle_now_domain' => env('APP_TRAVEL_NOW_DOMAIN'),
        'berliner_photo_blog_domain' => env('APP_BERLINER_PHOTO_BLOG_DOMAIN'),
    ],
    'titles' => [
        'freudefoto_title' => "Jens' Reisefotos",
        'travle_now_title' => "Jens' Reisefotos",
        'streetphoto_title' => "Jens' street photos",
        'freude_now_blog_title' => "Jens Freudenau's Blog",
        'berliner_photo_blog_title' => "Jens' Photo Art",
    ],
    'entries' => [
        'blog_entries_per_page' => env('BLOG_ENTRIES_PER_PAGE'),
        'berliner_photo_blog_entries_per_page'=> env('BERLINER_PHOTO_BLOG_ENTRIES_PER_PAGE'),
        'street_photo_blog_entries_per_page'=> env('STREET_PHOTO_BLOG_ENTRIES_PER_PAGE'),
        'freude_now_blog_entries_per_page' => env('FREUDE_NOW_BLOG_ENTRIES_PER_PAGE'),
        'travle_now_domain_entries_per_page' => env('BLOG_ENTRIES_PER_PAGE'),
    ]
];

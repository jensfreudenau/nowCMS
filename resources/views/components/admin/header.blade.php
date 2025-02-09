<!doctype html>
<html lang="en" class="h-full" style="background-color: #3f092a">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jens' Content Manager</title>

    @vite(['resources/css/app.css','resources/sass/app.scss', 'resources/js/app.js'])
</head>
<x-slot:heading></x-slot:heading>
<x-slot:meta></x-slot:meta>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

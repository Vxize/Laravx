<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Lavx') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {!! config('lavx.site_font', '') !!}
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.3/cdn.min.js"></script>
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/iconify/3.1.1/iconify.min.js"></script>
    </head>
    <body>
        <div class="text-gray-700 antialiased">
            <div class="min-h-screen flex bg-gray-100">
                <input type="checkbox" id="menu-toggle" class="relative sr-only peer" checked>
                <label
                    for="menu-toggle"
                    class="fixed top-0 z-40 inline-block p-4 bg-blue-600
                    left-48 md:left-0
                    transition-all duration-500
                    rotate-180 md:rotate-0
                    peer-checked:rotate-0 peer-checked:md:rotate-180
                    peer-checked:left-0 peer-checked:md:left-48"
                >
                    <div class="w-6 h-1 mb-3 rotate-45 bg-white"></div>
                    <div class="w-6 h-1 -rotate-45 bg-white"></div>
                </label>
                <div class="fixed top-0 left-0 z-40 h-full shadow-xl overflow-y-auto
                    border-r border-gray-300
                    transition-all duration-500 transform
                    translate-x-0 md:-translate-x-full
                    peer-checked:md:translate-x-0 peer-checked:-translate-x-full
                    w-48 bg-gray-50 lg:text-lg md:text-base text-sm
                ">
                    <x-lavx::layout.navbar />
                </div>
                <main id="main" class="pl-0 w-full pb-8 peer-checked:md:pl-48">
                    @if (env('TOP_BANNER'))
                        @includeIf(env('TOP_BANNER'))
                    @endif
                    @impersonating($guard = null)
                        @includeFirst(['impersonate', 'lavx::impersonate'], ['name' => auth()->user()->profile->name ?? ''])
                    @endImpersonating
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
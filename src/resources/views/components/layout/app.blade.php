<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Lavx') }}</title>

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        {!! config('lavx.site_font', '') !!}
        <style>
            html{
                font-size: {!! config('lavx.site_font_size', '') !!};
                font-family: {!! config('lavx.site_font_family', '') !!};
            }
        </style>

        <!-- Scripts -->
        @env('local')
            <script src="https://cdn.tailwindcss.com"></script>
        @endenv
        <script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="text-gray-700 antialiased">
            <div class="min-h-screen {{ config('lavx.site_background_color', 'bg-gray-100') }}">
                <x-lavx::layout.navbar />
                <main id="main" class="pt-14 md:pt-0 pb-10 {{ config('lavx.main_section_margin', 'md:ml-48') }}">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
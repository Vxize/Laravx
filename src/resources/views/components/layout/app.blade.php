<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Lavx') }}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        {!! config('lavx.site_font', '') !!}
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.11.1/dist/cdn.min.js"></script>
    </head>
    <body>
        <div class="text-gray-700 antialiased">
            <div class="min-h-screen {{ config('lavx.site_background_color', 'bg-gray-100') }}">
                <x-lavx::layout.navbar />
                @impersonating($guard = null)
                    @includeFirst(['impersonate', 'lavx::impersonate'], ['name' => auth()->user()->profile->name ?? ''])
                @endImpersonating
                @if (env('TOP_BANNER'))
                    @includeIf(env('TOP_BANNER'))
                @endif
                <main id="main" class="pt-14 md:pt-0 pb-10 {{ config('lavx.main_section_margin', 'md:ml-48') }}">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
<div class="p-4">
    <a href="/" class="text-sm font-semibold text-gray-800 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
        @if (config('lavx.site_logo', ''))
            <img src="{{ config('lavx.site_logo', '') }}" class="md:inline-block hidden h-8 w-8" />
        @endif
        {{ config('app.name') }}
    </a>
</div>
<nav>
    @includeIf('nav')
</nav>
<div class="p-4">
    <a href="/" class="text-sm font-semibold text-gray-800 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
        @if (config('site.logo_url', ''))
            <img src="{{ config('site.logo_url', '') }}" class="md:inline-block hidden h-8" />
        @else
            {{ __('app.site_name') }}
        @endif
    </a>
</div>
<nav>
    @includeIf('nav')
</nav>
<div class="md:flex flex-col md:flex-row md:min-h-screen md:overflow-y-auto md:h-full w-full fixed shadow-lg z-50
    {{ config('lavx.navbar_width', 'md:w-48') }}
    {{ config('lavx.navbar_background_color', 'bg-gray-50') }}
    {{ config('lavx.navbar_text_size', '') }}
">
    <div @click.away="open = false" x-data="{ open: false }" class="flex flex-col w-full text-gray-600 dark-mode:text-gray-200 dark-mode:bg-gray-800 flex-shrink-0">
        <div class="flex-shrink-0 px-4 py-4 flex flex-row items-center justify-between">
            <a href="/" class="text-sm font-semibold text-gray-800 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
                @if (config('lavx.site_logo', ''))
                    <img src="{{ config('lavx.site_logo', '') }}" class="md:inline-block hidden h-8 w-8" />
                @endif
                {{ config('app.name') }}
            </a>
            <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block pb-4 md:pb-0">
            @includeIf('nav')
        </nav>
    </div>
</div>
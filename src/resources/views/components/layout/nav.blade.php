{{--
    <x-lavx::layout.menu text="{{ __('lavx::sys.home_page') }}" icon="home" link="/" />
    <hr class="my-2">
    <p class="text-gray-400 pl-4">{{ __('lavx::user.user') }}</p>
    @guest
        <x-lavx::layout.menu text="{{ __('lavx::user.register') }}" icon="user-plus" link="{{ route('register') }}" />
        <x-lavx::layout.menu text="{{ __('lavx::user.login') }}" icon="sign-in-alt" link="{{ route('login') }}" />
    @endguest
    @auth
        <x-lavx::layout.menu text="{{ __('lavx::user.dashboard') }}" icon="user" link="{{ route('dashboard') }}" />
        <x-lavx::layout.menu text="{{ __('lavx::sys.setting') }}" icon="user-cog" link="{{ route('settings') }}" />
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-lavx::layout.menu text="{{ __('user.logout') }}" icon="sign-out-alt" submit="1" />
        </form>
        @role('admin')
            <hr class="my-2">
            <p class="text-gray-400 pl-4">{{ __('lavx::manage') }}</p>
            @can('register')
                <x-lavx::layout.menu text="{{ __('lavx::register') }}" icon="address-book" link="{{ route('admin.registers.index') }}" />
            @endcan
            @can('lesson')
                <x-lavx::layout.menu text="{{ __('lesson.start') }}" icon="user-graduate" link="{{ route('admin.lessons.index') }}" />
            @endcan
            @can('series')
                <x-lavx::layout.menu text="{{ __('lavx::series') }}" icon="th-list" link="{{ route('admin.series.index') }}" />
            @endcan
            @can('course')
                <x-lavx::layout.menu text="{{ __('lavx::course') }}" icon="chalkboard-teacher" link="{{ route('admin.courses.index') }}" />
            @endcan
            @can('book')
                <x-lavx::layout.menu text="{{ __('lavx::book') }}" icon="book" link="{{ route('admin.books.index') }}" />
            @endcan
            @can('order')
                <x-lavx::layout.menu text="{{ __('lavx::order') }}" icon="shopping-cart" link="{{ route('admin.orders.index') }}" />
            @endcan
            @can('user')
                <x-lavx::layout.menu text="{{ __('user.user') }}" icon="users" link="{{ route('admin.users.index') }}" />
            @endcan
            @can('region')
                <x-lavx::layout.menu text="{{ __('lavx::region') }}" icon="globe" link="{{ route('admin.regions.index') }}" />
            @endcan
            @can('role')
                <x-lavx::layout.menu text="{{ __('user.role') }}" icon="user-tag" link="{{ route('admin.roles.index') }}" />
            @endcan
            @can('permission')
                <x-lavx::layout.menu text="{{ __('user.permission') }}" icon="eye" link="{{ route('admin.permissions.index') }}" />
            @endcan
        @endrole
    @endauth
--}}

{{-- Start of Dropdown Menu
    <div @click.away="open = false" class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
        <span>Dropdown</span>
            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #1</a>
            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #2</a>
            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #3</a>
            </div>
        </div>
    </div>
End of Dropdown Menu --}}
@props([
    'action' => '',
    'reset' => '',
    'showError' => false,
])
<x-lavx::form
    action="{{ $action }}"
    showError="{{ $showError }}"
    type="get"
>
    <x-slot name="submit">
        <div class="pt-2 relative mx-auto">
            <x-lavx::form.input
                class="w-full py-3.5"
                type="text"
                name="search"
                placeholder="{{__('lavx::sys.search')}}"
                value="{{ request()->input('search') ?? '' }}"
                required
            />
            <a href="{{ $reset }}" class="absolute right-0 top-0 mt-5 mr-14 hover:opacity-50" >
                <span class="text-3xl"><x-lavx::icon icon="times" /></span>
            </a>
            <button type="submit" class="absolute right-0 top-0 mt-5 mr-4 hover:opacity-50">
                <span class="text-3xl"><x-lavx::icon icon="search" /></span>
            </button>
        </div>
    </x-slot>
</x-lavx::form>
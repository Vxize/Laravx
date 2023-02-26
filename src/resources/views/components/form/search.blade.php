@props([
    'action' => '',
    'reset' => '',
    'searchable' => '',
    'showError' => false,
])
@php
    $query = request()->query();
    if (isset($query['search']))  unset($query['search']);
@endphp
<x-lavx::form
    action="{{ $action }}"
    showError="{{ $showError }}"
    type="get"
>
@if (!empty($query))
    @foreach ($query as $name => $value)
        <input type="hidden" name="{{ $name }}" value="{{ $value }}" >
    @endforeach
@endif
    <x-slot:submit>
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
                <span class="text-3xl text-red-600"><x-lavx::icon icon="xmark" /></span>
            </a>
            <button type="submit" class="absolute right-0 top-0 mt-5 mr-4 hover:opacity-50">
                <span class="text-3xl text-blue-600"><x-lavx::icon icon="magnifying-glass" /></span>
            </button>
        </div>
    </x-slot>
</x-lavx::form>
@if ($searchable)
    <p class="mt-1 md:text-sm text-xs text-gray-400">
        {{ __('lavx::sys.search') }}：{{ $searchable }}
    </p>
@endif
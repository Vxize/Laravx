@props([
    'route' => '',
    'showError' => false,
    'filter' => [],
])
@php
    if (! in_array('page', $filter)) {
        $filter[] = 'page';
    }
    $query = request()->except($filter);
    $link = route($route, $query);
@endphp
<x-lavx::form
    :action=" $link "
    showError="{{ $showError }}"
    type="get"
>
@if (! empty($query))
    @foreach ($query as $name => $value)
        <input type="hidden" name="{{ $name }}" value="{{ $value }}" >
    @endforeach
@endif
    {{ $slot }}
    <x-slot:submit>
        <x-lavx::form.submit
            display="inline-block"
            icon="fa6-solid:filter"
            text="{{ __('lavx::sys.filter') }}"
            textSize="lg:text-lg md:text-md text-base"
            padding="p-2"
            width="w-28"
            margin="mx-auto"
        />
    </x-slot>
    <x-slot:after_submit>
        <x-lavx::button
            display="inline-block"
            color="red"
            :link=" $link "
            icon="fa6-solid:filter-circle-xmark"
            text="{{ __('lavx::sys.reset') }}"
            textSize="lg:text-lg md:text-md text-base"
            padding="p-2"
            width="w-28"
            margin="mx-auto"
        />
    </x-slot>
</x-lavx::form>
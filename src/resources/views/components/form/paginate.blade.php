@props([
    'action' => '',
    'paginate' => null,
    'showError' => false,
])
@php
    $query = Arr::except(request()->query(), ['paginate', 'page']);
@endphp
<x-lavx::form
    action="{{ $action }}"
    showError="{{ $showError }}"
    type="get"
>
@if (! empty($query))
    @foreach ($query as $name => $value)
        <input type="hidden" name="{{ $name }}" value="{{ $value }}" >
    @endforeach
@endif
    <span class="p-1">{{ __('pagination.each_page') }}</span>
    <x-lavx::form.input
        class="inline-block w-12 h-8 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
        type="number"
        name="paginate"
        value="{{ $paginate ?? '' }}"
    />
    <span class="p-1">{{ __('pagination.record') }}</span>
    <x-slot:submit>
        <x-lavx::form.submit
            display="inline-block"
            icon="fa6-solid:rotate"
            text=""
            textSize="text-sm"
            padding="p-2"
            width="w-12"
            margin="mx-auto"
        />
    </x-slot>
</x-lavx::form>
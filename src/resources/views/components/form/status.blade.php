@props(['status'])

@if ($status)
    <x-lavx::alert color="green">
        {{ $status }}
    </x-lavx::alert>
@endif

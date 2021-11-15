@props([
    'title' => '',
    'margin' => 'mx-auto mt-6',
    'path' => '',
    'showReturn' => true,
    'return' => '',
    'action' => '',
    'form' => '',
    'aboveForm' => '',
    'alert' => '',
    'alertColor' => 'blue',
    'formData' => [],
    'record' => [],
    'routeKeyName' => 'id',
])
<x-lavx::layout.page margin="{{ $margin }}">
    <x-lavx::h1 text="{{ $title }}" />
    @if ($showReturn)
        <x-lavx::button link="{{ $return ?: route($path.'.index') }}" color="green" />
    @endif
    @if ($alert)
        <x-lavx::alert text="{{ $alert }}" color="{{ $alertColor }}" />
    @endif
    {{ $aboveForm }}
    <x-lavx::form action="{{ route( $action ?: $path.'.update', $record->{$routeKeyName}) }}" type="update">
        @include( $form ?: 'forms.'.$path, $formData)
    </x-lavx::form>
    {{ $slot ?? '' }}
</x-lavx::layout.page>
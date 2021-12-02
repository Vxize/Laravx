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
    'alertEscaped' => false,
    'formData' => [],
    'submitText' => 'lavx::sys.save',
    'submitColor' => 'blue',
    'submitIcon' => 'save',
    'submitWidth' => 'w-full',
    'submitDisabled' => false,
    'hasUpload' => false,
])
<x-lavx::layout.page margin="{{ $margin }}">
    <x-lavx::h1 text="{{ $title }}" />
    @if ($showReturn)
        <x-lavx::button link="{{ $return ?: route($path.'.index') }}" color="green" />
    @endif
    @if ($alert)
        <x-lavx::alert :text="$alert" color="{{ $alertColor }}" escaped="{{ $alertEscaped }}" />
    @endif
    {{ $aboveForm }}
    <x-lavx::form action="{{ $action ?: route($path.'.store') }}"
        submitText="{{ $submitText }}"
        submitIcon="{{ $submitIcon }}"
        submitColor="{{ $submitColor }}"
        submitWidth="{{ $submitWidth }}"
        submitDisabled="{{ $submitDisabled }}"
        hasUpload="{{ $hasUpload }}"
    >
        @include( $form ?: 'forms.'.$path, $formData)
    </x-lavx::form>
    {{ $slot ?? '' }}
</x-lavx::layout.page>
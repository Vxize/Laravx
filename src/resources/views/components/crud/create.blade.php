@props([
    'title' => '',
    'margin' => 'mx-auto mt-6',
    'path' => '',
    'showReturn' => true,
    'return' => '',
    'action' => '',
    'form' => '',
    'aboveForm' => '',
    'aboveFormData' => [],
    'belowForm' => '',
    'belowFormData' => [],
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
    'errorTitle' => 'lavx::form.submit_error',
])
<x-lavx::layout.page margin="{{ $margin }}">
    <x-lavx::h1 text="{{ $title }}" />
    @if ($showReturn)
        <x-lavx::button link="{{ $return ?: url()->previous() ?: route($path.'.index') }}" color="green" />
    @endif
    @if ($alert)
        <x-lavx::alert :text="$alert" color="{{ $alertColor }}" escaped="{{ $alertEscaped }}" />
    @endif
    @includeIf($aboveForm, $aboveFormData)
    <x-lavx::form action="{{ $action ?: route($path.'.store') }}"
        submitText="{{ $submitText }}"
        submitIcon="{{ $submitIcon }}"
        submitColor="{{ $submitColor }}"
        submitWidth="{{ $submitWidth }}"
        submitDisabled="{{ $submitDisabled }}"
        hasUpload="{{ $hasUpload }}"
        errorTitle="{{ $errorTitle }}"
    >
        @include( $form ?: 'forms.'.$path, $formData)
    </x-lavx::form>
    @includeIf($belowForm, $belowFormData)
    {{ $slot ?? '' }}
</x-lavx::layout.page>
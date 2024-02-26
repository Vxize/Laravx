@props([
    'title' => '',
    'margin' => 'mx-auto mt-6',
    'width' => 'max-w-lg',
    'path' => '',
    'showReturn' => true,
    'return' => '',
    'action' => '',
    'actionParameter' => true,
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
    'submitIcon' => 'fa-solid:save',
    'submitWidth' => 'w-full',
    'submitDisabled' => false,
    'record' => [],
    'routeKeyName' => 'id',
    'hasUpload' => false,
])
<x-lavx::layout.page :margin="$margin" :width="$width">
    <x-lavx::h1 text="{{ $title }}" />
    @if ($showReturn)
        <x-lavx::button link="{{ $return ?: url()->previous() ?: route($path.'.index') }}" color="green" />
    @endif
    @if ($alert)
        <x-lavx::alert text="{{ $alert }}" color="{{ $alertColor }}" escaped="{{ $alertEscaped }}" />
    @endif
    @includeIf($aboveForm, $aboveFormData ?: ['record' => $record])
    <x-lavx::form
        action="{{ route( $action ?: $path.'.update', $actionParameter ? $record->{$routeKeyName} : '') }}"
        type="update"
        submitText="{{ $submitText }}"
        submitIcon="{{ $submitIcon }}"
        submitColor="{{ $submitColor }}"
        submitWidth="{{ $submitWidth }}"
        submitDisabled="{{ $submitDisabled }}"
        hasUpload="{{ $hasUpload }}"
    >
        @include( $form ?: 'forms.'.$path, $formData)
    </x-lavx::form>
    @includeIf($belowForm, $belowFormData ?: ['record' => $record])
    {{ $slot ?? '' }}
</x-lavx::layout.page>
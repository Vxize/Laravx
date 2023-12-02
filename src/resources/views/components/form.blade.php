@props([
    'above_form' => '',
    'below_form' => '',
    'action' => '',
    'type' => '',
    'showError' => true,
    'errorTitle' => 'lavx::form.submit_error',
    'submitText' => 'lavx::sys.save',
    'submitIcon' => 'fa-solid:save',
    'submitColor' => 'blue',
    'submitWidth' => 'w-full',
    'submitDisabled' => false,
    'submit' => null,
    'hasUpload' => false,
])
{{ $above_form }}
@if ($showError && isset($errors))
    <x-lavx::form.error :errors=" $errors" title="{{ __($errorTitle) }}" />
@endif
<form method="{{ $type === 'get' ? 'GET' : 'POST' }}"
    action="{{ $action }}"
    autocomplete="off"
    @if ($hasUpload)
        enctype="multipart/form-data"
    @endif
    {{ $attributes }} 
>
    @if ($type !== 'get')
        @csrf
    @endif

    @if ($type === 'update')
        @method('PUT')
    @elseif ($type === 'delete')
        @method('DELETE')
    @else
    @endif

    {{ $slot }}

    @if ($submit)
        {{ $submit }}
    @else
        <div class="mt-4">
            <x-lavx::form.submit
                text="{{ __($submitText) }}"
                :icon=" $submitIcon"
                color="{{ $submitColor }}"
                width="{{ $submitWidth }}"
                disabled="{{ $submitDisabled }}"
            />
        </div>
    @endif

</form>
{{ $below_form }}
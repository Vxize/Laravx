<x-lavx::layout.page>
    @if ($message = session('success'))
        <x-lavx::h1 color="text-green-600" text="{{ session('title') ?? __('lavx::form.submit_success') }}" />
        <x-lavx::alert color="green" text="{{ $message }}" />
    @else
        <x-lavx::h1 color="text-red-600" text="{{ session('title') ?? __('lavx::form.submit_error') }}" />
        <x-lavx::alert color="red" text="{{ __( session('fail') ?? 'lavx::return_retry' ) }}" />
    @endif
    <x-lavx::button link="{{ session('return') ?? url()->previous() }}" />
</x-lavx::layout.page>
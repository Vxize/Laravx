@props([
    'route' => '',
    'showError' => false,
    'hiddenInputs' => [],
])
@foreach ($hiddenInputs as $name => $value)
    <input type="hidden" name="{{$name}}" value="{{$value}}" />
@endforeach
<x-lavx::form
    action="{{ $route }}"
    showError="{{ $showError }}"
    type="update"
>
    <x-lavx::form.input
        :label="__('lavx::sys.name')"
        labelDisplay="inline-block"
        class="inline-block mt-1 w-40"
        type="text"
        name="name"
        required
    />
    <x-lavx::form.input
        :label="__('lavx::sys.value')"
        labelDisplay="inline-block"
        class="inline-block mt-1 w-80"
        type="text"
        name="value"
        required
    />
    <x-slot:submit>
        <x-lavx::form.submit
            display="inline-block"
            icon="fa-solid:plus"
            text="{{ __('lavx::sys.add_new') }}"
            textSize="lg:text-lg md:text-md text-base"
            padding="p-2"
            width="w-28"
            margin="mx-auto"
        />
    </x-slot>
</x-lavx::form>
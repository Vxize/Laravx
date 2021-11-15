@props([
    'errors',
    'title' => 'form.submit_error',
])

@if ($errors->any())
    <x-lavx::alert color="red" align="text-left">
        <x-lavx::h4>
            <x-lavx::icon icon="times-circle" />
            {{ __($title) }}
        </x-lavx::h4>
        <x-lavx::ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </x-lavx::ul>
    </x-lavx::alert>
@endif

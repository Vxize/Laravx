@props([
    'success' => session('success') ?? '',
    'error' => session('error') ?? '',
    'escaped' => false,
])

@if ($success)
    <x-lavx::alert color="green" :text="$success" :escaped="$escaped" />
@endif

@if ($error)
    <x-lavx::alert color="red" :text="$error" :escaped="$escaped" />
@endif
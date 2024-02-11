<x-lavx::alert
    margin="mx-auto fixed"
    color="purple"
    escaped="true" 
>
    {{ __('lavx::user.impersonating_message', ['name' => $name ? '「'.$name.'」' : __('lavx::sys.other')]) }}
    <x-lavx::button
        link="{{ route('impersonate.leave') }}"
        color="purple"
        display="inline-block"
        width="w-32"
        margin="mx-auto"
        padding="p-1"
    />
</x-lavx::alert>
<div class="h-20"></div>{{-- To hold the place since the banner is fixed --}}
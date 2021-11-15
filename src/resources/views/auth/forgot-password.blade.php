<x-lavx::layout.page margin="mx-auto mt-12">
    <x-lavx::h1 text="{{ __('lavx::user.forget_password') }}" />

    <x-lavx::alert
        align="text-left"
        text="{{ __('lavx::user.reset_password_instruction') }}"
    />
    <!-- Session Status -->
    <x-lavx::form.status :status="session('status')" />

    <!-- Validation Errors -->
    <x-lavx::form 
        action="{{ route('password.email') }}"
        submitText="lavx::user.reset_password"
        submitIcon="key"
    >
        <div>
            <x-lavx::form.email class="block mt-1 w-full" required autofocus />
        </div>
    </x-lavx::form>
</x-lavx::layout.page>
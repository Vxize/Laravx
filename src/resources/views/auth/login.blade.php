<x-lavx::layout.page margin="mx-auto mt-12">
    <x-lavx::h1 text="{{ __('lavx::user.login') }}" />
    <!-- Session Status -->
    <x-lavx::form.status :status="session('status')" />

    <x-lavx::form 
        action="{{ route('login') }}"
        errorTitle="lavx::user.login_failed"
        submitText="lavx::user.login"
        submitIcon="sign-in-alt"
    >
        <div>
            <x-lavx::form.email class="block mt-1 w-full" required autofocus />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-lavx::form.input :label="__('lavx::user.password')" class="block mt-1 w-full"
                type="password" name="password"
                required autocomplete="current-password" />
        </div>

        <!-- Remember Me -->
        <div class="mt-4">
            <x-lavx::form.checkbox name="remember" label="{{ __('lavx::user.keep_login') }}" />
        </div>
    </x-vx.form>

    <p class="text-center">
        <x-lavx::a link="{{ route('password.request') }}">
            {{ __('lavx::user.forget_password') }}?
        </x-vx.a>
    </p>
    <p class="text-center mt-4">
        <x-lavx::a link="{{ route('register') }}">
            {{ __('lavx::user.new') }}{{ __('lavx::user.register') }}
        </x-vx.a>
    </p>
</x-lavx::layout.page>
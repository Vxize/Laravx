<!-- Email Address -->
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
    <p class="text-right">
        <x-lavx::a link="{{ route('password.request') }}">
            {{ __('lavx::user.forget_password') }}?
        </x-vx.a>
    </p>
    <x-lavx::form.checkbox name="remember" label="{{ __('lavx::user.keep_login') }}" />
</div>

<x-slot:above_form>
    <!-- Session Status -->
    <x-lavx::form.status :status="session('status')" />
</x-slot>

<x-slot:below_form>
    <p class="text-center mt-4">
        <x-lavx::a link="{{ route('signup') }}">
            {{ __('lavx::user.new') }}{{ __('lavx::user.register') }}
        </x-vx.a>
    </p>
</x-slot>
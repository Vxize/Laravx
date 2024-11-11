<!-- Email Address -->
<div>
    <x-lavx::form.email required autofocus />
</div>

<!-- Password -->
<div class="mt-6">
    <x-lavx::form.input
        :label="__('lavx::user.password').'（'.__('lavx::user.password_min').'）'"
        type="password" name="password" required autocomplete="new-password" />
</div>

<!-- Confirm Password -->
<div class="mt-6">
    <x-lavx::form.input :label="__('lavx::user.confirm_password')"
        type="password" name="password_confirmation" required />
</div>

<x-lavx::p class="text-center">
    <small>
        {{ __('lavx::user.agree_tspp') }}
        <x-lavx::a link="{{ route('tspp') }}">
            {{ __('lavx::user.tspp') }}
        </x-vx.a>
    </small>
</x-lavx::p>

<x-slot:below_form>
    <x-lavx::p class="text-center">
        <x-lavx::a link="{{ route('login') }}">
            {{ __('lavx::user.already_registered') }}?
        </x-vx.a>
    </x-lavx::p>
</x-slot>
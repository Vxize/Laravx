<x-lavx::layout.page margin="mx-auto mt-12">
    <x-lavx::h1 text="{{ __('lavx::user.register') }}" />

    <x-lavx::alert color="red" align="text-left" text="{{ __('lavx::user.recommend_gmail') }}" />

    <!-- Validation Errors -->
    <x-lavx::form 
        action="{{ route('register') }}"
        submitText="lavx::user.register"
        submitIcon="user-plus"
    >
        <!-- Email Address -->
        <div class="mt-4">
            <x-lavx::form.email class="block mt-1 w-full" required autofocus />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-lavx::form.input 
                :label="__('lavx::user.password').'（'.__('lavx::user.password_min').'）'"
                class="block mt-1 w-full"
                type="password" name="password" required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-lavx::form.input :label="__('lavx::user.confirm_password')" class="block mt-1 w-full"
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
    </x-vx.form>

    <x-lavx::p class="text-center">
        <x-lavx::a link="{{ route('login') }}">
            {{ __('lavx::user.already_registered') }}?
        </x-vx.a>
    </x-lavx::p>
</x-lavx::layout.page>
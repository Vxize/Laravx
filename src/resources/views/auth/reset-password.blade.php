<x-lavx::layout.page margin="mx-auto mt-12">
    <x-lavx::h1 text="{{ __('lavx::user.reset_password') }}" />
    <x-lavx::alert text="{{ __('lavx::user.reset_password_input') }}" />
    <x-lavx::form 
        action="{{ route('password.update') }}"
        submitText="lavx::user.reset_password"
        submitIcon="key"
    >
        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-lavx::.form.email
                class="block mt-1 w-full"
                :value="old('email', $request->email)"
                required
                autofocus 
            />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-lavx::form.input
                :label="__('lavx::user.password')"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="new-password"
            />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-lavx::form.input
                :label="__('lavx::user.confirm_password')"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required
            />
        </div>
    </x-vx.form>
</x-lavx::layout.page>
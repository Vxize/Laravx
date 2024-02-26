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
<div class="mt-6">
    <x-lavx::form.input
        :label="__('lavx::sys.new').__('lavx::user.password').'（'.__('lavx::user.password_min').'）'"
        class="block mt-1 w-full"
        type="password"
        name="password"
        required
        autocomplete="new-password"
    />
</div>

<!-- Confirm Password -->
<div class="mt-6">
    <x-lavx::form.input
        :label="__('lavx::user.confirm_password')"
        class="block mt-1 w-full"
        type="password"
        name="password_confirmation"
        required
    />
</div>
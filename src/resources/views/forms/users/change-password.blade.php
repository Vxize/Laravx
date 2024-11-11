<div>
    <x-lavx::form.input
        :label="__('lavx::sys.current').__('lavx::user.password')"
        type="password"
        name="current_password"
        required
    />
</div>

<div class="mt-6">
    <x-lavx::form.input
        :label="__('lavx::sys.new').__('lavx::user.password').'（'.__('lavx::user.password_min').'）'"
        type="password"
        name="new_password"
        required
        autocomplete="new-password"
    />
</div>

<!-- Confirm Password -->
<div class="mt-6">
    <x-lavx::form.input
        :label="__('lavx::user.confirm_new_password')"
        type="password"
        name="new_password_confirmation"
        required
    />
</div>
<div>
    <x-lavx::form.email
        class="block mt-1 w-full" 
        value="{{ old('email') ?? $record->email ?? '' }}"
        required
        autofocus
    />
</div>
<div class="mt-4">
    <x-lavx::form.checkbox name="reset_password" label="{{ __('lavx::user.reset_password') }}" />
</div>
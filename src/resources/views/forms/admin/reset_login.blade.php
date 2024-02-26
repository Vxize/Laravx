<div>
    <x-lavx::form.email
        class="block mt-1 w-full" 
        value="{{ old('email') ?? $record->email ?? '' }}"
        required
        autofocus
    />
</div>
<div class="mt-6">
    <x-lavx::form.checkbox name="reset_password" label="{{ __('lavx::user.reset_password') }}" />
</div>
<div class="mt-6">
    <x-lavx::form.label :value="__('lavx::user.lock_account')" />
    <x-lavx::form.radio
        name="lock"
        :checked="isset($record->unlocked_at) && $record->unlocked_at > now()"
        :label="__('lavx::sys.lock')"
        :value="1"
        required
    />
    <x-lavx::form.radio
        name="lock"
        :checked="! isset($record->unlocked_at)"
        :label="__('lavx::sys.unlock')"
        :value="0"
        required
    />
</div>
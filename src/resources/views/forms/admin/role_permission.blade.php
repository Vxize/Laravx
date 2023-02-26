@foreach ($permissions as $permission)
    <div class="mt-4">
        <x-lavx::form.checkbox
            name="{{ $permission }}"
            label="{{ __('permission.'.$permission) }} ({{ $permission }})"
            checked="{{ in_array($permission, $role_permissions) }}"
        />
    </div>
@endforeach
@foreach ($roles as $role)
    <div class="mt-4">
        <x-lavx::form.checkbox
            name="{{ $role }}"
            label="{{ __('role.'.$role) }} ({{ $role }})"
            checked="{{ in_array($role, $user_roles) }}"
        />
    </div>    
@endforeach
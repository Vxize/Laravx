@foreach ($permissions as $permission)
    <div class="mt-4">
        <x-lavx::form.checkbox
            name="{{ $permission }}"
            label="{{ 
                in_array($permission, $user_role_permissions)
                && !in_array($permission, $user_direct_permissions)
                ? __('permission.'.$permission).' ('.$permission.') ('.__('lavx::role.permission').')'
                : __('permission.'.$permission).' ('.$permission.')'
            }}"
            checked="{{
                in_array($permission, $user_role_permissions)
                || in_array($permission, $user_direct_permissions)
            }}"
        />
    </div>    
@endforeach
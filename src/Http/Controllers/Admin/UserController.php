<?php

namespace Vxize\Lavx\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Vxize\Lavx\Http\Controllers\ResourceController;
use Vxize\Lavx\Events\UserCreatedByAdmin;
use Vxize\Lavx\Events\UserLoginUpdated;
use Vxize\Lavx\Events\UserPermissionAssigned;
use Vxize\Lavx\Events\UserRoleAssigned;

class UserController extends ResourceController
{
    protected
        $path = 'admin.users',
        $name = 'lavx::user.user',
        $model = 'App\\Models\\User',
        $rules = [
            'email' => 'sometimes|string|email:filter|max:255|unique:users',
        ]
    ;
    // default time for "unlocked_at" column
    const DEFAULT_UNLOCK_TIME = '2038-01-17 23:59:59';

    public function columns($type = 'index')
    {
        switch ($type) {
            case 'search':
            case 'index':
                return [
                    'profile.cn_name' => 'lavx::profile.cn_name',
                    'profile.first_name' => 'lavx::profile.first_name',
                    'profile.last_name' => 'lavx::profile.last_name',
                    'email' => 'lavx::user.email',
                    'profile.phone' => 'lavx::profile.phone',
                ];
                break;
            case 'action':
                $action = [
                    'profile' => 'lavx::sys.profile_short',
                    'login' => 'lavx::user.login',
                ];
                $user = auth()->user();
                if ($user->can('log')) {
                    $action['log'] = 'lavx::sys.log';
                }
                if ($user->can('permission')) {
                    $action['permission'] = 'lavx::user.permission';
                }
                if ($user->can('role')) {
                    $action['role'] = 'lavx::user.role';
                }
                if ($user->can('impersonate')) {
                    $action['impersonate'] = 'lavx::user.impersonate';
                }
                return $action;
                break;
            case 'extra':
                return [];
                break;
            case 'update':
                return [
                    'email',
                    'password',
                    'email_verified_at',
                    'unlocked_at'
                ];
            case 'store':
                return [
                    'email',
                ];
                break;
            default:
                return [
                    'profile.cn_name' => 'lavx::profile.cn_name',
                    'profile.first_name' => 'lavx::profile.first_name',
                    'profile.last_name' => 'lavx::profile.last_name',
                    'profile.sex' => 'lavx::profile.sex',
                    'profile.age' => 'lavx::profile.age',
                    'email' => 'lavx::user.email',
                    'profile.phone' => 'lavx::profile.phone',
                    'profile.address' => 'lavx::profile.address',
                    'profile.address2' => 'lavx::profile.address2',
                    'profile.city' => 'lavx::profile.city',
                    'profile.state' => 'lavx::profile.state',
                    'profile.zipcode' => 'lavx::profile.zipcode',
                ];
                break;
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('search', null);
        return User::with('profile')->latest()
            ->when($search, function ($query, $search) {
                return $query->where('email', 'LIKE', '%'.$search.'%')
                    ->orWhereHas('profile', function($query) use ($search) {
                        $query->Where('cn_name', 'LIKE', '%'.$search.'%')
                        ->orWhere('first_name', 'LIKE', '%'.$search.'%')
                        ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                        ->orWhere('phone', 'LIKE', '%'.$search.'%');
                    });
            });
    }

    public function extraTable($data)
    {
        $result = [];
        foreach ($data as $num => $row) {
            $user_id = $row->user_id ?? $row->profile->user_id ?? null;
            if ($user_id) {
                $result[$num]['profile'] = [
                    'type' => 'button',
                    'icon' => 'fa6-solid:id-card',
                    'link' => route('admin.users.show', $user_id),
                    'color' => 'blue',
                ];
                $result[$num]['login'] = [
                    'type' => 'button',
                    'icon' => 'fa6-solid:right-to-bracket',
                    'link' => route('admin.users.login', $user_id),
                    'color' => 'green',
                ];
                $result[$num]['log'] = [
                    'type' => 'button',
                    'icon' => 'fa6-solid:clock-rotate-left',
                    'link' => route('admin.logs.index', ['user_id' => $user_id]),
                    'color' => 'purple',
                ];
                $result[$num]['permission'] = [
                    'type' => 'button',
                    'icon' => 'fa6-solid:eye',
                    'link' => route('admin.users.permissions', $user_id),
                    'color' => 'yellow',
                ];
                $result[$num]['role'] = [
                    'type' => 'button',
                    'icon' => 'fa6-solid:user-tag',
                    'link' => route('admin.users.roles', $user_id),
                    'color' => 'indigo',
                ];
                $result[$num]['impersonate'] = [
                    'type' => 'button',
                    'icon' => 'fa6-solid:rotate',
                    'link' => route('impersonate', $user_id),
                    'color' => 'red',
                ];
            }
        }
        return $result;
    }

    public function editLogin(Request $request, User $user)
    {
        return $this->editRecord($user, [
            'form' => 'lavx::forms.admin.reset_login',
            'title' => __('lavx::user.login'),
            'action' => 'admin.users.login',
            'alert' => $user->profile->full_name,
        ]);
    }

    public function updateLogin(Request $request, User $user)
    {
        $new_email = strtolower($request->email);
        if ($new_email === $user->email) {
            // email unchanged, remove it from request
            $request->offsetUnset('email');
        } else {
            // email changed, reset email verified time
            $request->merge([
                'email_verified_at' => null,
            ]);
        }
        if ($request->filled('reset_password')) {
            $new_password = \Lavx::randomString(8);
            $request->merge([
                'password' => Hash::make($new_password),
                'password_text' => $new_password,
            ]);
        } else {
            $new_password = __('lavx::sys.unchanged');
        }
        $unlocked_at = $request->lock ? self::DEFAULT_UNLOCK_TIME : null;
        $locked = $request->lock ? __('lavx::sys.yes') : __('lavx::sys.no');
        $request->merge([
            'unlocked_at' => $unlocked_at,
            'success_message' => __('lavx::user.login_info', [
                'email' => $new_email,
                'password' => $new_password,
                'locked' => $locked,
            ]),
            '_redirect' => 'admin.users.index'
        ]);
        return $this->updateRecord($request, $user);
    }

    // when update user login info is success
    public function onUpdateSuccess(Request $request, $record, $old_record)
    {
        event(new UserLoginUpdated($request, $record, $old_record));
    }

    public function getRoles(Request $request, User $user)
    {
        return $this->createRecord([
            'form' => 'lavx::forms.admin.user_role',
            'title' => __('lavx::user.role'),
            'action' => route('admin.users.roles', $user->id),
            'alert' => $user->profile->full_name.'<br>'.$user->email,
            'alert_escaped' => true,
            'form_data' => [
                'roles' => Role::orderBy('name')->pluck('name'),
                'user_roles' => $user->getRoleNames()->toArray(),
            ]
        ]);
    }

    public function setRoles(Request $request, User $user)
    {
        $roles = array_keys($request->except('_token'));
        $user->syncRoles($roles);
        event(new UserRoleAssigned(
            assigner: $request->user(),
            assignee: $user,
            roles: $roles,
            ip: $request->ip()
        ));
        return to_route('admin.users.index')
            ->with('success', __('lavx::form.save_success'));
    }

    public function getPermissions(Request $request, User $user)
    {
        return $this->createRecord([
            'form' => 'lavx::forms.admin.user_permission',
            'title' => __('lavx::user.permission'),
            'action' => route('admin.users.permissions', $user->id),
            'alert' => $user->profile->full_name.'<br>'.$user->email,
            'alert_escaped' => true,
            'form_data' => [
                'permissions' => Permission::orderBy('name')->pluck('name'),
                'user_direct_permissions' => 
                    $user->getDirectPermissions()->pluck('name')->toArray(),
                'user_role_permissions' =>
                    $user->getPermissionsViaRoles()->pluck('name')->toArray(),
            ]
        ]);
    }

    public function setPermissions(Request $request, User $user)
    {
        $permissions = array_keys($request->except('_token'));
        $user->syncPermissions($permissions);
        event(new UserPermissionAssigned(
            assigner: $request->user(),
            assignee: $user,
            permissions: $permissions,
            ip: $request->ip()
        ));
        return to_route('admin.users.index')
            ->with('success', __('lavx::form.save_success'));
    }

    public function index(Request $request)
    {
        return $this->indexRecord($request, [
            'delete' => false,
            'edit' => false,
            'view' => false,
            'add' => true,
        ]);
    }

    public function show(User $user)
    {
        return $this->showRecord($user, [
            'delete' => false,
            'edit' => $user->profile->uid,
            'edit_id' => $user->profile->uid,
            'edit_route' => 'admin.profiles.edit',
        ]);
    }

    public function create()
    {
        return $this->createRecord([
            'form' => 'lavx::forms.admin.users',
        ]);
    }

    public function store(Request $request)
    {
        return $this->storeRecord($request);
    }

    public function onStoreSuccess(Request $request, $record)
    {
        event(new UserCreatedByAdmin($record, $request));
    }

}

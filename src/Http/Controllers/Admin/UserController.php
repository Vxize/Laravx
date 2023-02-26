<?php

namespace Vxize\Lavx\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Vxize\Lavx\Http\Controllers\ResourceController;

class UserController extends ResourceController
{
    protected
        $path = 'admin.users',
        $name = 'lavx::user.user',
        $model = 'App\\Models\\User'
    ;

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
            case 'extra':
                $extra = [
                    'profile' => 'lavx::sys.profile',
                ];
                $user = auth()->user();
                if ($user->can('log')) {
                    $extra['log'] = 'lavx::sys.log';
                }
                if ($user->can('permission')) {
                    $extra['permission'] = 'lavx::user.permission';
                }
                if ($user->can('role')) {
                    $extra['role'] = 'lavx::user.role';
                }
                return $extra;
                break;
            default:
                return [
                    'profile.cn_name' => 'lavx::profile.cn_name',
                    'profile.first_name' => 'lavx::profile.first_name',
                    'profile.last_name' => 'lavx::profile.last_name',
                    'email' => 'lavx::user.email',
                    'profile.phone' => 'lavx::profile.phone',
                    'profile.address' => 'lavx::profile.address',
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
                    'icon' => 'id-card',
                    'link' => route('admin.users.show', $user_id),
                    'color' => 'blue',
                ];
                $result[$num]['log'] = [
                    'type' => 'button',
                    'icon' => 'clock-rotate-left',
                    'link' => route('admin.logs.index', ['user_id' => $user_id]),
                    'color' => 'purple',
                ];
                $result[$num]['permission'] = [
                    'type' => 'button',
                    'icon' => 'eye',
                    'link' => route('admin.users.permissions', $user_id),
                    'color' => 'green',
                ];
                $result[$num]['role'] = [
                    'type' => 'button',
                    'icon' => 'user-tag',
                    'link' => route('admin.users.roles', $user_id),
                    'color' => 'yellow',
                ];
            }
        }
        return $result;
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
        activity('user')->event('UserRoleAssigned')->on($user)
            ->by($request->user())
            ->withProperties([
                'roles' => $roles,
                'ip' => $request->ip(),
            ])->log('Roles assigned to :subject.email by :causer.email (:properties.ip)');
        return redirect()->route('admin.users.index')
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
        activity('user')->event('UserPermissionAssigned')->on($user)
            ->by($request->user())
            ->withProperties([
                'permissions' => $permissions,
                'ip' => $request->ip(),
            ])->log('Permissions assigned to :subject.email by :causer.email (:properties.ip)');
        return redirect()->route('admin.users.index')
            ->with('success', __('lavx::form.save_success'));
    }

    public function index(Request $request)
    {
        return $this->indexRecord($request, [
            'delete' => false,
            'edit' => false,
            'view' => false,
            'add' => false,
        ]);
    }

    public function show(User $user)
    {
        return $this->showRecord($user, [
            'delete' => false,
            'edit' => false,
            // 'edit_route' => 'admin.profiles.edit',
        ]);
    }

}

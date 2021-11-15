<?php

namespace Vxize\Lavx\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Vxize\Lavx\Http\Controllers\ResourceController;
use App\Http\Controllers\Admin\UserController as AdminUser;

class RoleController extends ResourceController
{
    
    protected 
        $rules = [
            'name' => 'required|string|max:255|unique:roles',
        ],
        $path = 'admin.roles',
        $name = 'lavx::user.role',
        $model = 'Spatie\\Permission\\Models\\Role',
        $paginate = 7
        ;

    public function columns($type = 'index')
    {
        $common = [
            'name' => 'lavx::sys.name',
        ];
        switch ($type) {
            case 'show':
                return $common;
                break;
            case 'download':
                return $common;
                break;
            case 'index':
                return $common;
                break;
            case 'extra':
                return [
                    'permission' => 'lavx::user.permission',
                    'user' => 'lavx::user.user',
                ];
                break;
            default:
                return [];
                break;
        }
    }
    
    public function search(Request $request)
    {
        $search = $request->input('search', null);
        if ($search) {
            return Role::where('name', 'LIKE', '%'.$search.'%')
                    ->orderBy('name');
        }
        return Role::orderBy('name');
    }
    
    public function extraTable($data)
    {
        $result = [];
        foreach ($data as $num => $row) {
            $result[$num]['permission'] = [
                'type' => 'button',
                'icon' => 'eye',
                'link' => route('admin.roles.permissions', $row->id),
                'color' => 'green',
            ];
            $result[$num]['user'] = [
                'type' => 'button',
                'icon' => 'user',
                'link' => route('admin.roles.users', $row->id),
                'color' => 'yellow',
            ];
        }
        return $result;
    }

    public function getUser(Request $request, Role $role)
    {
        $admin_user = new AdminUser;
        $table_data = User::with('profile')->role($role->name);
        return $admin_user->indexRecord($request, [
            'table_data' => $table_data,
            'table_columns' => [
                'profile.cn_name' => 'lavx::profile.cn_name',
                'profile.first_name' => 'lavx::profile.first_name',
                'profile.last_name' => 'lavx::profile.last_name',
                'email' => 'lavx::user.email',
                'profile.phone' => 'lavx::profile.phone',
            ],
            'return' => route('admin.roles.index'),
            'delete' => false,
            'edit' => false,
            'view' => false,
            'add' => false,
        ]);
    }

    public function getPermissions(Request $request, Role $role)
    {
        return $this->createRecord([
            'form' => 'lavx::forms.admin.role_permission',
            'title' => __('lavx::role.permission'),
            'action' => route('admin.roles.permissions', $role->id),
            'alert' => __('role.'.$role->name).' ('.$role->name.')',
            'alert_escaped' => true,
            'form_data' => [
                'permissions' => Permission::orderBy('name')->pluck('name'),
                'role_permissions' => $role->permissions->pluck('name')->toArray(),
            ]
        ]);
    }

    public function setPermissions(Request $request, Role $role)
    {
        $permissions = array_keys($request->except('_token'));
        $role->syncPermissions($permissions);
        return redirect()->route('admin.roles.index')
            ->with('success', __('lavx::form.save_success'));
    }

    public function index(Request $request)
    {
        return $this->indexRecord($request);
    }

    public function create()
    {
        return $this->createRecord([
            'form' => 'lavx::forms.admin.roles',
        ]);
    }

    public function store(Request $request)
    {
        return $this->storeRecord($request);
    }

    public function show(Role $role)
    {
        return $this->showRecord($role);
    }

    public function edit(Role $role)
    {
        return $this->editRecord($role, [
            'form' => 'lavx::forms.admin.roles',
        ]);
    }

    public function update(Request $request, Role $role)
    {
        return $this->updateRecord($request, $role);
    }

    public function destroy(Role $role)
    {
        return $this->destroyRecord($role);
    }
}

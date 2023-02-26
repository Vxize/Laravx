<?php

namespace Vxize\Lavx\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Vxize\Lavx\Http\Controllers\Admin\UserController as AdminUser;
use Vxize\Lavx\Http\Controllers\ResourceController;

class PermissionController extends ResourceController
{

    protected 
        $rules = [
            'name' => 'required|string|max:255|unique:permissions',
        ],
        $path = 'admin.permissions',
        $name = 'lavx::user.permission',
        $model = 'Spatie\\Permission\\Models\\Permission'
    ;

    public function columns($type = 'index')
    {
        switch ($type) {
            case 'extra':
                return [
                    'description' => 'lavx::sys.description',
                    'role' => 'lavx::user.role',
                    'user' => 'lavx::user.user',
                ];
                break;
            default:
                return [
                    'name' => 'lavx::sys.name',
                ];
                break;
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('search', null);
        return Permission::orderBy('name')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', '%'.$search.'%');
            });
    }

    public function extraTable($data)
    {
        $result = [];
        foreach ($data as $num => $row) {
            $result[$num]['description'] = __('permission.'.$row->name);
            $result[$num]['role'] = [
                'type' => 'button',
                'icon' => 'user-tag',
                'link' => route('admin.permissions.roles', $row->id),
                'color' => 'green',
            ];
            $result[$num]['user'] = [
                'type' => 'button',
                'icon' => 'user',
                'link' => route('admin.permissions.users', $row->id),
                'color' => 'yellow',
            ];
        }
        return $result;
    }

    public function getRoles(Request $request, Permission $permission)
    {
        $roles = $permission->getRoleNames()->implode('</li><li>');
        $alert_text = $roles
            ? '<ul><li>'.$roles.'</li></ul>'
            : __('lavx::sys.no_record');
        return view('lavx::alert', [
            'title' => __('lavx::user.permission').__('lavx::user.role'),
            'subtitle' => $permission->name,
            'return_link' => route('admin.permissions.index'),
            'alert' => $alert_text,
            'alert_escaped' => $roles,
        ]);
    }

    public function getUser(Request $request, Permission $permission)
    {
        $admin_user = new AdminUser;
        $table_data = User::with('profile')->permission($permission->name);
        return $admin_user->indexRecord($request, [
            'table_data' => $table_data,
            'table_columns' => [
                'profile.cn_name' => 'lavx::profile.cn_name',
                'profile.first_name' => 'lavx::profile.first_name',
                'profile.last_name' => 'lavx::profile.last_name',
                'email' => 'lavx::user.email',
                'profile.phone' => 'lavx::profile.phone',
            ],
            'return' => route('admin.permissions.index'),
            'delete' => false,
            'edit' => false,
            'view' => false,
            'add' => false,
        ]);
    }

    public function index(Request $request)
    {
        return $this->indexRecord($request);
    }

    public function create()
    {
        return $this->createRecord([
            'form' => 'lavx::forms.admin.permissions',
        ]);
    }

    public function store(Request $request)
    {
        return $this->storeRecord($request);
    }

    public function show(Permission $permission)
    {
        return $this->showRecord($permission);
    }

    public function edit(Permission $permission)
    {
        return $this->editRecord($permission, [
            'form' => 'lavx::forms.admin.permissions',
        ]);
    }

    public function update(Request $request, Permission $permission)
    {
        return $this->updateRecord($request, $permission);
    }

    public function destroy(Permission $permission)
    {
        return $this->destroyRecord($permission);
    }
}

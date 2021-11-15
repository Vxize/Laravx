<?php

namespace Vxize\Lavx\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Vxize\Lavx\Http\Controllers\ResourceController;

class UserController extends ResourceController
{
    protected 
        $rules = [
            // 'name' => 'required|string|max:255',
        ],
        $path = 'admin.users',
        $name = 'lavx::user.user',
        $model = 'App\\Models\\User',
        $paginate = 7
    ;

    public function columns($type = 'index')
    {
        $full = [
            'cn_name' => 'lavx::profile.cn_name',
            'first_name' => 'lavx::profile.first_name',
            'last_name' => 'lavx::profile.last_name',
            'email' => 'lavx::user.email',
            'phone' => 'lavx::profile.phone',
            'address' => 'lavx::profile.address',
            'city' => 'lavx::profile.city',
            'state' => 'lavx::profile.state',
            'zipcode' => 'lavx::profile.zipcode',
        ];
        switch ($type) {
            case 'show':
                return $full;
                break;
            case 'download':
                return $full;
                break;
            case 'index':
                return [
                    'cn_name' => 'lavx::profile.cn_name',
                    'first_name' => 'lavx::profile.first_name',
                    'last_name' => 'lavx::profile.last_name',
                    'email' => 'lavx::user.email',
                    'phone' => 'lavx::profile.phone',
                ];
                break;
            case 'extra':
                $extra = [
                    'profile' => 'lavx::vx.profile',
                ];
                $user = auth()->user();
                if ($user->can('permission')) {
                    $extra['permission'] = 'lavx::user.permission';
                }
                if ($user->can('role')) {
                    $extra['role'] = 'lavx::user.role';
                }
                return $extra;
                break;
            default:
                return [];
                break;
        }
    }
    
    public function search(Request $request)
    {
        $search = $request->input('search', null);
        $users = User::leftJoin('profiles', 'users.id', '=', 'profiles.user_id');
        if ($search) {
            return $users->where('email', 'LIKE', '%'.$search.'%')
                ->orWhere('cn_name', 'LIKE', '%'.$search.'%')
                ->orWhere('first_name', 'LIKE', '%'.$search.'%')
                ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                ->orWhere('phone', 'LIKE', '%'.$search.'%')
                ->latest('users.created_at');
        }
        return $users->latest('users.created_at');
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $record = $user->profile;
        $record->email = $user->email;
        return $this->showRecord($record, [
            'delete' => false,
            'edit_route' => 'admin.profiles.edit',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}

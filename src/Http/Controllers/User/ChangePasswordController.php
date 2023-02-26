<?php

namespace Vxize\Lavx\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Vxize\Lavx\Events\UserPasswordChanged;
use Vxize\Lavx\Http\Controllers\ResourceController;

class ChangePasswordController extends ResourceController
{
    protected 
        $rules = [
            'current_password' => 'required|string|min:8|current_password',
            'new_password' => 'required|string|confirmed|min:8|different:current_password',
            'new_password_confirmation' => 'required|string|min:8',
        ],
        $titles = [
            'create' => 'lavx::user.reset_password',
        ],
        $path = 'change-password',
        $name = 'change-password';

    public function create()
    {
        return $this->createRecord([
            'form' => 'lavx::forms.users.change-password',
            'return' => route('settings'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate($this->rules);
        $user = $request->user();
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);
        event(new UserPasswordChanged($user, $request->ip()));
        return redirect()->route('form.result')
            ->with('success', __('lavx::form.save_success'))
            ->with('return', route('settings'));
    }

}

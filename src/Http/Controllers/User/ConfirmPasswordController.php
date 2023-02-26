<?php

namespace Vxize\Lavx\Http\Controllers\User;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Vxize\Lavx\Events\UserPasswordConfirmed;
use Vxize\Lavx\Events\UserPasswordConfirmFailed;
use Vxize\Lavx\Http\Controllers\ResourceController;

class ConfirmPasswordController extends ResourceController
{

    public function create()
    {
        return $this->createRecord([
            'form' => 'lavx::forms.users.confirm-password',
            'alert' => __('lavx::user.confirm_password_message'),
            'action' => route('password.confirm'),
            'show_return' => false,
            'title' => __('lavx::user.confirm_password'),
            'submit_icon' => 'check',
            'submit_text' => 'lavx::user.confirm_password',
        ]);
    }

    public function store(Request $request)
    {
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            event(new UserPasswordConfirmFailed($request));
            throw ValidationException::withMessages([
                'password' => __('lavx::user.password_incorrect'),
            ]);
        }
        $request->session()->put('auth.password_confirmed_at', time());
        event(new UserPasswordConfirmed($request));
        return redirect()->intended(RouteServiceProvider::HOME);
    }

}

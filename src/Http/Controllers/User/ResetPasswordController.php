<?php

namespace Vxize\Lavx\Http\Controllers\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Vxize\Lavx\Events\UserPasswordReset;
use Vxize\Lavx\Http\Controllers\ResourceController;

class ResetPasswordController extends ResourceController
{

    public function create(Request $request)
    {
        return $this->createRecord([
            'form' => 'lavx::forms.users.reset-password',
            'form_data' => [
                'request' => $request,
            ],
            'alert' => __('lavx::user.reset_password_input'),
            'action' => route('password.update'),
            'show_return' => false,
            'title' => __('lavx::user.reset_password'),
            'submit_icon' => 'fa6-solid:key',
            'submit_text' => 'lavx::user.reset_password',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRule::min(8)],
        ]);
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();
                event(new UserPasswordReset($user, $request->ip()));
            }
        );
        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }

}

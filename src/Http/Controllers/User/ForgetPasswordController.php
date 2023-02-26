<?php

namespace Vxize\Lavx\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Vxize\Lavx\Http\Controllers\ResourceController;

class ForgetPasswordController extends ResourceController
{

    public function create()
    {
        return $this->createRecord([
            'form' => 'lavx::forms.users.forget-password',
            'alert' => __('lavx::user.reset_password_instruction'),
            'action' => route('password.request'),
            'show_return' => false,
            'title' => __('lavx::user.forget_password'),
            'submit_icon' => 'key',
            'submit_text' => 'lavx::user.reset_password',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }

}

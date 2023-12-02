<?php

namespace Vxize\Lavx\Http\Controllers\User;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Vxize\Lavx\Http\Controllers\ResourceController;
use Vxize\Lavx\Http\Requests\LoginRequest;

class LoginController extends ResourceController
{

    public function create(Request $request)
    {
        return $this->createRecord([
            'form' => 'lavx::forms.users.login',
            'alert' => $request->session()->has('status')
                ? ''
                : __('lavx::user.login_with_email_password'),
            'action' => route('login'),
            'show_return' => false,
            'title' => __('lavx::user.login'),
            'error_title' => 'lavx::user.login_failed',
            'submit_icon' => 'fa6-solid:right-to-bracket',
            'submit_text' => 'lavx::user.login',
        ]);
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

}

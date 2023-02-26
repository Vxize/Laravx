<?php

namespace Vxize\Lavx\Http\Controllers\User;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Vxize\Lavx\Events\UserRegistered;
use Vxize\Lavx\Http\Controllers\ResourceController;

class SignUpController extends ResourceController
{

    public function create()
    {
        return $this->createRecord([
            'form' => 'lavx::forms.users.signup',
            'alert' => __('lavx::user.recommend_gmail'),
            'alert_color' => 'red',
            'action' => route('signup'),
            'show_return' => false,
            'title' => __('lavx::user.register'),
            'submit_icon' => 'user-plus',
            'submit_text' => 'lavx::user.register',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);
        $user = User::create([
            'name' => $request->name ?? '',
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
        ]);
        event(new UserRegistered($user, $request->ip()));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }

}

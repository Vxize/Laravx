<?php

namespace Vxize\Lavx\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vxize\Lavx\Events\UserLogout;
use Vxize\Lavx\Http\Controllers\ResourceController;

class LogoutController extends ResourceController
{

    public function destroy(Request $request)
    {
        $user = $request->user();
        $ip = $request->ip();
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        event(new UserLogout($user, $ip));
        return redirect('/');
    }

}

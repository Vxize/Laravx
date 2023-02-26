<?php

namespace Vxize\Lavx\Http\Controllers\User;

use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Vxize\Lavx\Events\UserEmailVerified;
use Vxize\Lavx\Http\Controllers\ResourceController;

class EmailVerificationController extends ResourceController
{

    // display email verification notice
    public function notice(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::HOME)
                    : view('lavx::users.verify-email');
    }

    // send out email verification notification
    public function send(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    }

    // verify email 
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        event(new UserEmailVerified($request));    
        return redirect(RouteServiceProvider::HOME.'?verified=1');
    }

}

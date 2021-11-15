<?php

namespace Vxize\Lavx\Http\Controllers\User;

use Illuminate\Http\Request;
use Vxize\Lavx\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ChangeEmailNotification;

class ChangeEmailController extends ResourceController
{

    protected 
        $rules = [
            'email' => 'required|string|email|max:255|unique:users',
        ],
        $titles = [
            'create' => 'lavx::user.change_email',
        ],
        $path = 'change-email',
        $name = 'user.email';

    public function create()
    {
        return $this->createRecord([
            'form' => 'lavx::forms.users.change-email',
            'return' => route('settings'),
            'alert' => __('lavx::user.recommend_gmail'),
            'alertColor' => 'red',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate($this->rules);
        Notification::route('mail', $request->email)
            ->notify(new ChangeEmailNotification($request->email));
        return redirect()->route('form.result')
            ->with('success', __('lavx::user.verification_link_sent'))
            ->with('return', route('settings'));
    }

    public function verify(Request $request)
    {
        $request->validate($this->rules);
        $user = $request->user();
        $user->update([
            'email' => strtolower($request->email),
        ]);
        $user->markEmailAsVerified();
        return redirect()->route('form.result')
            ->with('success', __('lavx::email.update_success'))
            ->with('return', route('settings'));
    }


}

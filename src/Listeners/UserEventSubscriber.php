<?php

namespace Vxize\Lavx\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class UserEventSubscriber
{
    
    public function logEmailChange($event)
    {
        activity('user')->event('UserEmailChanged')
            ->withProperties([
                'ip' => $event->ip,
                'email' => $event->user->email,
            ])->log('Email changed to :properties.email (:properties.ip)');
    }

    public function logEmailVerified($event)
    {
        $user = $event->request->user();
        activity('user')->event('UserEmailVerified')->by($user)
            ->withProperties([
                'ip' => $event->request->ip(),
            ])->log('Email verified: :causer.email (:properties.ip)');
    }

    public function logLeaveImpersonation($event)
    {
        activity('user')->event('UserLeaveImpersonation')
            ->on($event->impersonated)->by($event->impersonator)
            ->withProperties(['ip' => request()->ip()])
            ->log(':causer.email left impersonation of :subject.email (:properties.ip)');
    }

    public function logTakeImpersonation($event)
    {
        activity('user')->event('UserTakeImpersonation')
            ->on($event->impersonated)->by($event->impersonator)
            ->withProperties(['ip' => request()->ip()])
            ->log(':causer.email took impersonation of :subject.email (:properties.ip)');
    }

    public function logLockout($event)
    {
        $email = strtolower($event->request->email);
        $user = User::firstWhere('email', $email);
        return $user
            ? activity('user')->event('Lockout')->by($user)
                ->withProperties(['ip' => $event->request->ip()])
                ->log('Lockout: :causer.email (:properties.ip)')
            : activity('lockout')->event('Lockout')
                ->withProperties([
                    'ip' => $event->request->ip(),
                    'email' => $email,
                ])->log('Lockout: :properties.email (:properties.ip)')
            ;
    }

    public function logLogin($event)
    {
        $remember = $event->request->boolean('remember') ? ' with remember' : '';
        activity('user')->event('UserLogin')
            ->withProperties(['ip' => $event->request->ip()])
            ->log('Login: :causer.email (:properties.ip)'.$remember);
    }

    public function logLoginFailed($event)
    {
        $email = strtolower($event->request->email);
        $user = User::firstWhere('email', $email);
        return $user
            ? activity('user')->event('LoginFailed')->by($user)
                ->withProperties(['ip' => $event->request->ip()])
                ->log('Login failed: :causer.email (:properties.ip)')
            : activity('login')->event('LoginFailed')
                ->withProperties([
                    'ip' => $event->request->ip(),
                    'email' => $email,
                ])->log('Login failed: :properties.email (:properties.ip)')
            ;
    }

    public function logLogout($event)
    {
        activity('user')->event('UserLogout')->by($event->user)
            ->withProperties(['ip' => $event->ip])
            ->log('Logout: :causer.email (:properties.ip)');
    }

    public function logPasswordChange($event)
    {
        activity('user')->event('UserPasswordChanged')
            ->withProperties(['ip' => $event->ip])
            ->log('Password changed: :causer.email (:properties.ip)');
    }

    public function logPasswordConfirmed($event)
    {
        $user = $event->request->user();
        activity('user')->event('UserPasswordConfirmed')->by($user)
            ->withProperties([
                'ip' => $event->request->ip(),
            ])->log('Password confirmed: :causer.email (:properties.ip)');
    }

    public function logPasswordConfirmFailed($event)
    {
        $user = $event->request->user();
        activity('user')->event('UserPasswordConfirmFailed')->by($user)
            ->withProperties([
                'ip' => $event->request->ip(),
            ])->log('Password confirm failed: :causer.email (:properties.ip)');
    }

    public function logPasswordReset($event)
    {
        activity('user')->event('UserPasswordReset')->by($event->user)
            ->withProperties(['ip' => $event->ip])
            ->log('Password reset: :causer.email (:properties.ip)');
    }

    public function logPermissionAssigned($event)
    {
        activity('user')->event('UserPermissionAssigned')
            ->on($event->assignee)->by($event->assigner)
            ->withProperties([
                'ip' => $event->ip,
                'permissions' => $event->permissions
            ])->log('Permissions assigned to :subject.email by :causer.email (:properties.ip)');
    }

    public function logRegistered($event)
    {
        if ($event->user instanceof MustVerifyEmail
            && ! $event->user->hasVerifiedEmail()
        ) {
            $event->user->sendEmailVerificationNotification();
        }
        activity('user')->event('UserRegistered')->by($event->user)
            ->withProperties(['ip' => $event->ip])
            ->log('Registered: :causer.email (:properties.ip)');
    }

    public function logRoleAssigned($event)
    {
        activity('user')->event('UserRoleAssigned')
            ->on($event->assignee)->by($event->assigner)
            ->withProperties([
                'ip' => $event->ip,
                'roles' => $event->roles
            ])->log('Roles assigned to :subject.email by :causer.email (:properties.ip)');
    }

    public function subscribe($events)
    {
        return [
            'Illuminate\Auth\Events\Lockout' => 'logLockout',
            'Lab404\Impersonate\Events\LeaveImpersonation' => 'logLeaveImpersonation',
            'Lab404\Impersonate\Events\TakeImpersonation' => 'logTakeImpersonation',
            'Vxize\Lavx\Events\UserEmailChanged' => 'logEmailChange',
            'Vxize\Lavx\Events\UserEmailVerified' => 'logEmailVerified',
            'Vxize\Lavx\Events\UserLogin' => 'logLogin',
            'Vxize\Lavx\Events\UserLoginFailed' => 'logLoginFailed',
            'Vxize\Lavx\Events\UserLogout' => 'logLogout',
            'Vxize\Lavx\Events\UserPasswordChanged' => 'logPasswordChange',
            'Vxize\Lavx\Events\UserPasswordConfirmed' => 'logPasswordConfirmed',
            'Vxize\Lavx\Events\UserPasswordConfirmFailed' => 'logPasswordConfirmFailed',
            'Vxize\Lavx\Events\UserPasswordReset' => 'logPasswordReset',
            'Vxize\Lavx\Events\UserPermissionAssigned' => 'logPermissionAssigned',
            'Vxize\Lavx\Events\UserRegistered' => 'logRegistered',
            'Vxize\Lavx\Events\UserRoleAssigned' => 'logRoleAssigned',
        ];
    }
}

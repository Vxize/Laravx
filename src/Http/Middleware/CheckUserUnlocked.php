<?php

namespace Vxize\Lavx\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserUnlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user->unlocked_at && $user->unlocked_at > now()) {
            return response()->view('lavx::alert', [
                'title' => __('lavx::user.account_locked'),
                'alert' => __('lavx::user.account_locked_message'),
                'alert_color' => 'red',
            ]);
        }
        return $next($request);
    }
}

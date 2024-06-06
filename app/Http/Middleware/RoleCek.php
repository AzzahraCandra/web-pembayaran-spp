<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleCek
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        $user = Auth::user();

        if (in_array($user->level, $levels)) {
            return $next($request);
        }

        // if (in_array($request->user()->level, $levels)) {
        //     return $next($request);
        // }

        // Redirect based on user level
        // if ($request->user()->level == 'admin') {
        //     return redirect('main-page');
        // } else {
        //     return redirect('other-page');
        // }

        // Redirect based on user level
        switch ($user->level) {
            case 'admin':
                return redirect()->route('main-page');
            case 'bendahara':
                return redirect()->route('bendahara-page');
            case 'kepsek':
                return redirect()->route('kepsek-page');
            default:
                return redirect('/');
        }
    }
}

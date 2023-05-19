<?php

namespace Auth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authenticated
{
    const LOGIN_ROUTE_NAME_GET = 'wadmin::auth.login.get';
    const LOGIN_ROUTE_NAME_POST = 'wadmin::auth.login.post';


    public function handle(Request $request, Closure $next, $guard = null)
    {
        $currentRouteName = $request->route()->getName();
        if ($currentRouteName == $this::LOGIN_ROUTE_NAME_GET || $currentRouteName == $this::LOGIN_ROUTE_NAME_POST
        ) {
            return $next($request);
        }

        if (is_in_dashboard()) {
            if (auth('wadmin')->guest()) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response('Unauthorized.', \Constants::UNAUTHORIZED_CODE);
                }
                return redirect()->guest(route($this::LOGIN_ROUTE_NAME_GET));
            }
        }

//		if (auth('nqadmin')->check()) {
//			$checkPerms = auth()->user()->can('access_dashboard');
//			return redirect()->guest(route('nqadmin::dashboard.index.get'));
//		}


        return $next($request);
    }
}

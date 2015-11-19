<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\SessionManager;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //Not working, why? (Session null);
        $session_info = SessionManager::getSessionInfo();        
        if (is_null($session_info)) {                    
            return $next($request);
        }
        echo 'session not null';
        return redirect('/');
    }
}

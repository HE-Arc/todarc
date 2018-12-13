<?php

namespace App\Http\Middleware;

use Closure;

use App\Organisation;
use App\User;
use App\Exceptions\Handler;

use Illuminate\Support\Facades\Auth;

class CheckHasProjectRights
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
        $user = Auth::user();

        $organisation = $request->route('organisation');

        if(!$organisation || $organisation->contains($user))
        {
          return $next($request);
        }
        else
        {
           abort(403, 'Access denied');
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

use App\Project;
use App\User;
use App\Organisation;
use App\Exceptions\Handler;

use Illuminate\Support\Facades\Auth;

class CheckOwner
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

        $project = $request->route('project');

        if($project && ($project->Owner->is($user) || $user->organisations->contains($project->Owner)))
        {
          return $next($request);
        }
        else
        {
           abort(403, 'Access denied');
        }
    }
}

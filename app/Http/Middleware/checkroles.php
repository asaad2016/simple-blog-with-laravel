<?php

namespace App\Http\Middleware;

use Closure;


class checkroles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
      if($request->user() === null){
        return redirect("/posts");
      }
      $actions =$request->route()->getAction();
      $roles=isset($actions['roles']) ? $actions['roles'] : null;
      if($request->user()->hasRoles($roles)){
        return $next($request);
      }
       return redirect("/access-denied");
    }
}
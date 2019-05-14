<?php

namespace App\Http\Middleware;
use Closure;
use App\Roles;
class RoleMiddleware
{
   
    public function handle($request, Closure $next)
    {
        
       $actions=$request->route()->getAction();
       $roles=isset($actions['roles']) ? $actions['roles'] : null;

      if($request->user()->hasAnyRole($roles) )
       {
           return $next($request);
       }
       return abort(401);


       
   }
   
}


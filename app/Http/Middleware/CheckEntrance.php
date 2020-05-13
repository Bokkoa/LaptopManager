<?php

namespace App\Http\Middleware;
use App\Entrance;

use Closure;

class CheckEntrance
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
        $host = gethostname();

        if(\Auth::user())
        {
            return $next($request);
            
        }else{

            if(\App\Entrance::where('hostname', $host)->exists()){
                return $next($request);
            }
            
        }

        return redirect('login');
    }
}

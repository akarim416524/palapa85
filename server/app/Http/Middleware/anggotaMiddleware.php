<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class anggotaMiddleware
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
         if (!Auth::check()) {
           return redirect('/')->with('ERR', 'Tidak Memiliki Hak Akses.');
         }

         if (Auth::user()->hak_akses != 'anggota') {
             return redirect()->back()->with('ERR', 'Tidak Memiliki Hak Akses.');
         }
         return $next($request);
     }
}

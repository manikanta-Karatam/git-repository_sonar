<?php

namespace App\Http\Middleware;

use App\Models\LoginHistory;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class allowSingleLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
             // Check if the user is already authenticated in another session
                 $user= User::where('email', $request['email'])->first();
                 $loginhistory = loginHistory::where('session_id', $user['id'])->latest()->first();
                 if($loginhistory == null || $loginhistory['logout_time'] != null){
                    return $next($request);
                }
            return  redirect()->back()->withErrors(['error' => 'User Already LoggedIn']);  

     }
    }

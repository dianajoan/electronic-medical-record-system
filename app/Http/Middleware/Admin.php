<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Closure;

class Admin
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $user= User::find($user->id);
        if ($user && $user->roles()->where('role', 'admin')->exists()) {
            return $next($request);
        } else {
            request()->session()->flash('error', 'You do not have permission to access this page');
            return redirect()->route('home'); // Adjust this as necessary
        }
    }
}

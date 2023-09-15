<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class ManageProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = $request->route('id');
        $user = User::find($userId);

        if ($user && (auth()->user()->admin || $userId == auth()->user()->id)) {
            return $next($request);
        }

        return redirect('/');
    }
}

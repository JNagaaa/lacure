<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;


class CheckUserAndAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        

        $reservationId = $request->route('id');
        $reservation = Reservation::find($reservationId);

        \Log::info('Middleware CheckUserAndAdmin triggered');
\Log::info('Logged User ID: ' . auth()->user()->id);
\Log::info('Reservation ID: ' . $reservationId);
\Log::info('Is User Admin: ' . Auth::user()->admin);

        if ($reservation && (Auth::user()->admin == 1 || $reservation->users()->where('users.id', auth()->user()->id)->exists())) {
            return $next($request);
        }

        return redirect('/');
    }
}

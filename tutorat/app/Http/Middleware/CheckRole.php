<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Vérifie si l'utilisateur est connecté
        $user = $request->user();
        if (!$user) {
            // Si l'utilisateur n'est pas connecté et n'est pas déjà sur la page de connexion
            if (!$request->is('login')) {
                return redirect()->route('login'); // Rediriger vers la page de connexion
            }
        } else {
            // Vérifie si le rôle de l'utilisateur est autorisé
            if (!in_array($user->role, $roles)) {
                return redirect()->route('login'); // Rediriger vers la page de connexion
            }
        }
        return $next($request);
    }
}

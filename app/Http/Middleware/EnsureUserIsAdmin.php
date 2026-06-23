<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Allow only authenticated admins. Guests are redirected to login by the
     * `auth` middleware that runs before this one; authenticated non-admins
     * get a 403.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->is_admin) {
            abort(403, 'Admins only.');
        }

        return $next($request);
    }
}

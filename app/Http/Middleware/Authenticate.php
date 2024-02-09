<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }
        // Redirect to a 401 error page
       if ($request->is('api/*')) {
        abort(Response::HTTP_UNAUTHORIZED, 'Unauthorized');
       }

        return route('login');
    }
}

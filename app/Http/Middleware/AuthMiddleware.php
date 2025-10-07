<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Support\Redirect;
use Buki\Router\Http\Middleware;
use Illuminate\Support\Facades\Request;

class AuthMiddleware extends Middleware
{
    public function handle(Request $request): bool
    {
        if (User::isLoggedIn()) {
            Redirect::to_js(APP_URL);
            return false;
        }

        return true;
    }
}

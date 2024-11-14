<?php

namespace Middleware;

use Buki\Router\Http\Middleware;
use Illuminate\Support\Facades\Request;
use App\Classes\Redirect;
use Models\User;

class AuthMiddleware extends Middleware
{

    public function handle(Request $request): bool
    {
        if (User::isLoggedIn()) {
            // you can redirect another url here 
            // or 
            // you can write error message, view, json response, etc...
            Redirect::to_js(APP_URL);
            return false;
        }

        return true;
    }
}

<?php

namespace App\Http\Controllers;

use App\Support\Template;
use App\Models\User;
use Buki\Router\Http\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class IndexController extends Controller
{
    public function home()
    {
        $user = User::data();
        if ($user) {
            return !$user->is_onboarded
                ? Template::renderer('home', 'user/onboarding', ['user' => $user])
                : Template::renderer('home', 'user', ['user' => $user]);
        }

        return Template::renderer('home');
    }

    public function signIn()
    {
        $user = User::data();
        if ($user) {
            $response = new RedirectResponse(APP_URL);
            return $response;
        }

        return Template::renderer('sign-in');
    }

    public function signUp()
    {
        $user = User::data();
        if ($user) {
            $response = new RedirectResponse(APP_URL);
            return $response;
        }

        return Template::renderer('sign-up');
    }
}

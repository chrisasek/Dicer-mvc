<?php

namespace Controllers;

use App\Classes\Template;
use Buki\Router\Http\Controller;
use Models\User;
use Symfony\Component\HttpFoundation\RedirectResponse;

class IndexController extends Controller
{

    public function home()
    {
        $user = User::data();
        if ($user) {
            return !$user->is_onboarded ?
                Template::renderer('home', 'user/onboarding', ['user' => $user]) :
                Template::renderer('home', 'user', ['user' => $user]);
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


    // public static function create($name, $vote)
    // {
    //     $test = Test::create(['name' => $name, 'vote' => $vote]);
    //     return $test;
    // }
}

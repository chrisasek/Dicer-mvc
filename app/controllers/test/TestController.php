<?php

namespace Controllers;

use Models\Test;

class TestController
{


    public static function home()
    {
       return "Hello World";
    }

    public static function create($name, $vote)
    {
        $test = Test::create(['name' => $name, 'vote' => $vote]);
        return $test;
    }
}

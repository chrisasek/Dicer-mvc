<?php

namespace App\Http\Controllers\Test;

use App\Models\Test;

class TestController
{
    public static function home()
    {
        return 'Hello World';
    }

    public static function create($name, $vote)
    {
        return Test::create(['name' => $name, 'vote' => $vote]);
    }
}

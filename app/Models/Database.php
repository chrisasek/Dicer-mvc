<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public function __construct()
    {
        $capsule = new Capsule();
        $capsule->addConnection([
            'driver' => DBDRIVER,
            'host' => DBHOST,
            'database' => DBNAME,
            'username' => DBUSER,
            'password' => DBPASS,
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}

<?php

namespace Models;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public function __construct()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => DBDRIVER,
            'host' => DBHOST,
            'database' => DBNAME,
            'username' => DBUSER,
            'password' => DBPASS,
        ]);
        // Setup the Eloquent ORM… 
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}

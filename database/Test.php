<?php
require __DIR__ . '/../bootstrap/app.php';

use Illuminate\Database\Capsule\Manager as Capsule;
// use Illuminate\Support\Facades\Schema;

if (Capsule::schema()->hasTable('tests')) {
    Capsule::schema()->table('tests', function ($table) {
        $table->integer('votes')->after('name');
    });

    print_r('Table {tests} Updated!');
} else {
    Capsule::schema()->create('tests', function ($table) {
        $table->increments('id');
        $table->string('data');
        $table->timestamps();
    });

    print_r('Table {tests} Created!');
}

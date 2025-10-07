<?php
require __DIR__ . '/../bootstrap/app.php';

use Illuminate\Database\Capsule\Manager as Capsule;
// use Illuminate\Support\Facades\Schema;

if (Capsule::schema()->hasTable('users')) {
    Capsule::schema()->table('users', function ($table) {
        $table->json('preferences')->nullable()->after('preferences');
    });
    print_r('Table <i>{users}</i> Updated!');
} else {
    Capsule::schema()->create('users', function ($table) {
        $table->integer('id')->autoIncrement();
        $table->string('uid')->unique();
        $table->string('username')->unique();
        $table->string('email')->unique();
        $table->string('password');
        $table->string('first_name');
        $table->string('last_name');
        $table->string('name');
        $table->string('phone');
        $table->string('uid');
        $table->set('account_type', ['administrator', 'business', 'merchant'])->default('business');
        $table->string('email_token');
        $table->string('validations');
        $table->integer('user_group')->default(1);
        $table->rememberToken();
        $table->timestamps();
    });

    print_r('Table <i>{users}</i> Created!');
}

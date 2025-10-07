<?php

namespace App\Models;

use App\Support\Config;
use App\Support\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public static function me()
    {
        return !self::data() ?: self::find(self::data()->id);
    }

    public static function data_save($user)
    {
        if (Session::exists(Config::get('session/user'))) {
            Session::put(Config::get('session/user'), $user);
            return $user;
        }

        return false;
    }

    public static function data($bag = null)
    {
        if (Session::exists(Config::get('session/user'))) {
            $user = Session::get(Config::get('session/user'));
            return $bag ? $user->$bag : $user;
        }

        return false;
    }

    public static function isLoggedIn()
    {
        return Session::exists(Config::get('session/user'));
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }
}

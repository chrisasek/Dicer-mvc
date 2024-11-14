<?php

namespace Models;

use App\Classes\Config;
use App\Classes\Session;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

        return !User::data() ?: User::find(User::data()->id);
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
        if (Session::exists(Config::get('session/user'))) {
            return true;
        }
        return false;
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }
}

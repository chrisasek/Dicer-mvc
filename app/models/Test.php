<?php

namespace Models;

use \Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'tests';
    protected $fillable = ['name', 'votes'];
}

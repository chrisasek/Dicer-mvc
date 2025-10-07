<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $table = 'profiles';
    // protected $fillable = [
    //     'name', 'website', 'email', 'phone', 'status'
    // ];


    // Relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

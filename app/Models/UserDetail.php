<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'position',
        'enrollment',
        'bithdate',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

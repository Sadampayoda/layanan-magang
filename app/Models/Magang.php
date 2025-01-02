<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function user_magang()
    {
        return $this->hasMany(UserMagang::class);
    }

    public function syarat()
    {
        return $this->hasMany(Syarat::class);
    }
}

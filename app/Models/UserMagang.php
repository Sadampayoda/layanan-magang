<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMagang extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(related: User::class);
    }

    public function magang()
    {
        return $this->belongsTo(related: Magang::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Syarat extends Model
{
    protected $guarded = ['id'];

    public function magang()
    {
        return $this->belongsTo(Magang::class);
    }
}

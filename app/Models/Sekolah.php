<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $guarded = ['id'];

    public function jurusan()
    {
        return $this->hasMany(Jurusan::class);
    }

    public function biodata()
    {
        return $this->hasOne(Biodata::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsto(User::class);
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}

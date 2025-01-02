<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $guarded =['id'];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function biodata()
    {
        return $this->hasOne(Biodata::class);
    }
}

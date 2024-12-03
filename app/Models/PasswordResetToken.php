<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    protected $fillable = ['email','token','created_at'];

    protected $table = 'password_reset_tokens';
    public $timestamps = false;
    protected $keyType = 'string';
    protected $primaryKey ='email';
}
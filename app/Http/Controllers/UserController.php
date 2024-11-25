<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.profile.index');
    }

    public function form()
    {
        return view('auth.profile.form');
    }
}

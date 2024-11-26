<?php

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Models\UserMagang;
use Illuminate\Http\Request;

class UserMagangController extends Controller
{

    // public function
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.kegiatan.index',[
            'data' => Magang::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserMagang $userMagang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserMagang $userMagang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserMagang $userMagang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserMagang $userMagang)
    {
        //
    }
}

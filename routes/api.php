<?php

use App\Http\Controllers\Api\DashboardApiController;
use Illuminate\Http\Request;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::apiResource('data-magang',DashboardApiController::class);
Route::get('/sekolah/{id}/jurusan', function ($id) {
    // dd($id);
    $jurusans = Jurusan::where('sekolah_id', $id)->get(['id', 'name']);
    return response()->json($jurusans);
});

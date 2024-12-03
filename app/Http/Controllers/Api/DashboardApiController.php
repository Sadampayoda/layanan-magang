<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $years = collect(range(Carbon::now()->year - 10, Carbon::now()->year));

        $magangData = DB::table('magangs')
            ->join('user_magangs', 'magangs.id', '=', 'user_magangs.magang_id')
            ->where('user_magangs.status', 'Approved')
            ->whereBetween('user_magangs.updated_at', [
                Carbon::now()->subYears(10)->startOfYear(),
                Carbon::now()->endOfYear()
            ])
            ->select(DB::raw('YEAR(user_magangs.updated_at) as year'), 'magangs.jenis_magang', DB::raw('count(*) as count'))
            ->groupBy(DB::raw('YEAR(user_magangs.updated_at)'), 'magangs.jenis_magang')
            ->get();

        $data = [
            'years' => $years,
            'pkl' => [],
            'prakerin' => [],
            'magang' => []
        ];

        foreach ($magangData as $item) {
            if ($item->jenis_magang == 'PKL') {
                $data['pkl'][$item->year] = $item->count;
            } elseif ($item->jenis_magang == 'Prakerin') {
                $data['prakerin'][$item->year] = $item->count;
            } else {
                $data['magang'][$item->year] = $item->count;
            }
        }

        foreach ($years as $year) {
            $data['pkl'][$year] = $data['pkl'][$year] ?? 0;
            $data['prakerin'][$year] = $data['prakerin'][$year] ?? 0;
            $data['magang'][$year] = $data['magang'][$year] ?? 0;
        }

        return response()->json($data);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

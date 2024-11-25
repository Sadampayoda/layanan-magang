<?php

namespace App\Http\Controllers;

use App\Http\Requests\MagangUpdateStatusRequest;
use App\Models\{Magang};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        return view('auth.index',[
            'title' => 'dashboard'
        ]);
    }

    public function updateStatus(MagangUpdateStatusRequest $magangUpdateStatusRequest, int $id)
    {
        $data = Magang::findOrFail($id);

        $this->authorize('updateStatus',$data);

        $data->update([
            'status_pengajuan' => $magangUpdateStatusRequest->status_pengajuan
        ]);
        return back()->with('success','Status pengajuan berhasil di ubah');

    }
}

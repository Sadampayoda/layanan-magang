<?php

namespace App\Http\Controllers;

use App\Events\UserMagangEvent;
use App\Http\Requests\UserMagangCreateRequest;
use App\Http\Requests\UserMagangUpdateRequest;
use App\Models\Magang;
use App\Models\UserMagang;
use App\Repository\Interface\CrudInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class UserMagangController extends Controller
{

    protected $crud;
    use AuthorizesRequests;
    public function __construct(CrudInterface $crudInterface)
    {
        $this->crud = $crudInterface;
        $this->crud->setModel(UserMagang::class);
    }

    // public function
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view',UserMagang::class);

        $data = (auth()->user()->level == 'mahasiswa')
        ?  $this->crud->find('user_id',auth()->user()->id,['user','magang'])
        : Magang::where('user_id',auth()->user()->id)->where('status_pengajuan','Approved')->get();



        return view('auth.kegiatan.index',[
            'title' => 'kegiatan',
            'data' => $data,
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
    public function store(UserMagangCreateRequest $userMagangCreateRequest)
    {
        $this->authorize('create',UserMagang::class);
        $this->crud->create($userMagangCreateRequest->only(
            ['magang_id', 'user_id']
        ));
        return redirect()->route('kegiatan.index')->with('success', 'Anda telah berhasil mendaftarkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return view('auth.kegiatan.show',[
            'title' => 'kegiatan',
            'data' => $this->crud->find('user_id',$id,['user.biodata'])[0],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        return view('auth.kegiatan.edit',[
            'title' => 'kegiatan',
            'data' => $this->crud->find('magang_id',$id,['magang','user']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserMagangUpdateRequest $userMagangUpdateRequest, int $id)
    {
        $data = $this->crud->findId($id);
        // $this->authorize('updateStatus', $data);
        $data->update([
            'status' => $userMagangUpdateRequest->status
        ]);
        event(new UserMagangEvent($data));
        return back()->with('success', 'Status verifikasi berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserMagang $userMagang)
    {
        //
    }
}

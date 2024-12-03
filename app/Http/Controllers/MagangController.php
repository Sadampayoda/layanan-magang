<?php

namespace App\Http\Controllers;

use App\Http\Requests\MagangCreateRequest;
use App\Http\Requests\MagangUpdateRequest;
use App\Models\Magang;
use App\Models\User;
use App\Policies\MagangPolicy;
use App\Repository\Interface\CrudInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class MagangController extends Controller
{
    protected $crud;
    use AuthorizesRequests;

    public function __construct(CrudInterface $crudInterface)
    {
        $this->crud = $crudInterface;
        $this->crud->setModel(Magang::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Magang::class);
        if (auth()->user()->level == 'admin') {
            $data = $this->crud->find('name', auth()->user()->name, ['user']);
        } elseif (auth()->user()->level == 'opd') {
            $data = $this->crud->find('user_id', auth()->user()->id, ['user']);
        } else {
            $data = Magang::with(['user_magang'])
                ->whereDoesntHave('user_magang', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })->get();
            // dd($data);
            // dd($data);
        }
        return view('auth.magang.index', [
            'title' => 'magang',
            'magang' => $data,
            'opd' => User::where('level', 'opd')->get()
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
    public function store(MagangCreateRequest $magangCreateRequest)
    {
        $this->authorize('create', Magang::class);
        $this->crud->create($magangCreateRequest->only(
            ['name', 'user_id', 'jenis_magang', 'description', 'rentang_waktu_mulai', 'rentang_waktu_selesai']
        ));

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Magang $magang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Magang $magang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MagangUpdateRequest $magangUpdateRequest, int $id)
    {
        $this->authorize('update', $this->crud->findId($id));
        $this->crud->update($magangUpdateRequest->only(
            ['name', 'user_id', 'jenis_magang', 'description', 'rentang_waktu_mulai', 'rentang_waktu_selesai']
        ), $id);

        return back()->with('success', 'Data berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->authorize('delete', $this->crud->findId($id));
        $this->crud->delete($id);
        return back()->with('success', 'Data berhasil di hapus');
    }
}

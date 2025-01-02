<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpdCreateRequest;
use App\Http\Requests\OpdUpdateRequest;
use App\Models\Opd;
use App\Models\User;
use App\Repository\Interface\CrudInterface;
use Illuminate\Http\Request;

class OpdController extends Controller
{
    protected $crud;

    public function __construct(CrudInterface $crudInterface)
    {
        $this->crud = $crudInterface;
        $this->crud->setModel(Opd::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.opd.index',[
            'title' => 'opd',
            'opds' => User::with(['opd'])->where('level','opd')->get()
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
    public function store(OpdCreateRequest $opdCreateRequest)
    {
        $this->crud->create($opdCreateRequest->validated());
        return back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        // $data = $this->crud->find('user_id',$id,['user']);
        // dd($data);
        return view('auth.opd.show',[
            'title' => 'opd',
            'data' => $this->crud->find('user_id',$id,['user'])[0],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Opd $opd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OpdUpdateRequest $opdUpdateRequest, int $id)
    {
        $this->crud->update($opdUpdateRequest->validated(),$id);
        return back()->with('success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->crud->delete($id);
        return redirect()->route('opd.index')->with('success', 'Data berhasil dihapuskan');
    }
}

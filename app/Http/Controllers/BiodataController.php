<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use App\Http\Requests\BiodataCreateRequest;
use App\Http\Requests\BiodataUpdateRequest;
use App\Http\Requests\UserMagangUpdateRequest;
use App\Repository\Interface\CrudInterface;

class BiodataController extends Controller
{
    protected $crud;
    public function __construct(CrudInterface $crudInterface)
    {
        $this->crud = $crudInterface;
        $this->crud->setModel(Biodata::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.biodata.index',[
            'title' => 'form',
            'biodata' => $this->crud->findId(auth()->user()->id),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BiodataCreateRequest $biodataCreateRequest)
    {
        $this->crud->create($biodataCreateRequest->validated());
        return back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Biodata $biodata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Biodata $biodata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BiodataUpdateRequest $biodataUpdateRequest, int $id)
    {
        $data = $biodataUpdateRequest->validated();
        $this->crud->update($data,$id);
        return back()->with('success', 'Data berhasil diupdatekan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Biodata $biodata)
    {
        //
    }
}

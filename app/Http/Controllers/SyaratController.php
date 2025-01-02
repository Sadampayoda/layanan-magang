<?php

namespace App\Http\Controllers;

use App\Http\Requests\SyaratCreateRequest;
use App\Http\Requests\SyaratUpdateRequest;
use App\Models\Syarat;
use App\Repository\Interface\CrudInterface;
use Illuminate\Http\Request;

class SyaratController extends Controller
{
    protected $crud;

    public function __construct(CrudInterface $crudInterface)
    {
        $this->crud = $crudInterface;
        $this->crud->setModel(Syarat::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
    public function store(SyaratCreateRequest $syaratCreateRequest)
    {
        $this->crud->create(data: $syaratCreateRequest->validated());
        return back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Syarat $syarat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Syarat $syarat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SyaratUpdateRequest $syaratUpdateRequest, int $id)
    {
        $this->crud->update($syaratUpdateRequest->validated(),$id);
        return back()->with('success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->crud->delete($id);
        return back()->with('success', 'Data berhasil diedit');
    }
}

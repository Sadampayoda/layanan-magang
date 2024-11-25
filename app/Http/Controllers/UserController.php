<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repository\Interface\CrudInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $crud;

    public function __construct(CrudInterface $crudInterface)
    {
        $this->crud = $crudInterface;
        $this->crud->setModel(User::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.user.index',[
            'title' => 'user',
            'data' => $this->crud->all()
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
    public function store(UserCreateRequest $userCreateRequest)
    {
        $data = $userCreateRequest->only(['name','email','password','level']);
        $this->crud->create($data);

        return redirect()->route('users.index')->with('success','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $userUpdateRequest, string $id)
    {
        $this->crud->update($userUpdateRequest->only(['name','email','password','level']),$id);
        return back()->with('success','Data berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->crud->delete($id);
        return back()->with('success','Data berhasil di hapus');
    }
}

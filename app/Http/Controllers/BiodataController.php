<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Http\Requests\BiodataCreateRequest;
use App\Http\Requests\BiodataUpdateRequest;
use App\Http\Requests\UserMagangUpdateRequest;
use App\Models\User;
use App\Repository\Interface\CrudInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
        $data = User::with(['biodata'])->find(auth()->user()->id);
        // dd($);
        if($data->biodata)
        {
            return view('auth.biodata.edit',[
                'title' => 'form',
                'sekolahs' => Sekolah::all(),
                'biodata' => $this->crud->find('user_id',auth()->user()->id,['user'])[0]
            ]);
        }
        return view('auth.biodata.index',[
            'title' => 'form',
            'sekolahs' => Sekolah::all()
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
        $data = $biodataCreateRequest->validated();
        if ($biodataCreateRequest->hasFile('image')) {
            $image = $biodataCreateRequest->file('image');
            $path = 'formal';
            $data['image'] = $image->store($path,'public');
        }
        if ($biodataCreateRequest->hasFile('cv')) {
            $file = $biodataCreateRequest->file('cv');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('cv'), $filename);
            $data['cv'] = $filename;
        }
        $this->crud->create($data);
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
    public function edit(int $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BiodataUpdateRequest $biodataUpdateRequest, int $id)
    {
        $data = $biodataUpdateRequest->validated();
        $biodata = $this->crud->findId($id);
        if ($biodataUpdateRequest->hasFile('image')) {

            Storage::delete(paths: $biodata->image);
            $image = $biodataUpdateRequest->file('image');
            $data['image'] = $image->store('formal','public');

        }
        if ($biodataUpdateRequest->hasFile('cv')) {
            $filepath = public_path('cv/' . $biodataUpdateRequest['cv']);
            File::delete(paths: $filepath);
            $file = $biodataUpdateRequest->file('cv');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('cv'), $filename);
            $data['cv'] = $filename;

        }
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

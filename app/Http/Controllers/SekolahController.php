<?php

namespace App\Http\Controllers;

// use App\Models\Sekolah;
use App\Http\Requests\SekolahCreateRequest;
use App\Http\Requests\SekolahUpdateRequest;
use App\Repository\Interface\CrudInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SekolahController extends Controller
{
    protected $crud;

    public function __construct(CrudInterface $crudInterface)
    {
        $this->crud = $crudInterface;
        $this->crud->setModel(\App\Models\Sekolah::class);
    }

    public function index()
    {
        return view('auth.sekolah.index',[
            'data' => $this->crud->all(),
            'title' => 'sekolah'
        ]);
    }

    public function create()
    {
        return view('auth.sekolah.create',[
            'title' => 'sekolah'
        ]);
    }

    public function store(SekolahCreateRequest $sekolahCreateRequest)
    {
        $data = $sekolahCreateRequest->validated();

        $path = $sekolahCreateRequest->file('image')->store('sekolah', 'public');
        $data['image'] = $path;

        $this->crud->create($data);

        return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil ditambahkan!');
    }

    public function show($id)
    {
        $sekolah = $this->crud->findId($id,['jurusan']);
        return view('auth.sekolah.show',[
            'sekolah' => $sekolah,
            'title' => 'sekolah'
        ]);
    }

    public function edit($id)
    {
        $sekolah = $this->crud->findId($id);
        return view('auth.sekolah.edit',[
            'sekolah' => $sekolah,
            'title' => 'sekolah'
        ]);
    }

    public function update(SekolahUpdateRequest $sekolahUpdateRequest, $id)
    {


        $data = $sekolahUpdateRequest->validated();
        if ($sekolahUpdateRequest->hasFile('image')) {
            $sekolah = $this->crud->findId($id);
            Storage::disk('public')->delete($sekolah->image);
            $path = $sekolahUpdateRequest->file('image')->store('sekolah', 'public');
            $data['image'] = $path;
        }

        $this->crud->update( $data,$id);

        return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $sekolah = $this->crud->findId($id);
        Storage::disk('public')->delete($sekolah->image);

        $this->crud->delete($id);

        return redirect()->route('sekolah.index')->with('success', 'Sekolah berhasil dihapus!');
    }
}

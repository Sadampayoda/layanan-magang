<?php

namespace App\Http\Controllers;

use App\Events\MagangEvent;
use App\Http\Requests\MagangCreateRequest;
use App\Http\Requests\MagangUpdateRequest;
use App\Models\Magang;
use App\Models\User;
use App\Models\UserMagang;
use App\Policies\MagangPolicy;
use App\Repository\Interface\CrudInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            $data = $this->crud->all();
        } elseif (auth()->user()->level == 'opd') {
            $data = $this->crud->find('user_id', auth()->user()->id, ['user']);
        } else {
            $count = UserMagang::with(['user', 'magang'])->where('user_id', auth()->user()->id)
                ->where('ambil', 'Approved')->count();
            $data = Magang::with(['user_magang', 'syarat'])
                ->whereDoesntHave('user_magang', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })->get();
            if ($count > 0) {
                $data = [];
            }


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

        $data = $magangCreateRequest->validated();
        if ($magangCreateRequest->hasFile('image')) {
            $image = $magangCreateRequest->file('image');
            $path = 'magang';
            $data['image'] = $image->store($path, 'public');
        }
        $magang = $this->crud->create($data);
        event(new MagangEvent($magang));
        return back()->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        // return response()->json($this->crud->findId($id,['syarat','user.opd']));

        return view('auth.magang.show', [
            'title' => 'magang',
            'data' => $this->crud->findId($id, ['syarat', 'user.opd']),
        ]);
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
        $data = $magangUpdateRequest->validated();
        $magang = $this->crud->findId($id);
        if ($magangUpdateRequest->hasFile('image')) {

            Storage::delete(paths: $magang->image);
            $image = $magangUpdateRequest->file('image');
            $data['image'] = $image->store('magang', 'public');
        }
        $this->crud->update($data, $id);

        return back()->with('success', 'Data berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->authorize('delete', $this->crud->findId($id));
        $data = $this->crud->findId($id);

        if (Storage::exists($data->image)) {
            Storage::delete($data->image);
        }
        $this->crud->delete($id);
        return back()->with('success', 'Data berhasil di hapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Sekolah;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'sekolah_id' => 'required|exists:sekolahs,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Jurusan::create([
            'sekolah_id' => $request->sekolah_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('sekolah.show', $request->sekolah_id)
            ->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $jurusan->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('sekolah.show', $jurusan->sekolah_id)
            ->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $sekolahId = $jurusan->sekolah_id;

        $jurusan->delete();

        return redirect()
            ->route('sekolah.show', $sekolahId)
            ->with('success', 'Jurusan berhasil dihapus.');
    }
}

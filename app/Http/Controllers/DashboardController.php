<?php

namespace App\Http\Controllers;

use App\Events\MagangEvent;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\MagangUpdateStatusRequest;
use App\Models\{Magang, User};
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        return view('auth.index', [
            'title' => 'dashboard',
            'data' => User::where('level','mahasiswa')->paginate(5),
        ]);
    }

    public function data_form(int $id)
    {
        return view('auth.show',[
            'title' => 'dashboard',
            'data' => User::with(['biodata'])->find($id),
        ]);
    }

    public function updateStatus(MagangUpdateStatusRequest $magangUpdateStatusRequest, int $id)
    {
        $data = Magang::findOrFail($id);

        $this->authorize('updateStatus', $data);

        $data->update([
            'status_pengajuan' => $magangUpdateStatusRequest->status_pengajuan
        ]);
        event(new MagangEvent($data));
        return back()->with('success', 'Status pengajuan berhasil di ubah');
    }

    public function password()
    {
        return view('auth.password',[
            'title' => 'password'
        ]);
    }

    public function changePassword(ChangePasswordRequest $changePasswordRequest)
    {
        $validated = $changePasswordRequest->validated();
        if (!Hash::check($validated['current_password'], Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak cocok.']);
        }
        $user = Auth::user();
        $user->password = bcrypt($validated['new_password']);
        $user->save();
        return redirect()->route('password')->with('success', 'Password berhasil diubah!');
    }

    public function faq()
    {
        return view('auth.faq',['title' => 'faq']);
    }
    public function tentang()
    {
        return view('auth.tentang',['title' => 'tentang']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()->route('login')->with('message', 'Anda berhasil logout.');
    }
}

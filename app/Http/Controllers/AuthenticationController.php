<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\PasswordResetToken as MailPasswordResetToken;
use App\Models\PasswordResetToken;
use App\Models\User;
use App\Repository\Interface\CrudInterface;
// use App\Repository\CrudRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
    protected $crud;
    public function __construct(CrudInterface $crudInterface)
    {
        $this->crud = $crudInterface;
        $this->crud->setModel(model: User::class);
    }

    public function LoginPage()
    {
        return view('validation.login.index');
    }

    public function RegisterPage()
    {
        return view('validation.register.index');
    }

    public function LoginAuthentication(LoginRequest $loginRequest)
    {
        $credentials = $loginRequest->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $loginRequest->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('failed', 'Email dan password salah !');
    }

    public function RegisterAuthentication(RegisterRequest $registerRequest)
    {
        $account = $registerRequest->only(['name', 'email', 'password']);

        $this->crud->create($account);
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat');
    }

    public function forget_password()
    {
        return view('validation.forget-password.index');
    }

    public function forget_password_validation(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email'
        ]);

        $data = User::where('email', $request->email)->first();
        if (!$data) {
            return back()->with('failed', 'Akun belum terdaftar');
        }
        $token = rand(100000, 6000000);

        PasswordResetToken::updateOrCreate([
            'email' => $request->email
        ], [
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        Mail::to($request->email)->send(new MailPasswordResetToken($token));

        return back()->with('success', 'Cek email anda');
    }

    public function forget_password_reset($token)
    {
        $data = PasswordResetToken::where('token', $token)->first();
        if (!$data) {
            return abort(404);
        }
        return view('validation.forget-password.edit', [
            'token' => $token
        ]);
    }

    public function update_password(Request $request)
    {
        $validate = $request->validate([
            'token' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);
        $data = PasswordResetToken::where('token', $request->token)->first();


        User::where('email', $data->email)->update([
            'password' => bcrypt($validate['new_password'])
        ]);
        return redirect()->route('login')->with('success', 'Password berhasil diubah!');
    }
}

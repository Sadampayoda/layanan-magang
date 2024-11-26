<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repository\Interface\CrudInterface;
// use App\Repository\CrudRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


}

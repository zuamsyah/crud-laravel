<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login', ['errors' => '']);
    }

    public function login(Request $request)
    {
        $response = Http::post('http://localhost:3000/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $data = $response->json();

        if ($response->status() == 200 && isset($data['token'])) {
            // Simpan token di session
            session()->put('token', $data['token']);
        
            return redirect('/dashboard');
        }
        
        $errorMessages = [];
        if ($response->status() == 422) {
            $errorMessages = $data['errors'];
        } else if ($response->status() == 401) {
            $errorMessages['email'] = 'Email atau password salah.';
        } else {
            $errorMessages['general'] = 'Terjadi kesalahan saat melakukan login.';
        }
        
        return view('auth.login', [
            'errors' => $errorMessages,
        ]);
    }
}

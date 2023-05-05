<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        if(empty(session()->get('token'))) {
            return redirect()->route('login');
        }
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' .  session()->get('token'), // Ganti $token dengan token yang digunakan
        ])->get('http://localhost:3000/api/users');
        
        // Mengambil data response dalam bentuk array
        $users = $response->json();

        return view('user.index', compact('users'));
    }
}

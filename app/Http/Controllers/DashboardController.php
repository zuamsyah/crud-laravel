<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        if(empty(session()->get('token'))) {
            return redirect()->route('login');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session()->get('token'),
        ])->get('http://localhost:3000/api/students');
        
        $students = $response->json();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session()->get('token'),
        ])->get('http://localhost:3000/api/courses');
        
        $courses = $response->json();

        return view('dashboard.index', ['total_student' => count($students), 'total_course' => count($courses)]);
    }
}

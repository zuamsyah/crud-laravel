<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(empty(session()->get('token'))) {
            return redirect()->route('login');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session()->get('token'), // Ganti $token dengan token yang digunakan
        ])->get('http://localhost:3000/api/students');
        
        // Mengambil data response dalam bentuk array
        $students = $response->json();

        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session()->get('token'), // Ganti $token dengan token yang digunakan
        ])->get('http://localhost:3000/api/courses');

        $courses = $response->json();

        return view('student.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = session()->get('token');
        if(empty($token)) {
            return redirect()->withErrors('token not found');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('http://localhost:3000/api/students', [
            'name' => $request->name, 
            'email' => $request->email,
            'course_id' => (int) $request->course,
        ]);

        $student = $response->json();

        if($response->status() == 200 && $student) {
            return redirect()->route('students.index');
        }

        return redirect()->back()->withErrors($student['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session()->get('token'),
        ])->get('http://localhost:3000/api/students/'.$id);
        
        $students = $response->json();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session()->get('token'), // Ganti $token dengan token yang digunakan
        ])->get('http://localhost:3000/api/courses');

        $courses = $response->json();

        return view('student.edit', compact(['students', 'courses']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session()->get('token'),
        ])->put("http://localhost:3000/api/students/{$id}", [
            'name' => $request->name,
            'email' => $request->email,
            'course_id' => (int) $request->course,
        ]);

        $student = $response->json();
        if($response->status() == 200 && $student) {
            return redirect()->route('students.index');
        }

        return redirect()->back()->withErrors($student['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session()->get('token'),
        ])->delete("http://localhost:3000/api/students/{$id}");

        $student = $response->json();
        if($response->status() == 200 && $student) {
            return redirect()->route('students.index');
        }
    }
}

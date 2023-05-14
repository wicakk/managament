<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Models\Student;
use Illuminate\View\View;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():view
    {
        $students = Student::all();
        return view ('students.index')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():view
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $input = $request->all();
        Student::create($input);
        return redirect('student')->with('flash_message', 'Student Addedd!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):View
    {
        $student = Student::find($id);
        return view('students.show')->with('students', $student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id):View
    {
        $student = Student::find($id);
        return view('students.edit')->with('students', $student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):RedirectResponse
    {
        $student = Student::find($id);
        $input = $request->all();
        $student->update($input);
        return redirect('student')->with('flash_message', 'student Updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):RedirectResponse
    {
        Student::destroy($id);
        return redirect('student')->with('flash_message', 'Student deleted!');
    }
}

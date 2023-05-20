<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Student;
use Illuminate\View\View;

class StudentController extends Controller
{

    public function index(): View
    {
        $students = Student::all();
        return view('students.index')->with('students', $students);
    }


    public function create(): View
    {
        return view('students.index')->with('showModal', true);
    }

    public function store(Request $request): RedirectResponse
    {
        $input = $request->all();
        Student::create($input);
        return redirect('student')->with('flash_message', 'Student Added!');
    }

    public function show(string $id): View
    {
        $student = Student::find($id);
        return view('students.show')->with('student', $student);
    }

    public function edit(string $id): View
    {
        $student = Student::find($id);
        return view('students.index')->with('student', $student)->with('showModal', true);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $student = Student::find($id);
        $input = $request->all();
        $student->update($input);
        return redirect('student')->with('flash_message', 'student Updated!');
    }


    public function destroy(string $id): RedirectResponse
    {
        Student::destroy($id);
        return redirect('student')->with('flash_message', 'Student deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $existingStudent = Student::where('roll_no', $request->input('roll_no'))
            ->orWhere('email', $request->input('email'))
            ->first();

        $validated = $request->validate([
            'roll_no' => [
                'required',
                Rule::unique('students', 'roll_no')->ignore($existingStudent),
            ],
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('students', 'email')->ignore($existingStudent),
            ],
            'department' => 'required',
            'semester' => 'required|integer|min:1|max:12',
            'cgpa' => 'nullable|numeric|min:0|max:10',
        ]);

        $student = $existingStudent
            ? tap($existingStudent)->update($validated)
            : Student::create($validated);

        return redirect()
            ->route('students.show', $student)
            ->with('status', 'Student saved successfully!');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
    <h2>Student Details</h2>

    <p>Roll Number: {{ $student->roll_no }}</p>
    <p>Name: {{ $student->name }}</p>
    <p>Email: {{ $student->email }}</p>
    <p>Department: {{ $student->department }}</p>
    <p>Semester: {{ $student->semester }}</p>
    <p>CGPA: {{ $student->cgpa }}</p>

    <a href="{{ route('students.index') }}">Back</a>
@endsection

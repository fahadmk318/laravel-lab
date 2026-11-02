@extends('layouts.app')

@section('title', 'Student List')

@section('content')

    <h2>Student List</h2>

    <a href="{{ route('students.create') }}">Add Student</a>

    @foreach($students as $student)

        <div>
            <p>
                {{ $student->roll_no }} -
                {{ $student->name }}
            </p>

            <a href="{{ route('students.show', $student->id) }}">
                View Details
            </a>
        </div>

    @endforeach

@endsection

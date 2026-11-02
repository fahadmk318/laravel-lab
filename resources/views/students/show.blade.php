<!DOCTYPE html>
<html>
<head>
    <title>Student Details</title>
</head>
<body>
    <h1>Student Details</h1>

    <p>Roll Number: {{ $student->roll_no }}</p>
    <p>Name: {{ $student->name }}</p>
    <p>Email: {{ $student->email }}</p>
    <p>Department: {{ $student->department }}</p>
    <p>Semester: {{ $student->semester }}</p>
    <p>CGPA: {{ $student->cgpa }}</p>

    <a href="{{ route('students.index') }}">Back</a>
</body>
</html>

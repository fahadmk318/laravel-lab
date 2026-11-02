<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>
    <h1>Add New Student</h1>

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <input type="text" name="roll_no" placeholder="Roll Number" value="{{ old('roll_no') }}" required>
        <br><br>

        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
        <br><br>

        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        <br><br>

        <input type="text" name="department" placeholder="Department" value="{{ old('department', 'CSE') }}" required>
        <br><br>

        <input type="number" name="semester" placeholder="Semester" value="{{ old('semester', 7) }}" required>
        <br><br>

        <input type="number" step="0.01" name="cgpa" placeholder="CGPA" value="{{ old('cgpa') }}">
        <br><br>

        <button type="submit">Save Student</button>
    </form>
</body>
</html>

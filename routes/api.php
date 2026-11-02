<?php

use App\Models\Student;
use Illuminate\Support\Facades\Route;

Route::get('/students', function () {
    return response()->json(Student::all());
});

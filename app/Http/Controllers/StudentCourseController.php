<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    public function index($id)
    {
        $course = Course::get()->where('id', $id)->first();
        return view('student.class.index', compact('course'));
    }
}

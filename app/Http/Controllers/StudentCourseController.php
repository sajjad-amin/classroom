<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Member;
use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    public function index($id)
    {
        $course = Course::get()->where('id', $id)->first();
        return view('student.class.index', compact('course'));
    }

    public function listStudent($id)
    {
        $course = Course::get()->where('id', $id)->first();
        $members = Member::join('users', 'members.user_id', '=', 'users.id')
            ->where('members.course_id', $id)
            ->select('users.*')
            ->get();
        return view('student.class.students', compact('course', 'members'));
    }
}

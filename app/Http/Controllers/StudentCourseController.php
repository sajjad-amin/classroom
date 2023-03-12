<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\Member;
use App\Models\Post;
use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    public function index($id)
    {
        $student_id = auth()->user()->id;
        $section = Member::where('user_id', $student_id)->where('course_id', $id)->first()->section;
        $course = Course::get()->where('id', $id)->first();
        $posts = Post::where('course_id', $id)->where('section', $section)->get();
        $assignments = Assignment::where('course_id', $id)->where('section', $section)->get();
        return view('student.class.index', compact(['course', 'posts', 'section', 'assignments']));
    }

    public function listStudent($id)
    {
        $student_id = auth()->user()->id;
        $section = Member::where('user_id', $student_id)->where('course_id', $id)->first()->section;
        $course = Course::get()->where('id', $id)->first();
        $members = Member::join('users', 'members.user_id', '=', 'users.id')
            ->where('members.course_id', $id)->where('members.section', $section)->where('members.section', $section)
            ->select('users.*')
            ->get();
        return view('student.class.students', compact('course', 'members'));
    }
}

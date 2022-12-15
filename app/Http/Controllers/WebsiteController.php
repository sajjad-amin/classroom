<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function home(Request $request){
        $courses = [];
        if(auth()->user()){
            $courses = Course::join('members', 'members.course_id', '=', 'courses.id')
                ->where('members.user_id', auth()->user()->id)
                ->get();
        }
        return view('student.home', compact(['courses']));
    }
}

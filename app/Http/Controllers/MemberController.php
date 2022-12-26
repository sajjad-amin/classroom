<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        //
    }

    public function joinCourse(Request $request){
        $course = Course::get()->where('code', $request->code)->first();
        if($course){
            $member = new Member();
            $member->user_id = auth()->user()->id;
            $member->course_id = $course->id;
            $member->save();
            return redirect()->back()->with('success', 'You have successfully joined the class');
        }else{
            return redirect()->back()->with('error', 'Invalid class code');
        }
    }

    public function leaveCourse(Request $request){
        $course = Course::get()->where('code', $request->code)->first();
        if($course){
            $member = Member::get()->where('user_id', auth()->user()->id)->where('course_id', $course->id)->first();
            $member->delete();
            return redirect()->route('home')->with('success', 'You have successfully left the class');
        }else{
            return redirect()->back()->with('error', 'Invalid class code');
        }
    }
}

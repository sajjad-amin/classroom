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

    public function joinClass(Request $request){
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
}

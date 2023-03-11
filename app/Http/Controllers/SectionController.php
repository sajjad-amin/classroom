<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Member;
use App\Models\Post;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index($id, $section){
        $course = Course::where('id', $id)->first();
        $posts = Post::whereCourseId($course->id)->whereSection($section)->orderBy('id', 'desc')->get();
        return view('teacher.class.section', compact(['course', 'posts', 'section']));
    }

    public function addSection($id){
        $course_id = $id;
        $name = $_POST['name'];
        $description = $_POST['description'];
        $course = Course::where('id', $course_id)->first();
        $sections = $course->sections;
        if($sections){
            $section_object = json_decode($sections);
            $section_object[] = [
                'name' => $name,
                'description' => $description
            ];
            $section_object = json_encode($section_object);
            $course->sections = $section_object;
            $course->save();
        }else{
            $section_object[] = [
                'name' => $name,
                'description' => $description
            ];
            $section_object = json_encode($section_object);
            $course->sections = $section_object;
            $course->save();
        }
        return redirect()->back();
    }

    public function moveStudent(Request $request, $id){
        $course_id = $id;
        $student_id = $request->student_id;
        $section = $request->section;
        if(Member::where('user_id', $student_id)->where('course_id', $course_id)->update(['section' => $section])){
            return redirect()->back()->with('success', 'Student has been moved to the section '.$section);
        }else{
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}

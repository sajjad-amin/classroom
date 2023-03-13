<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\Member;
use App\Models\Post;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('teacher.class.index', compact(['courses']));
    }

    public function open($id){
        $course = Course::whereId($id)->first();
        $students = Member::join('users', 'members.user_id', '=', 'users.id')
            ->where('members.course_id', $id)
            ->select('users.*','members.section')->orderBy('members.section', 'asc')->get();
        return view('teacher.class.class', compact(['course', 'students']));
    }

    public function removeStudent(Request $request, $id)
    {
        $member = Member::where('user_id', $request->student_id)->where('course_id', $id)->first();
        $member->delete();
        return redirect()->back()->with('success', 'Student has been removed from the class');
    }

    public function create()
    {
        return view('teacher.class.new');
    }

    public function store(Request $request)
    {
        if(Course::whereCode($request->code)->count() == 0){
            $data = [
                'teacher_id' => Auth::user()->id,
                'code' => $request->code,
                'title' => $request->title,
                'description' => $request->description,
                'sections' => json_encode([
                    [
                        'name' => 'Section A',
                        'description' => 'This is the first section of the class'
                    ]
                ])
            ];
            if(Course::insert($data)){
                toastr()->success("class has been created!");
            }
            return redirect()->action([get_class($this), 'index']);
        }else{
            toastr()->error("Course code already exists!");
        }
        return redirect()->action([get_class($this), 'create']);
    }

    public function edit($id)
    {
        $course = Course::whereId($id)->first();
        return view('teacher.class.edit', compact(['course']));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $data = [
            'title' => $request->title,
            'description' => $request->description
        ];
        if(Course::whereId($id)->update($data)){
            toastr()->success("class has been updated!");
        }
        return redirect()->action([get_class($this), 'index'],['id' => $id]);
    }

    public function delete(Request $request)
    {
        $posts = Post::whereCourseId($request->id)->get();
        $assignments = Assignment::whereCourseId($request->id)->get();
        $submissions = Submission::whereCourseId($request->id)->get();
        if(Course::whereId($request->id)->delete()){
            Post::whereCourseId($request->id)->delete();
            foreach ($posts as $post){
                Storage::delete($post->image);
            }
            Assignment::whereCourseId($request->id)->delete();
            foreach ($assignments as $assignment){
                Storage::delete($assignment->attachment);
            }
            Submission::whereCourseId($request->id)->delete();
            foreach ($submissions as $submission){
                Storage::delete($submission->file);
            }
            toastr()->success("class has been deleted!");
        }
        return redirect()->action([get_class($this), 'index']);
    }
}

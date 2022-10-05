<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class TeacherCourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('teacher.class.index', compact(['courses']));
    }

    public function create()
    {
        return view('teacher.class.new');
    }

    public function store(Request $request)
    {
        $data = [
            'code' => $request->code,
            'title' => $request->title,
            'description' => $request->description
        ];
        if(Course::insert($data)){
            toastr()->success("class has been created!");
        }
        return redirect()->action([get_class($this), 'index']);
    }

    public function edit()
    {
        return "edit";
    }

    public function update()
    {
        //
    }

    public function delete()
    {
        return "delete";
    }
}

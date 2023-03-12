<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Carbon\Traits\Date;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index(Request $request, $id){
        $assignment = Assignment::where('id', $id)->first();
        return view('teacher.assignment.index', compact(['assignment']));
    }
    public function create(Request $request){
        $course_id = $request->course_id;
        $teacher_id = $request->teacher_id;
        $section = $request->section;
        $title = $request->title;
        $description = $request->description;
        $due_date = $request->due_date;
        $points = $request->points;
        $attachment = $request->file('attachment');
        if($course_id && $teacher_id && $section && $title && $description && $due_date && $points) {
            $assignment = new Assignment();
            $assignment->course_id = $course_id;
            $assignment->teacher_id = $teacher_id;
            $assignment->section = $section;
            $assignment->title = $title;
            $assignment->description = $description;
            $assignment->due_date = strtotime($due_date);
            $assignment->points = $points;
            if ($attachment) {
                $attachment_path = $attachment->storeAs('public/assignment-attachment', $attachment->getClientOriginalName());
                $assignment->attachment = $attachment_path;
            }
            if ($assignment->save()) {
                toastr()->success("Assignment has been created!");
            }
        }else{
            toastr()->error("Please fill all the fields!");
        }
        return redirect()->action([SectionController::class, 'index'],['id'=>$course_id, 'section'=>$section]);
    }

    public function edit($id){
        $assignment = Assignment::where('id', $id)->first();
        return view('teacher.assignment.edit', compact(['assignment']));
    }

    public function update(Request $request){
        $assignment_id = $request->id;
        $assignment = Assignment::where('id', $assignment_id)->first();
        $course_id = $assignment->course_id;
        $section = $assignment->section;
        $title = $request->title;
        $description = $request->description;
        $due_date = $request->due_date;
        $points = $request->points;
        $attachment = $request->file('attachment');
        if($assignment_id && $title && $description && $due_date && $points) {
            $assignment->title = $title;
            $assignment->description = $description;
            $assignment->due_date = strtotime($due_date);
            $assignment->points = $points;
            if ($attachment) {
                if ($assignment->attachment) {
                    unlink(storage_path('app/' . $assignment->attachment));
                }
                $attachment_path = $attachment->storeAs('public/assignment-attachment', $attachment->getClientOriginalName());
                $assignment->attachment = $attachment_path;
            }
            if ($assignment->save()) {
                toastr()->success("Assignment has been updated!");
            }
        }else{
            toastr()->error("Please fill all the fields!");
        }
        return redirect()->action([AssignmentController::class, 'edit'],['id'=>$assignment_id]);
    }

    public function delete(Request $request){
        $id = $request->id;
        $assignment = Assignment::where('id', $id)->first();
        if ($assignment->attachment) {
            unlink(storage_path('app/' . $assignment->attachment));
        }
        $assignment->delete();
        toastr()->success("Assignment has been deleted!");
        return redirect()->action([SectionController::class, 'index'],['id'=>$assignment->course_id, 'section'=>$assignment->section]);
    }
}

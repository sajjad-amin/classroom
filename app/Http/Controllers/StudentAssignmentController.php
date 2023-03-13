<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAssignmentController extends Controller
{
    public function index($id){
        $assignment = Assignment::where('id', $id)->first();
        $submission = Submission::where('student_id', Auth::user()->id)->where('assignment_id', $id)->first();
        $submissions = Submission::where('assignment_id', $id)->orderBy('score', 'desc')->get();
        return view('student.assignment.index', compact(['assignment', 'submission', 'submissions']));
    }

    public function submit(Request $request){
        $assignment_id = $request->id;
        $student_id = Auth::user()->id;
        $assignment = Assignment::where('id', $assignment_id)->first();
        $course_id = $assignment->course_id;
        $teacher_id = $assignment->teacher_id;
        $assignment_id = $assignment->id;
        $section = $assignment->section;
        $file = $request->file('file');
        $note = $request->note;
        $submitted_at = time();
        $submission = Submission::where('student_id', $student_id)->where('assignment_id', $assignment_id)->first();
        if($file) {
            if($submission){
                if($submission->file){
                    unlink(storage_path('app/'.$submission->file));
                    $submission->file = $file->storeAs('public/submitted-document', $file->getClientOriginalName());
                }
                $submission->note = $note;
                $submission->submitted_at = $submitted_at;
                if($submission->save()){
                    toastr()->success("Assignment has been submitted!");
                }else{
                    toastr()->error("Something went wrong!");
                }
            }else{
                $submission = new Submission();
                $submission->student_id = $student_id;
                $submission->course_id = $course_id;
                $submission->teacher_id = $teacher_id;
                $submission->assignment_id = $assignment_id;
                $submission->section = $section;
                $submission->file = $file->storeAs('public/submitted-document', $file->getClientOriginalName());
                $submission->note = $note ?? '';
                $submission->submitted_at = $submitted_at;
                if($submission->save()){
                    toastr()->success("Assignment has been submitted!");
                }else{
                    toastr()->error("Something went wrong!");
                }
            }
        }else{
            toastr()->error("Please select a file!");
        }
        return redirect()->action([StudentAssignmentController::class, 'index'],['id'=>$assignment_id]);
    }

    public function unsubmit(Request $request){
        $id = $request->id;
        $submission = Submission::where('id', $id)->first();
        unlink(storage_path('app/'.$submission->file));
        if($submission->delete()){
            toastr()->success("Assignment has been unsubmitted!");
        }else {
            toastr()->error("Something went wrong!");
        }
        return redirect()->action([StudentAssignmentController::class, 'index'],['id'=>$submission->assignment_id]);
    }
}

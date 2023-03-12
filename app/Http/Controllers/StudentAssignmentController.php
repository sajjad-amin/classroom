<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;

class StudentAssignmentController extends Controller
{
    public function index(Request $request, $id){
        $assignment = Assignment::where('id', $id)->first();
        return view('student.assignment.index', compact('assignment'));
    }
}

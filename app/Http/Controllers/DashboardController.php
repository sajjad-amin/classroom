<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $courses = Course::all();
        return view('teacher.dashboard.index', compact(['user', 'courses']));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function getMessages($course_id, $offset){
        $messages = Chat::where('course_id', $course_id)->offset($offset)->limit(10)->orderBy('id', 'asc')->get();
        return response()->json($messages);
    }

    public function send(Request $request){
        $user_id = $request->user_id;
        $course_id = $request->course_id;
        $message = $request->message;
        $section = $request->section;
        $inserted = Chat::insert([
            'user_id' => $user_id,
            'course_id' => $course_id,
            'section' => $section,
            'name' => $request->name,
            'message' => $message,
            'created_at' => now()
        ]);
        if($inserted){
            return response()->json([
                'status' => 'success',
                'message' => 'Message sent'
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Message not sent'
            ]);
        }
    }
}

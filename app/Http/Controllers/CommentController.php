<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function getComments($id){
        return Comment::wherePostId($id)->get();
    }

    public function create(Request $request)
    {
        $post_id = $request->post_id;
        $data = [
            'post_id' => $post_id,
            'user_id' => Auth::user()->id,
            'comment' => $request->comment,
            'created_at' => now(),
        ];
        Comment::insert($data);
        return redirect()->action([StudentPostController::class, 'index'],['id'=> $post_id]);
    }

    public function update(Request $request, Comment $comment)
    {
        //
    }
    public function destroy(Request $request)
    {
        $id = $request->id;
        $comment = Comment::whereId($id)->first();
        if(Comment::whereId($id)->delete()){
            toastr()->success("Comment has been deleted!");
        }
        return redirect()->action([StudentPostController::class, 'index'],['id'=> $comment->post_id]);
    }
}

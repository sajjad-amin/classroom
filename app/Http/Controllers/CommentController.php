<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getComments($id){
        return Comment::wherePostId($id)->get();
    }

    public function create()
    {
        //
    }

    public function update(Request $request, Comment $comment)
    {
        //
    }
    public function destroy(Comment $comment)
    {
        //
    }
}

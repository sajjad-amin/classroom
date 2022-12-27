<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;

class StudentPostController extends Controller
{
    public function index($id){
        $post = Post::whereCourseId($id)->first();
        $comments = Comment::wherePostId($post->id)->get();
        return view('student.post.index', compact(['post', 'comments']));
    }
}

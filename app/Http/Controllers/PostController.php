<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index($id)
    {
        $post = Post::whereId($id)->first();
        $comments = Comment::wherePostId($id)->get();
        return view('teacher.post.index', compact(['post', 'comments']));
    }

    public function create(Request $request){
        $cousre_id = $request->id;
        $section = $request->section;
        $data = [
            'course_id' => $cousre_id,
            'poster_id' => Auth::user()->id,
            'section' => $section,
            'text' => $request->text,
        ];
        if($request->hasFile("image")){
            $data['image'] = $request->image->store('public/post-image');
        }
        if(Post::insert($data)){
            toastr()->success("Post has been created!");
        }
        return redirect()->action([SectionController::class, 'index'],['id'=>$cousre_id, 'section'=>$section]);
    }

    public function edit($id){
        $post = Post::whereId($id)->first();
        return view('teacher.post.edit', compact(['post']));
    }

    public function update(Request $request){
        $id = $request->id;
        $comment_on = $request->comment_on;
        $data = [
            'text' => $request->text,
            'student_can_comment' => $comment_on,
        ];
        if($request->hasFile("image")){
            $post = Post::whereId($id)->first();
            Storage::delete($post->image);
            $data['image'] = $request->image->store('public/post-image');
        }
        if(Post::whereId($id)->update($data)){
            toastr()->success("Post updated!");
        }
        return redirect()->action([get_class($this), 'index'],['id'=>$id]);
    }

    public function delete(Request $request){
        $id = $request->id;
        $post = Post::whereId($id)->first();
        Storage::delete($post->image);
        if(Post::whereId($id)->delete()){
            toastr()->success("post has been deleted!");
        }
        return redirect()->action([SectionController::class, 'index'],['id' => $post->course_id, 'section' => $post->section]);
    }

    public function createComment(Request $request){
        $post_id = $request->post_id;
        $data = [
            'post_id' => $post_id,
            'user_id' => Auth::user()->id,
            'comment' => $request->comment,
            'created_at' => now(),
        ];
        Comment::insert($data);
        return redirect()->action([get_class($this), 'index'],['id'=> $post_id]);
    }

    public function deleteComment(Request $request){
        $id = $request->id;
        $comment = Comment::whereId($id)->first();
        if(Comment::whereId($id)->delete()){
            toastr()->success("Comment has been deleted!");
        }
        return redirect()->action([get_class($this), 'index'],['id'=> $comment->post_id]);
    }
}

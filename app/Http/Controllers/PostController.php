<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index($id)
    {
        $post = Post::whereId($id)->first();
        return view('teacher.post.index', compact(['post']));
    }

    public function create(Request $request){
        $cousre_id = $request->id;
        $data = [
            'course_id' => $cousre_id,
            'poster_id' => Auth::user()->id,
            'text' => $request->text,
        ];
        if($request->hasFile("image")){
            $data['image'] = $request->image->store('public/post-image');
        }
        if(Post::insert($data)){
            toastr()->success("Post has been created!");
        }
        return redirect()->action([CourseController::class, 'open'],['id'=>$cousre_id]);
    }

    public function edit($id){
        $post = Post::whereId($id)->first();
        return view('teacher.post.edit', compact(['post']));
    }

    public function update(Request $request){
        $id = $request->id;
        $data = [
            'text' => $request->text,
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
        return redirect()->action([CourseController::class, 'open'],['id' => $post->course_id]);
    }
}

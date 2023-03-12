@extends('layouts.app')
@section('title', \App\Models\Course::get()->where('id', $post->course_id)->first()->title)
@section('content')
    <div class="container mt-5">
        <div class="jumbotron">
            @if(isFileImage($post->image))
                <img src="{{str_replace('public', 'storage', asset($post->image))}}">
            @elseif($post->image)
                <a href="{{str_replace('public', 'storage', asset($post->image))}}" class="link">Download Attachment</a>
            @endif
            <p class="mt-3">{{$post->text}}</p>
        </div>
    </div>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Comments</h5>
                    </div>
                    <div class="card-body">
                        @if($post->student_can_comment)
                            <form method="POST" action="{{route('class.post.comment.create')}}">
                                @csrf
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                <div class="form-group">
                                    <textarea class="form-control" name="comment" placeholder="Write a comment" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Post</button>
                            </form>
                        @else
                            <div class="alert alert-warning">
                                <p class="mb-0">Teacher has disabled commenting on this post.</p>
                            </div>
                        @endif
                        <br><br>
                        <hr>
                        @foreach($comments as $comment)
                            @php
                                $commenter = \App\Models\User::get()->where('id', $comment->user_id)->first();
                            @endphp
                            <div class="card mb-3 @if($commenter->id == auth()->user()->id) bg-light @endif">
                            <div class="d-flex flex-row-reverse">
                                    @if($commenter->id == auth()->user()->id)
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" id="commentDropdownContextMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="commentDropdownContextMenu">
                                            <div class="dropdown-item">
                                                <form method="post" action="{{route('class.post.comment.delete')}}">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="id" value="{{$comment->id}}">
                                                    <button type="submit" class="btn btn-sm text-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="card-body">
                                        <p class="card-text">{!! str_replace("\n","<br>",$comment->comment) !!}</p>
                                        <p class="card-text"><small class="text-muted">Posted by <span class="font-weight-bold">{{$commenter->name}}</span> on {{$comment->created_at->format("d M, Y h:i A")}}</small></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection

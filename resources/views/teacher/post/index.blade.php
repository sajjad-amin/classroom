@extends('layouts.dashboard')
@section('title', \App\Models\Course::get()->where('id', $post->course_id)->first()->title)
@section('content')
    <div class="container mt-5">
        <div class="jumbotron">
            <div class="dropdown mb-5">
                <button class="btn btn-warning float-right" type="button" id="dashboardDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                <a href="{{route('dashboard.class.section.open',['id' => $post->course_id, 'section' => $post->section])}}" class="btn btn-primary float-right mr-2">Back</a>
                <div class="dropdown-menu" aria-labelledby="dashboardDropdown">
                    <a class="dropdown-item text-primary" href="{{route('dashboard.post.edit',['id'=>$post->id])}}">Edit</a>
                    <form method="POST" action="{{ route('dashboard.post.delete') }}" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value="{{$post->id}}">
                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                    </form>
                </div>
            </div>
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
                        <form method="POST" action="{{route('dashboard.post.comment.create')}}">
                            @csrf
                            <input type="hidden" name="post_id" value="{{$post->id}}">
                            <div class="form-group">
                                <textarea class="form-control" name="comment" placeholder="Write a comment" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Post</button>
                        </form>
                        <br><br>
                        <hr>
                        @foreach($comments as $comment)
                            @php
                            $commenter = \App\Models\User::get()->where('id', $comment->user_id)->first();
                            @endphp
                            <div class="card mb-3 @if($commenter->id == auth()->user()->id) bg-light @endif">
                                <div class="d-flex flex-row-reverse">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" id="commentDropdownContextMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="commentDropdownContextMenu">
                                            <div class="dropdown-item">
                                                <form method="post" action="{{route('dashboard.post.comment.delete')}}">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="id" value="{{$comment->id}}">
                                                    <button type="submit" class="btn btn-sm text-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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

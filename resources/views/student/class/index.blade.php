@extends('layouts.app')
@section('title', $course->title)
@section('content')
    <?php
    $posts = \App\Models\Post::whereCourseId($course->id)->orderBy('id', 'desc')->get();
    ?>
    <div class="container p-3">
        <div class="jumbotron">
            <h2>{{$course->title}}</h2>
            <div class="dropdown">
                <button class="btn btn-warning float-right" type="button" id="dashboardDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="dashboardDropdown">
                    <form method="POST" action="{{ route('class.leave') }}" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="code" value="{{$course->code}}">
                        <button type="submit" class="dropdown-item text-danger">Leave</button>
                    </form>
                </div>
            </div>
            <h6>Course Code: {{$course->code}}</h6>
            <p>{{$course->description}}</p>
        </div>
        @foreach($posts as $post)
            <div class="card post mt-3">
                <div class="card-body">
                    <p class="card-text">{{$post->text}}</p>
                    <a href="{{route('class.post.index', ['id' => $post->id])}}" class="mt-3">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection


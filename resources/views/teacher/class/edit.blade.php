@extends('layouts.dashboard')
@section('title', 'Edit | '.$course->title)
@section('content')
    <div class="container mt-5 mb-5">
        <div class="jumbotron">
            <a class="btn btn-primary" href="{{route('dashboard.class.open', ['id' => $course->id])}}">Back</a>
        </div>
        <form method="post" action="{{route('dashboard.class.update')}}">
            @method("put")
            @csrf
            <input type="hidden" name="id" value="{{$course->id}}">
            <div class="form-group">
                <label for="title">Title</label>
                <input name="title" type="text" class="form-control" id="title" value="{{$course->title}}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" rows="20" required>{{$course->description}}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
@section('script')
@endsection

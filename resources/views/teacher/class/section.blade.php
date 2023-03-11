@extends('layouts.dashboard')
@section('title', $course->title)
@section('content')
    @include('teacher.class.modal')
    <div class="container p-3">
        <div class="jumbotron">
            <h2>{{$course->title}} - Section {{$section}}</h2>
            <button class="btn btn-primary mr-2 float-right" data-toggle="modal" data-target="#newPost">New Post</button>
            <a href="{{route('dashboard.class.open', ['id' => $course->id])}}" class="btn btn-primary mr-2 float-right">Back</a>
            <h6>Course Code: {{$course->code}}</h6>
            <p>{{$course->description}}</p>
        </div>
        @foreach($posts as $post)
            <div class="card post mt-3">
                <div class="card-body">
                    <p class="card-text">{{$post->text}}</p>
                    <p class="card-text">
                        <small class="text-muted">Posted on {{$post->created_at->format("d M, Y h:i A")}}</small>
                    </p>
                    <a href="{{route('dashboard.post.open', ['id' => $post->id])}}" class="mt-3">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('script')
    <script>
        $('#image').on('change', function (e){
            const files = $(this).prop('files');
            if(files.length > 0){
                const file = files[0];
                const fileReader = new FileReader();
                fileReader.addEventListener('load', function (e){
                    $('#imageDisplay').attr('src', e.target.result);
                });
                fileReader.readAsDataURL(file);
            }else{
                $('#imageDisplay').attr('src', '');
            }
        });
    </script>
@endsection

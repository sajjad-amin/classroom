@extends('layouts.dashboard')
@section('title', 'Class')
@section('content')
    <div class="container-fluid p-3">
        <div class="d-flex flex-wrap">
            @foreach($courses as $course)
                <div class="card m-2" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$course->title}}</h5>
                        <p class="card-text">{{$course->description}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
@endsection

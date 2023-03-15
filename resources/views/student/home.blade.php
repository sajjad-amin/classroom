@extends('layouts.app')
@section('content')
    @include('student.class.modal.join')
    <section>
        @if(!\Illuminate\Support\Facades\Auth::user())
        <div class="introduction d-flex align-items-center justify-content-center">
            <h1 class="title">E-Coaching</h1>
            <div class="vibrate-1 mt-5">
                <div class="button" onclick="location.href='{{route('login')}}'">
                    JOIN NOW
                    <i class="fa fa-none"></i>
                </div>
            </div>
        </div>
        @endif
        <div class="container-fluid p-3">
            <div class="d-flex flex-wrap">
                @foreach($courses as $course)
                    <div class="card m-2" style="width: 18rem;">
                        <div class="card-body">
                            <a href="{{route('class.open', ['id'=>$course->course_id])}}">
                                <h5 class="card-title">{{$course->title}}</h5>
                            </a>
                            <p class="card-text">{{$course->description}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

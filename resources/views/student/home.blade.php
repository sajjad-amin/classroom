@extends('layouts.app')
@section('content')
    @include('student.class.modal.join')
    <section>
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

@extends('layouts.app')
@section('title', $course->title.' - Students')
@section('content')
    <div class="container p-3">
        <div class="jumbotron">
            <h2>{{$course->title}}</h2>
            <a href="{{route('class.open',['id' => $course->id])}}" type="button" class="btn btn-primary float-right mr-2">Back</a>
            <h6>Course Code: {{$course->code}}</h6>
            <p>{{$course->description}}</p>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Students</h5>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Joined</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $student)
                        <tr>
                            <td>{{$student->name}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{$student->created_at->format("d M, Y h:i A")}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
@endsection

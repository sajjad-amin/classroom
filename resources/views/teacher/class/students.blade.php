@extends('layouts.dashboard')
@section('title', $course->title.' - Students')
@section('content')
    @include('teacher.class.modal')
    <div class="container p-3">
        <div class="jumbotron">
            <h2>{{$course->title}}</h2>
            <a href="{{route('dashboard.class.open', ['id' => $course->id])}}" class="btn btn-primary float-right mr-2" type="button" >Back</a>
            <h6>Course Code: {{$course->code}}</h6>
            <p>{{$course->description}}</p>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Joined</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $student)
                        <tr>
                            <td>{{$student->name}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{$student->created_at->format("d M, Y h:i A")}}</td>
                            <td>
                                <form method="POST" action="{{route('dashboard.class.student.remove', ['id' => $course->id])}}" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="student_id" value="{{$student->id}}">
                                    <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
@endsection

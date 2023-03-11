@extends('layouts.dashboard')
@section('title', $course->title)
@section('content')
@include('teacher.class.sectionmodal')
    <div class="container p-3">
        <div class="jumbotron">
            <h2>{{$course->title}}</h2>
            <div class="dropdown">
                <button class="btn btn-warning float-right" type="button" id="dashboardDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="dashboardDropdown">
                    <a class="dropdown-item text-primary" href="{{route('dashboard.class.edit',['id'=>$course->id])}}">Edit</a>
                    <form method="POST" action="{{ route('dashboard.class.delete') }}" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value="{{$course->id}}">
                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                    </form>
                </div>
            </div>
            <button class="btn btn-primary mr-2 float-right" data-toggle="modal" data-target="#newSection">New Section</button>
            <h6>Course Code: {{$course->code}}</h6>
            <p>{{$course->description}}</p>
            <br><br>
            <h6>Sections</h6>
            <hr>
            <div class="d-flex align-items-center justify-content-center">
                @foreach(json_decode($course->sections) as $section)
                    <a href="{{route('dashboard.class.section.open', ['id' => $course->id, 'section' => $section->name])}}" class="btn btn-primary mr-2 ml-2">{{$section->name}}</a>
                @endforeach
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Section</th>
                        <th scope="col">Joined</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{$student->name}}</td>
                            <td>{{$student->email}}</td>
                            <td>{{$student->section}}</td>
                            <td>{{$student->created_at->format("d M, Y h:i A")}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-warning float-right" type="button" id="studentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                    <div class="dropdown-menu" aria-labelledby="studentDropdown">
                                        @foreach(json_decode($course->sections) as $section)
                                            <form method="POST" action="{{route('dashboard.class.student.move',['id'=>$course->id])}}">
                                                @csrf
                                                @METHOD('PUT')
                                                <input type="hidden" name="student_id" value="{{$student->id}}">
                                                <input type="hidden" name="section" value="{{$section->name}}">
                                                <button type="submit" class="dropdown-item text-primary">Move to Section {{$section->name}}</button>
                                            </form>
                                        @endforeach
                                        <form method="POST" action="{{route('dashboard.class.student.remove', ['id' => $course->id])}}" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="student_id" value="{{$student->id}}">
                                            <button type="submit" class="dropdown-item text-danger">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

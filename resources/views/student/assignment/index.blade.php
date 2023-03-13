@extends('layouts.app')
@section('title', $assignment->title)
@include('student.assignment.modal')
@section('content')
    <div class="container mt-5">
        <div class="jumbotron">
            <div class="dropdown mb-5">
                <a href="{{route('class.open',['id' => $assignment->course_id])}}" class="btn btn-primary float-right mr-2">Back</a>
            </div>
            <h1 class="display-4">{{$assignment->title}}</h1>
            <p class="lead">Due Date: {{date('d M Y, h:i A', $assignment->due_date)}}</p>
        </div>
    </div>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        @if($assignment->attachment)
                            <a href="{{str_replace('public', 'storage', asset($assignment->attachment))}}" class="link">Download Attachment</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{$assignment->description}}</p>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Leaderboard</h5>
                    </div>
                    <div class="card-body">
                        <table class="mt-3 table table-bordered">
                            <thead>
                            <tr>
                                <th>Position</th>
                                <th>Student</th>
                                <th>Score</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($submissions as $position => $sub)
                                @php
                                    $name = \App\Models\User::where('id', $sub->student_id)->first()->name;
                                @endphp
                                <tr>
                                    <td>{{$position+1}}</td>
                                    <td>{{$name}}</td>
                                    <td>{{$sub->score}}/{{$assignment->points}}</td>
                                    <td>{{date('d M Y, h:i A', $sub->submitted_at)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-4">
                <div class="card mt-3 mt-sm-0">
                    <div class="card-header">
                        <h5>Your Score</h5>
                    </div>
                    <div class="card-body">
                        @if($submission)
                            <h2 class="card-text text-center">{{$submission->score}}/{{$assignment->points}}</h2>
                            @if($submission->comment)
                                <hr>
                                <p class="card-text mt-3">{{$submission->comment}}</p>
                            @endif
                        @else
                            <div class="alert alert-warning" role="alert">
                                You haven't submitted your assignment yet. Please submit your assignment to get your score.
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Your Submission</h5>
                    </div>
                    <div class="card-body">
                        @if($submission)
                            <p class="card-text mt-3 mb-3"><span class="font-weight-bold">Submitted At: </span>{{date('d M Y, h:i A', $submission->submitted_at)}}</p>
                            <p class="card-text mt-3 mb-3"><span class="font-weight-bold">Attachment: </span><a href="{{str_replace('public', 'storage', asset($submission->file))}}" class="link">{{last(explode('/', $submission->file))}}</a></p>
                            <p class="card-text mt-3 mb-3"><span class="font-weight-bold">Note: </span>{{$submission->note}}</p>
                            <div class="d-flex align-items-center justify-content-center">
                                <form action="{{route('class.assignment.unsubmit')}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{$submission->id}}">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Unsubmit</button>
                                </form>
                            </div>
                        @else
                            <div class="d-flex align-items-center justify-content-center">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#submissionModal">Make Submission</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection

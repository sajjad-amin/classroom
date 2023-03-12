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
            </div>
            <div class="col-md-6 col-sm-6 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Due Date</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{date('d M Y, h:i A', $assignment->due_date)}}</p>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Your Submission</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#submissionModal">Assign Submission</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection

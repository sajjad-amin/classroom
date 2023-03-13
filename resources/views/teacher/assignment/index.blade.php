@extends('layouts.dashboard')
@section('title', $assignment->title)
@section('content')
    <div class="container mt-5">
        <div class="jumbotron">
            <div class="dropdown mb-5">
                <button class="btn btn-warning float-right" type="button" id="dashboardDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                <a href="{{route('dashboard.class.section.open',['id' => $assignment->course_id, 'section' => $assignment->section])}}" class="btn btn-primary float-right mr-2">Back</a>
                <div class="dropdown-menu" aria-labelledby="dashboardDropdown">
                    <a class="dropdown-item text-primary" href="{{route('dashboard.assignment.edit',['id'=>$assignment->id])}}">Edit</a>
                    <form method="POST" action="{{ route('dashboard.assignment.delete') }}" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value="{{$assignment->id}}">
                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                    </form>
                </div>
                <h1 class="display-4">{{$assignment->title}}</h1>
                <p class="lead">Due Date: {{date('d M Y, h:i A', $assignment->due_date)}}</p>
                @if($assignment->attachment)
                    <a href="{{str_replace('public', 'storage', asset($assignment->attachment))}}" class="link">View Attachment</a>
                @endif
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <div class="card">
            <div class="card-body">
                <p class="card-text">{{$assignment->description}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Submissions</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Position</th>
                                    <th>Student</th>
                                    <th>Attachment</th>
                                    <th>Note</th>
                                    <th>Score</th>
                                    <th>Comment</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($submissions as $position => $submission)
                                    @php
                                    $name = \App\Models\User::where('id', $submission->student_id)->first()->name;
                                    @endphp
                                    <tr>
                                        <td>{{$position+1}}</td>
                                        <td>{{$name}}</td>
                                        <td>
                                            @if($submission->file)
                                                <a href="{{str_replace('public', 'storage', asset($submission->file))}}" class="link">View</a>
                                            @endif
                                        </td>
                                        <td>{{$submission->note}}</td>
                                        <td>{{$submission->score}}/{{$assignment->points}}</td>
                                        <td>{{$submission->comment}}</td>
                                        <td>{{date('d M Y, h:i A', $submission->submitted_at)}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#submissionModal{{$submission->id}}">Remark</button>
                                            <div class="modal fade" id="submissionModal{{$submission->id}}" tabindex="-1" role="dialog" aria-labelledby="submitAssignment{{$submission->id}}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="submitAssignment{{$submission->id}}">Remark <span class="lead">{{$name}}</span></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST" action="{{route('dashboard.assignment.submission.remark')}}">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="id" value="{{$submission->id}}">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="submission">Score</label>
                                                                    <select class="form-control" id="submission" name="score">
                                                                        @for($i = 0; $i <= $assignment->points; $i++)
                                                                            <option value="{{$i}}" @if($submission->score == $i) selected @endif>{{$i}}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="comment">Write a comment</label>
                                                                    <textarea class="form-control" id="comment" name="comment" rows="3">{{$submission->comment}}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
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
        </div>
    </div>
@endsection
@section('script')
@endsection

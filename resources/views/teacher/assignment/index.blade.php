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
            </div>
            @if($assignment->attachment)
                <a href="{{str_replace('public', 'storage', asset($assignment->attachment))}}" class="link">Download Attachment</a>
            @endif
            <p class="mt-3">{{$assignment->description}}</p>
        </div>
    </div>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection

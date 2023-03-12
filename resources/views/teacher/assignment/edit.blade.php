@extends('layouts.dashboard')
@section('title', 'Edit Assignment')
@section('content')
    <div class="container mt-5">
        <div class="jumbotron">
            <a href="{{route('dashboard.assignment.open', ['id' => $assignment->id])}}" class="btn btn-primary">Back</a>
        </div>
        <form class="theme-form" method="post" enctype="multipart/form-data" action="{{route('dashboard.assignment.update')}}" >
            @method('put')
            @csrf
            <input type="hidden" name="id" value="{{$assignment->id}}">
            <div class="modal-body">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="col-form-label">Assignment Title:</label>
                        <input name="title" class="form-control" id="title" type="text" placeholder="Assignment Title" value="{{$assignment->title}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="col-form-label">Description:</label>
                        <textarea name="description" class="form-control" id="description" rows="3" placeholder="Description" required>{{$assignment->description}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="due_date" class="col-form-label">Due Date:</label>
                        <input name="due_date" class="form-control" id="due_date" type="datetime-local" placeholder="Due Date" value="{{date('Y-m-d\TH:i', $assignment->due_date)}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="points" class="col-form-label">Points:</label>
                        <select name="points" class="form-control" id="points" required>
                            @for($i=1;$i<=100;$i++)
                                <option value="{{$i}}" @if($assignment->points == $i) selected @endif>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="attachment" class="col-form-label">Upload Attachment:</label>
                        <input name="attachment" class="form-control" id="attachment" type="file" placeholder="Upload Attachment">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" value="Update" />
            </div>
        </form>
    </div>
@endsection
@section('script')
@endsection

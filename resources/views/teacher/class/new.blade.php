@extends('layouts.dashboard')
@section('title', 'New Class')
@section('content')
    <div class="container mt-5">
        <form method="post" action="{{route('dashboard.class.create')}}">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input name="title" type="text" class="form-control" id="title" required>
            </div>
            <div class="form-group">
                <label for="code">Class Code</label>
                <input name="code" type="text" class="form-control" id="code" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" rows="20" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
@endsection
@section('script')
@endsection

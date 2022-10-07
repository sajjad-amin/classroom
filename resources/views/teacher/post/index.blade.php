@extends('layouts.dashboard')
@section('title', 'New Class')
@section('content')
    <div class="container mt-5">
        <div class="jumbotron">
            <div class="dropdown mb-5">
                <button class="btn btn-warning float-right" type="button" id="dashboardDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="dashboardDropdown">
                    <a class="dropdown-item text-primary" href="{{route('dashboard.post.edit',['id'=>$post->id])}}">Edit</a>
                    <form method="POST" action="{{ route('dashboard.post.delete') }}" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value="{{$post->id}}">
                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                    </form>
                </div>
            </div>
            @if(isFileImage($post->image))
                <img src="{{str_replace('public', 'storage', asset($post->image))}}">
            @elseif($post->image)
                    <a href="{{str_replace('public', 'storage', asset($post->image))}}" class="link">Download Attachment</a>
            @endif
            <p class="mt-3">{{$post->text}}</p>
        </div>
    </div>
@endsection
@section('script')
@endsection

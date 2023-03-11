@extends('layouts.dashboard')
@section('title', 'New Class')
@section('content')
    <div class="container mt-5">
        <div class="jumbotron">
            <a href="{{route('dashboard.post.open', ['id' => $post->id])}}" class="btn btn-primary">Back</a>
        </div>
        <form class="theme-form" method="post" action="{{route('dashboard.post.update')}}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="{{$post->id}}">
            <div class="modal-body">
                <div class="mb-3">
                    <textarea name="text" rows="5" class="form-control" placeholder="Type here..." required>{{$post->text}}</textarea>
                </div>
                <div class="mb-3">
                    <label class="col-form-label pt-0" for="image">Add File</label>
                    <input name="image" class="form-control" id="image" type="file">
                </div>
                <div class="m-3">
                    <img id="imageDisplay" class="img-fluid" src="{{$post->image ? str_replace('public', 'storage', asset($post->image)) : asset('images/dummy-image.webp')}}">
                </div>
                <div class="m-3">
                    <input type="submit" class="btn btn-primary" value="Update" />
                </div>

            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $('#image').on('change', function (e){
            const files = $(this).prop('files');
            if(files.length > 0){
                const file = files[0];
                const fileReader = new FileReader();
                fileReader.addEventListener('load', function (e){
                    $('#imageDisplay').attr('src', e.target.result);
                });
                fileReader.readAsDataURL(file);
            }else{
                $('#imageDisplay').attr('src', '');
            }
        });
    </script>
@endsection

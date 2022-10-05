@extends('layouts.auth')
@section('title', 'Secured Area')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">Confirm Password</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4 text-sm text-gray-600">
                            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                        </div>
                        <div class="mb-4">
                            @if($errors->any())
                                <ul class="text-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Password</label>
                                <input name="password" type="password" class="form-control" id="email" value="{{old('email')}}">
                            </div>
                            <button type="submit" class="btn btn-primary float-right">
                                {{ __('Confirm') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

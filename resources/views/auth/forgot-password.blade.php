@extends('layouts.auth')
@section('title', 'Password Reset Request')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">Request Reset Password</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </div>
                        <div class="mb-4">
                            @if($errors->any())
                                <ul class="text-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <p class="text-success">{{session('status')}}</p>
                        </div>
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="email" type="email" class="form-control" id="email" value="{{old('email')}}">
                            </div>
                            <button type="submit" class="btn btn-primary float-right">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

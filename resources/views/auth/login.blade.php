@extends('layouts.auth')
@section('title', 'Login')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 mt-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Login</h5>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <ul class="text-danger">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" type="password" class="form-control" id="password">
                        </div>
                        <div class="form-group form-check">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <input name="remember" type="checkbox" class="form-check-input" id="loggedin">
                                    <label class="form-check-label text-muted" for="loggedin">Remember Me</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="text-muted" href="{{ route('password.request') }}">
                                        Forgot password?
                                    </a>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

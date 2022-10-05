@extends('layouts.app')
@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#homeNavbar" aria-controls="homeNavbar" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="homeNavbar">
            <a class="navbar-brand" href="#">Home</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            </ul>
            <div class="form-inline my-2 my-lg-0">
                @if(!\Illuminate\Support\Facades\Auth::user())
                    <a href="{{route('login')}}" class="btn btn-outline-success my-2 mr-2 my-sm-0" >Login</a>
                    <a href="{{route('register')}}" class="btn btn-outline-success my-2 my-sm-0" >Register</a>
                @else
                    <a class="btn text-white" type="button" href="{{route('dashboard')}}">
                        {{\Illuminate\Support\Facades\Auth::user()->name}}
                    </a>
                @endif
            </div>
        </div>
    </nav>
@endsection

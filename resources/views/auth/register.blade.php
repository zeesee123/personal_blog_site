@extends('layouts.app')

@section('content')

<div class="row text-center">

    @if(session('success'))
    
    <div class="alert alert-success">
        {{session('success')}}
    </div>

    @elseif(session('error'))

    <div class="alert alert-danger">
        {{session('error')}}
    </div>
    

    @endif

    <form action="/register" method="POST" class="mb-3">

        @csrf

        <div class="mb-3">
            <input type="text" placeholder="name" name="name">

            @error('name')
            <div class="text-danger">
                {{$message}}
            </div>
            @enderror

        </div>
        
        <div class="mb-3">
            <input type="email" placeholder="email" name="email">
            @error('email')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <input type="password" placeholder="password" name="password">
            @error('password')
            <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <input type="password" placeholder="confirm password" name="password_confirmation">

            @error('password_confirmation')
            <div class="text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
    
       
        <button class="btn btn-primary">Register</button>
        
    </form>

    <div>Already have an account ? <a href="/">LOGIN</a></div>
    
</div>

@endsection
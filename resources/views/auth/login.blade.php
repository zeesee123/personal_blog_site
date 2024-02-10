@extends('layouts.app')

@section('content')

<div class="row text-center">

    @if(session('error'))

    <div class="alert alert-danger">
        
        {{session('error')}}
        
    </div>
    
    
    @endif

    <form action="/login" method="POST" class="mb-3">

        @csrf

        <div class="mb-3">
            <input type="text" placeholder="email" name="email">
        </div>
        
        <div class="mb-3">
            <input type="password" placeholder="password" name="password">
        </div>
        
    
       
        <button class="btn btn-primary">Login</button>
        
    </form>

    <div>If you don't have an account , then please click here to <a href="/register">REGISTER</a></div>
    
</div>

@endsection
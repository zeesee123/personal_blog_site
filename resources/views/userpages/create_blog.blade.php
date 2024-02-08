@extends('layouts.app')

@section('content')

@if(session('success'))

<div class="alert alert-success">
           {{session('success')}}
</div>

@elseif(session('error'))

<div class="alert alert-danger">
{{session('error')}}
</div>

@else

@endif

<form action="/create_blog" method="POST">

    @csrf

    <div class="mb-3">
        <input type="text" placeholder="blog title" name="title" class="form-control">
        
        @error('title')

        <div class="text-danger">
             {{$message}}
        </div>

        @enderror

    </div>
    <div class="mb-3">
        <label for="" class="form-label">Blog content</label>
        <textarea  id="" cols="30" rows="10" class="form-control" name="body">

        </textarea>

        @error('body')

        <div class="text-danger">
            {{$message}}
        </div>

        @enderror

    </div>
    <div class="mb-3">
        <label for="" class="form-label">
            blog category
        </label>
        <select  id="" class="form-control" name="category">
            
            @foreach($categories as $cat)
            
            <option value="{{$cat->id}}">{{$cat->name}}</option>

            @endforeach

        </select>

        @error('category')
       
        <div class="text-danger">
            {{$message}}
        </div>

        @enderror

    </div>

    <button>Post</button>
</form>
@endsection
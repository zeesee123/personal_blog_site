{{-- @php
echo 'this is the blog</br>';
print_r($blog);
@endphp --}}

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

<form action="/edit_blog" method="POST">

    @method('PUT')

    @csrf

    <div class="mb-3">
        <input type="text" placeholder="blog title" name="title" class="form-control" value="{{$blog->title}}">
        
        @error('title')

        <div class="text-danger">
             {{$message}}
        </div>

        @enderror

    </div>
    <div class="mb-3">
        <label for="" class="form-label">Blog content</label>
        <textarea  id="" cols="30" rows="10" class="form-control" name="body" >
           {{$blog->body}}
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
            
            <option value="{{$cat->id}}" {{$blog->blog_category_id===$cat->id?'selected':''}}>{{$cat->name}}</option>

            @endforeach

        </select>

        @error('category')
       
        <div class="text-danger">
            {{$message}}
        </div>

        @enderror

    </div>

    <input type="hidden" value="{{$blog->id}}" name="id">

    <button>Post</button>
</form>
@endsection
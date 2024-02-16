@extends('layouts.app')

@section('content')

<h5>Category:{{$blog->category_id->name}}</h5>

<h1>{{$blog->title}}</h1>

<p>{{$blog->body}}</p>

       
@endsection
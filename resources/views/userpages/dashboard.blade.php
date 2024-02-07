@extends('layouts.app')

@section('content')

<html>
    this is the user dashboard hello {{auth()->user()->name}}
</html>

@endsection

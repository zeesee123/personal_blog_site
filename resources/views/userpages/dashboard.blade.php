@extends('layouts.app')

@section('content')

<div class="row">
    
        
        @if($blog_count===0)
        
       <div>There are no blogs</div>

        @else

        <table>
            <thead>
                <tr>
                    <th>
                        sno.
                    </th>
                    <th>title</th>
                    <th>author</th>
                    <th>posted on</th>
                </tr>
                
            </thead>

        <tbody>
            @foreach($blogs as $blog)
            @php

            $count=1;
                
            @endphp
            <tr>
                <td>{{$count++}}</td>
                <td>{{$blog->title}}</td>
                <td>{{$blog->user->name}}</td>
                {{-- <td>{{date('d-M-y',strtotime($blog->created_at))}}</td> --}}
                <td>{{$blog->created_at->format('d-m-y')}}</td>
            </tr>
            @endforeach
         
        </tbody>


        @endif

    </table>
</div>

@endsection

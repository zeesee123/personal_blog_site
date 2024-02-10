@extends('layouts.app')

@section('content')

<div class="row">
    
        
        @if($blog_count===0)
        
       <div>There are no blogs</div>

        @else

        <table id="blogTable">
            <thead>
                <tr>
                    <th>
                        sno.
                    </th>
                    <th>title</th>
                    <th>author</th>
                    <th>posted on</th>
                    <th>Actions</th>
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
                <td>{{ucfirst($blog->user->name)}}</td>
                {{-- <td>{{date('d-M-y',strtotime($blog->created_at))}}</td> --}}
                <td>{{$blog->created_at->format('d-m-y')}}</td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="/blog/edit/{{$blog->id}}">Edit</a></li>
                          <li><a class="dropdown-item" href="#">Delete</a></li>
                        </ul>
                      </div>
                </td>
            </tr>
            @endforeach
         
        </tbody>


        @endif

    </table>
</div>

@endsection

@section('scripts')

<script>

    $(document).ready( function () {
    $('#blogTable').DataTable();
} );

</script>
@endsection

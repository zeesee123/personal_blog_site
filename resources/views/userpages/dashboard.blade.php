@extends('layouts.app')

@section('content')

component below

<x-headeer title="chowmein" />

<div class="row">

    <!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete blog ??</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
       
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">no</button>
          <button id="del_actual" type="button" class="btn btn-primary" data-id="">yes</button>
        </div>
      </div>
    </div>
  </div>
    
        
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
                            @can('update',$blog)
                          <li><a class="dropdown-item" href="/blog/edit/{{$blog->id}}">Edit</a></li>
                          @endcan

                          <li><a class="dropdown-item" href="/view_blog/{{$blog->id}}">View</a></li>

                          @can('delete',$blog)
                          <li><a class="dropdown-item del_btn" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"  data-id="{{$blog->id}}">Delete</a></li>
                          @endcan
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


//function for blog deletion

let del=document.querySelectorAll('.del_btn');
let del_actual=document.querySelector('#del_actual');

console.log(del);

del.forEach((d)=>{
    d.addEventListener('click',()=>{
        
        // console.log('you clicked');
        del_actual.setAttribute('data-id',d.getAttribute('data-id'));

    })
});

del_actual.addEventListener('click',async()=>{

    let data={'id':del_actual.getAttribute('data-id')};

let fe=await fetch('/delete_blog',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{csrf_token()}}'},body:JSON.stringify(data)});

let re=await fe.json();

if(re.status==='success'){
    console.log('good');
}else{
    console.log('eh');
}
});



</script>
@endsection

@extends('layouts.app')

@section('content')

<h5>Category:{{$blog->category_id->name}}</h5>

<h1>{{$blog->title}}</h1>

<p>{{$blog->body}}</p>


<div>
    <h4>Comments</h4>

    <button class="btn btn-primary mb-3" id="comment_btn">add a comment</button>

    <div id="my_reply" class="d-none">
        
        <div class="mb-3">
            <textarea name="" id="" cols="30" rows="7" class="form-control"></textarea>
        </div>
        
        <button class="btn btn-success">send</button>
        <button class="btn btn-danger" id="cancel">cancel</button>

    </div>
</div>

       
@endsection


@section('scripts')


<script>

    let my_reply=document.querySelector('#my_reply');

    let comment_btn=document.querySelector('#comment_btn');

    let cancel=document.querySelector('#cancel');

    comment_btn.addEventListener('click',()=>{

        my_reply.classList.toggle('d-none');
    });

    cancel.addEventListener('click',()=>{

        my_reply.classList.toggle('d-none');
    })

    

</script>

@endsection
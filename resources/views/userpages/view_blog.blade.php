@extends('layouts.app')

@section('styles')

<style>
    .profile_circle{height:7vmin;
                    width:7vmin;
                    background-color:blue;
                    border-radius:50%;
                    position:relative;}
</style>


@endsection

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
        
        <button class="btn btn-success" id="send">send</button>
        <button class="btn btn-danger" id="cancel">cancel</button>

    </div>
</div>

{{-- below is the comment's body --}}

{{-- @foreach($blog->comments() as $co)
<div>
    <p>id</p>
    <p>comment body</p>
    
</div>
@endforeach --}}

{{-- {{$comments}} --}}

{{-- {{$blog->comments()->get()}} --}}

{{-- @foreach($comments as $comm)
<div class="d-flex flex-lg-row flex-column mt-2 mb-2">

    <div class="mx-1 profile_circle text-white fw-bold"><p style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%)">A</p></div>
    <div>
        <p class="fw-bold">{{'@'}}{{ucfirst($comm->owner->name)}}</p>
        <p>{{$comm->comment}}</p>
    </div>

</div>
@endforeach --}}

<div id="comment_display"></div>
       
@endsection


@section('scripts')


<script>

    let my_reply=document.querySelector('#my_reply');

    let comment_btn=document.querySelector('#comment_btn');

    let cancel=document.querySelector('#cancel');

    let send=document.querySelector('#send');

    let content=document.querySelector('textarea');

    let comentDsp=document.querySelector('#comment_display');

    let stri='oliver';

    console.log(stri.charAt(2));

    //function for autoloading the comments on page load
    async function loadComments(){

        comentDsp.innerHTML=`<div class="d-flex justify-content-center">
  <div class="spinner-border" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>`;

        let det={blog_id:`{{$blog->id}}`}
        
        let etch=await fetch('/load_comments',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{csrf_token()}}'},body:JSON.stringify(det)});


        let ree=await etch.json();

       

        

        if(ree.status==='success'){

            comentDsp.innerHTML=``;

            ree.blog.comments.forEach((a)=>{
        
                comentDsp.innerHTML+=`
            <div class="d-flex flex-lg-row flex-column mt-2 mb-2">

<div class="mx-1 profile_circle text-white fw-bold"><p style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%)">${a.owner['name'].charAt(0).toUpperCase()}</p></div>
<div>
    <p class="fw-bold">${a.owner['name']}</p>
    <p>${a.comment}</p>
</div>

</div>`;
            })

            
        }

        console.log(ree);

        
    }

    loadComments();

    //try eagerloading the realtionships then see what happens in here

    comment_btn.addEventListener('click',()=>{

        my_reply.classList.toggle('d-none');
    });

    cancel.addEventListener('click',()=>{

        my_reply.classList.toggle('d-none');
    });

    send.addEventListener('click',async()=>{

        if(content.value.trim()!=''){

            let data={};
            data['comment']=content.value;
            data['blog_id']=`{{$blog->id}}`;

            let fe=await fetch('/add_comment',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{csrf_token()}}'},body:JSON.stringify(data)});

            let re=await fe.json();

            console.log('this is the response',re);
            if(re.status==='success'){

                cancel.click();

                loadComments();
            }

        }else{
            console.log('this is empty');
        }

        // console.log('this is what you typed inside textarea',content.value);
        
    });



    

</script>

@endsection
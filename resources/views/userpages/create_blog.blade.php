@extends('layouts.app')

@section('content')

@if(session('success'))

<x-alert type="success" message="{{session('success')}}"  />

@elseif(session('error'))

<x-alert type="danger" message="{{session('error')}}" />

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

    <div class="mb-3">
    <label for="exampleDataList" class="form-label">Datalist example</label>
<input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
<datalist id="datalistOptions">
    @foreach($tags as $tag)
  <option value="{{$tag->name}}">
    @endforeach
</datalist>
</div>

<div class="mb-3">
    <div id="tags_disp" class="d-flex"></div>
</div>

    <button>Post</button>
</form>
@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js" integrity="sha512-TToQDr91fBeG4RE5RjMl/tqNAo35hSRR4cbIFasiV2AAMQ6yKXXYhdSdEpUcRE6bqsTiB+FPLPls4ZAFMoK5WA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>

let dl=document.querySelector('#exampleDataList');

let tag_disp=document.querySelector('#tags_disp');

console.log(dl);

const remove=(a)=>{
    
    console.log(`remove ${a}`);
}

dl.addEventListener('keydown',(e)=>{

    if(e.key=="Enter"){

        e.preventDefault();

        // tag_disp.innerHTML=`${dl.value}`;
        let newEle=document.createElement('div');

        newEle.innerHTML=`<div class="badge bg-primary mx-1">${dl.value}&nbsp;<span onClick='remove(this)'>X<span></div>`;

        dl.value='';

        
        // console.log('this is the new element',newEle);
        tag_disp.appendChild(newEle);

        console.log('hello');
    }


});

</script>
@endsection
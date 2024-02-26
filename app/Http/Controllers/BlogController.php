<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Tag;
use App\Models\Blog;

use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //

    static function userCheck($num){

        if(auth()->user()->id===$num){

            return true;

        }

        return false;
    }


    static function tagCheck($arr){

        $tags=Tag::all(); //this gives me the entire model instance

        $tags=$tags->pluck('name')->toArray();

        $newArray=[];

        foreach($arr as $ar){
           
            if(in_array($ar,$tags)){

                $tag=Tag::where('name',$ar)->first();

                // array_push($tag->id,$newArray);
                $newArray[]=$tag->id;
               
            }else{

                return false;
            }
            
        }

        return $newArray;
    }

    static function BlogCheck($id){

        $flag=BlogCategory::find($id);

        return $flag;
    }

    public function create(Request $r){

        // dd('hello');

        // dd($r);

        $fields=$r->validate(['title'=>'required','body'=>'required','category'=>'required','selected_tags'=>'required']);

        $tas=explode(',',$r->selected_tags);

        $ar=[];

        if(!$this->tagCheck($tas)){

            return back()->with('error','tags are not right');

        }else{

             $ar=$this->tagCheck($tas);
        }

        // dd($tags);

        $check=$this->BlogCheck($r->category);

        try{

            if($check){

                $blog=Blog::create(['title'=>$r->title,'body'=>$r->body,'blog_category_id'=>$r->category,'user_id'=>auth()->user()->id]);

                $blog->tags()->attach($ar);
    
                return back()->with('success','Blog successfully created');
            
            }else{
    
                return back()->with('error','There is no such blog category');
    
            }
    
        }catch(Exception $e){

            return back()->with('error',"Error --> ${$e->getMessage()}");
        }

        
        
    }


    public function edit_blog(Request $r){

        // dd('hey');

       

        $fields=$r->validate(['title'=>['required'],'body'=>['required'],'category'=>'required','id'=>'required']);

        

        try{

            $blog=Blog::find($fields['id']);

        if($this->userCheck($blog->user_id)){

            $blog->update(['title'=>$r->title,'body'=>$r->body,'blog_category_id'=>$r->category]);

            return back()->with('success','blog successfully updated');

        }else{

            return back()->with('error','there is something wrong');
        }


        }catch(Exception $e){

            return back()->with('error',$e->getMessage());
        }
        }


        public function delete_blog(Request $r){

            $r->validate(['id'=>'required']);

            try{
                
                if(auth()->user()->cannot('delete',Blog::find($r->id))){

                    return response()->json(['status'=>'failure','message'=>'you cannot do that']);
                }
                
                Blog::destroy($r->id);

                return response()->json(['status'=>'success','message'=>'great terminator!!']);

            }catch(Exception $e){

                return response()->json(['status'=>'failure','message'=>$e->getMessage()]);


            }



        }

   
}

<?php

namespace App\Http\Controllers;

use Exception;
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

    static function BlogCheck($id){

        $flag=BlogCategory::find($id);

        return $flag;
    }

    public function create(Request $r){

        // dd('hello');

        $fields=$r->validate(['title'=>'required','body'=>'required','category'=>'required']);

        $check=$this->BlogCheck($r->category);

        try{

            if($check){

                $blog=Blog::create(['title'=>$r->title,'body'=>$r->body,'blog_category_id'=>$r->category,'user_id'=>auth()->user()->id]);
    
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

   
}

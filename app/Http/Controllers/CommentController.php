<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //

    public function add_comment(Request $r){

        // dd($r);

        try{
            
            $r->validate(['comment'=>'required','blog_id'=>'required']);

            $comment=new Comment;
            $comment->comment=$r->comment;
            $comment->blog_id=$r->blog_id;
            $comment->user_id=auth()->user()->id;
            $comment->save();

            return response()->json(['status'=>'success','message'=>'comment added']);

        }catch(Exception $e){

            return response()->json(['status'=>'failure','message'=>'comment cannot be added']);


        }
        


    }



    public function load_comments(Request $r){

        // dd($r);

        try{

            // sleep(5); this function is used in php to add a delay

            $blog=Blog::with('comments.owner')->find($r->blog_id);
        // dd($blog);

            return response()->json(['status'=>'success','blog'=>$blog]);

        }catch(Exception $e){

            return response()->json(['status'=>'failure','message'=>$e->getMessage()]);
        }

        
    }
}

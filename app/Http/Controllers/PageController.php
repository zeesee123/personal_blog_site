<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tags;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //

    static function category(){

        $categories=BlogCategory::all();

        return $categories;
    }

    public function index(){

        if(Auth::check()){

            $blog_count=Blog::count();

            $blogs=Blog::all();

            return view('userpages.dashboard',compact('blog_count','blogs'));
            
        }else{

            return view('auth.login');
        }

        
    }


    public function registerPage(){

        return view('auth.register');
    }

    public function create_blog(){

        $categories=$this->category();

        $tags=Tags::all();

        return view('userpages.create_blog',compact('categories','tags'));
    }

    public function edit_blog(Blog $id){

        $blog=$id;

        $categories=$this->category();

        return view('userpages.edit_blog',compact('blog','categories'));
    }


    public function view_blog(Blog $blog){

        // dd($blog);

        return view('userpages.view_blog',compact('blog'));

    }
}

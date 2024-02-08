<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //

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

        $categories=BlogCategory::all();

        return view('userpages.create_blog',compact('categories'));
    }
}

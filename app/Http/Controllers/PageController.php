<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //

    public function index(){

        if(Auth::check()){

            return view('userpages.dashboard');
            
        }else{

            return view('auth.login');
        }

        
    }


    public function registerPage(){

        return view('auth.register');
    }
}

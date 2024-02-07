<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function login(Request $r){

        $fields=$r->validate(['email'=>'required','password'=>'required']);
        // dd($r);

        try{

            if(Auth::attempt($fields)){
                $r->session()->regenerate();
                // return 'great';
                return back();
            }else{
                return back();
            }

        }catch(Exception $e){

            return $e->getMessage();

        }

        
    }


    public function logout(){

        Auth::logout();

        return back();
    }
}

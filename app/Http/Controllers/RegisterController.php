<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //

    public function registerUser(Request $r){

        $fields=$r->validate(['name'=>'required','email'=>'required','password'=>'required|min:4|confirmed']);

        $fields['password']=Hash::make($fields['password']);
        // dump('below is the request object');
        // dd($r);

        try{
               
            $user=User::create($fields);

            return back()->with('success','User successfully registered');

        }catch(Exception $e){

            return back()->with('error',"user could not be registered {$e->getMessage()}");

        }

    }
}

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

        $fields=$r->validate(['name'=>'required','email'=>'unique:users,email|required','password'=>'required|min:4|confirmed']);

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


    public function register_api(Request $r){

        // dd('you are trying to register dude');
        $r->validate(['name'=>'required','password'=>'required|confirmed','email'=>'required']);

        $user=User::create($r->all());

        $token=$user->createToken('scooby')->plainTextToken;

        $response=['user'=>$user,'token'=>$token];

        return response($response,201);


    }
}

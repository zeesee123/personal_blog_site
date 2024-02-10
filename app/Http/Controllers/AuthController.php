<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
                return back()->with('error','Bad credentials');
            }

        }catch(Exception $e){

            return $e->getMessage();

        }

        
    }


    public function logout(){

        Auth::logout();

        return back();
    }

    public function logout_api(Request $r){

        auth()->user()->tokens()->delete();

        return ['message'=>'logged out'];

    }

    public function login_api(Request $r){

        $field=$r->validate(['email'=>'required','password'=>'required']);

        $user=User::where('email',$r->email)->first();

        if(!$user||Hash::check($field['password'],$user->password)){

            return response(['message'=>'bad creds'],401);
        }

        $token=$user->createToken('hey')->plainTextToken;

        return response(['user'=>$user,'token'=>$token],201);



    }
}

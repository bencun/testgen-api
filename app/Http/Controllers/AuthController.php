<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use \Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function flogin(){
        $user = User::find(1);
        $token = JWTAuth::fromUser($user);
        return response()->json($token);
    }

    public function tlogin(){
        try{
            $user = JWTAuth::parseToken()->authenticate();
            dd($user);
        }
        catch(JWTException $e){
            return response()->json("failure", 403);
        }
    }

    public function login(){
        
    }
}

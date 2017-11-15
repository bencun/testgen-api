<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use \Tymon\JWTAuth\Exceptions\JWTException;
use App\Exceptions\CustomException;

class AuthController extends Controller
{
    public function login(){
        $input = request()->input();
        
        try{
            $name = $input['name'];
            $password = $input['password'];
    
            $user = User::where('name', '=', $name)
                ->get()
                ->first();
            if($user){
                $pwVerified = password_verify($password, $user->password);
                if($pwVerified){
                    $token = JWTAuth::fromUser($user);
                    return response()->json($token);
                }
                else throw new CustomException("Bad name/password combo.");

            }
            else throw new CustomException("Invalid user.");
        }
        catch(CustomException $e){
            return response()->json($e, 401);
        }
    }

    public function logout(){
        $input = request()->input();
        try{
            $user = JWTAuth::parseToken()->authenticate();
            JWTAuth::parseToken()->invalidate();
            return response("OK", 200);
        }
        catch(\Exception $e){
            return response("You are not logged in.", 401);
        }
    }
}

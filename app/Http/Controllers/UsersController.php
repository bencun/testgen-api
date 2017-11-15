<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\User;
use App\Exceptions\CustomException;
use JWTAuth;
use \Tymon\JWTAuth\Exceptions\JWTException;

class UsersController extends Controller
{
    public function index(){
        $allUsers = User::get();
        $count = User::count();

        return ["data" => $allUsers, "count" => $count];
    }
    public function show(User $user){
        return $user;
    }
    public function store(){
        try{
            $input = request()->input();
            if(isset($input['password']) && isset($input['passwordConfirmation'])){
                if($input['password'] === $input['passwordConfirmation']){
                    $validator = Validator::make($input, [
                        'name' => 'required|alpha_num|min:3|max:25|string',
                        'details' => 'nullable|string',
                        'password' => "required|min:5|string",
                        'passwordConfirmation' => "required|min:5|string",
                        'admin' => "required|boolean",
                        'tests' => "nullable"
                    ]);
                    if($validator->fails()) throw new CustomException($validator->errors());
                    $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
                    $newUser = new User($input);
                    $newUser->save();
                    return response($newUser, 201);
                }
                else{
                    throw new CustomException("Passwords don't match!");
                }
            }
            else{
                throw new CustomException("You didn't specify a password and/or a password confirmation!");
            }
        }//try
        catch(CustomException $e){
            return response()->json($e, 400);
        }//catch
    }
    public function update(){
        try{
            $input = request()->input();
            //check if we need to change the password
            if(isset($input['password']) && isset($input['passwordConfirmation'])){
                if($input['password'] === $input['passwordConfirmation']){
                    $validator = Validator::make($input, [
                        'password' => "required|min:5|string",
                        'passwordConfirmation' => "required|min:5|string"
                    ]);
                    if($validator->fails()) throw new CustomException($validator->errors());
                    //update the password hash
                    $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
                }
                else{
                    throw new CustomException("Passwords don't match!");
                }
            }
            //unset the password fields just in case
            else{
                unset($input['password']);
                unset($input['passwordConfirmation']);
            }
            //validate data
            $validator = Validator::make($input, [
                'name' => 'required|alpha_num|min:3|max:25|string',
                'details' => 'nullable|string',
                'admin' => "required|boolean",
                'tests' => "nullable"
            ]);
            if($validator->fails()) throw new CustomException($validator->errors());

            $existingUser = User::find($input["id"]);
            if($existingUser){
                $existingUser->update($input);
                return response($existingUser, 201);
            }
            else throw new CustomException('User not found!');
        }//try
        catch(CustomException $e){
            return response()->json($e, 400);
        }//catch        
    }
    public function delete(User $user){
        try{
            $user->delete();
            return response($user, 202);

        }
        catch(\Exception $e){
            return response()->json($e, 400);
        }
    }
}

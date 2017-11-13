<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
            $newUser = new User($input);
            $newUser->save();
            return response($newUser, 201);

        }
        catch(\Exception $e){
            return response()->json($e, 400);
        }
    }
    public function update(){
        try{
            $input = request()->input();
            $existingUser = User::find($input["id"]);
            if($existingUser){
                $existingUser->update($input);
                $existingUser->save();
            }
            else
                throw new \Exception();
            return response($existingUser, 202);

        }
        catch(\Exception $e){
            return response()->json($e, 404);
        }        
    }
    public function delete(){
        try{
            $input = request()->input();
            $existingUser = User::find($input["id"]);
            if($existingUser){
                $existingUser->delete();
            }
            else
                throw new \Exception();
            return response($existingUser, 202);

        }
        catch(\Exception $e){
            return response()->json($e, 404);
        }
    }
}

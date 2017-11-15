<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

use JWTAuth;
use \Tymon\JWTAuth\Exceptions\JWTException;
use App\Exceptions\CustomException;

class CategoryController extends Controller
{
    public function index(){
        $allCategories = Category::get();
        return [$allCategories];
    }
    public function show(Category $category){
        return $category;
    }
    public function store(){
        try{
            $input = request()->input();
            $newCategory = new Category($input);
            $newCategory->save();
            return response($newCategory, 201);

        }
        catch(\Exception $e){
            return response()->json($e, 400);
        }
    }
    public function update(){
        try{
            $input = request()->input();
            $existingCategory = Category::find($input["id"]);
            if($existingCategory){
                $existingCategory->update($input);
                $existingCategory->save();
            }
            else
                throw new CustomException("Category does not exist.");
            return response($existingCategory, 202);

        }
        catch(CustomException $e){
            return response()->json($e, 404);
        }
        catch(\Exception $e){
            return response()->json($e, 404);
        }        
    }
    public function delete(){
        try{
            $input = request()->input();
            $existingCategory = Category::find($input["id"]);
            if($existingCategory){
                $existingCategory->delete();
            }
            else
                throw new CustomException("Category does not exist.");
            return response($existingCategory, 202);

        }
        catch(CustomException $e){
            return response()->json($e, 404);
        }
        catch(\Exception $e){
            return response()->json($e, 404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Question;
use JWTAuth;
use \Tymon\JWTAuth\Exceptions\JWTException;
use App\Exceptions\CustomException;

class QuestionController extends Controller
{
    public function index(Category $category){
        return $category->questions;
    }

    public function show(Question $question){
        return $question;
    }

    public function store(){
        try{
            $input = request()->input();
            $newQuestion = new Question($input);
            $newQuestion->save();
            return response($newQuestion, 201);
        }
        catch(\Exception $e){
            return response()->json($e, 400);
        }
    }
    public function update(){
        try{
            $input = request()->input();
            $existingQuestion = Question::find($input["id"]);
            if($existingQuestion){
                $existingQuestion->update($input);
                $existingQuestion->save();
            }
            else
                throw new CustomException("Question does not exist.");
            return response($existingQuestion, 202);

        }
        catch(CustomException $e){
            return response()->json($e, 404);
        }
        catch(\Exception $e){
            return response()->json($e, 404);
        }        
    }
    public function delete(Question $question){
        try{
            $question->delete();
            return response($question, 202);

        }
        catch(CustomException $e){
            return response()->json($e, 404);
        }
        catch(\Exception $e){
            return response()->json($e, 400);
        }
    }
}

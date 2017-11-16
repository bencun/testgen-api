<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestTemplate;
use JWTAuth;
use \Tymon\JWTAuth\Exceptions\JWTException;
use App\Exceptions\CustomException;

class TestTemplateController extends Controller
{
    public function index(){
        $allTT = TestTemplate::get();

        return $allTT;
    }
    public function show(TestTemplate $template){
        return $template;
    }
    public function store(){
        try{
            $input = request()->input();
            $newTestTemplate = new TestTemplate($input);
            $newTestTemplate->save();
            return response($newTestTemplate, 201);

        }
        catch(\Exception $e){
            return response()->json($e, 400);
        }
    }
    public function update(){
        try{
            $input = request()->input();
            $existingTestTemplate = TestTemplate::find($input["id"]);
            if($existingTestTemplate){
                $existingTestTemplate->update($input);
                $existingTestTemplate->save();
            }
            else
                throw new CustomException("Template does not exist.");
            return response($existingTestTemplate, 202);

        }
        catch(CustomException $e){
            return response()->json($e, 404);
        }
        catch(\Exception $e){
            return response()->json($e, 404);
        }        
    }
    public function delete(TestTemplate $template){
        try{
            $template->delete();
            return response($template, 202);

        }
        catch(CustomException $e){
            return response()->json($e, 404);
        }
        catch(\Exception $e){
            return response()->json($e, 400);
        }
    }
}

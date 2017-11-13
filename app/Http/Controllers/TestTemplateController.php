<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestTemplate;

class TestTemplateController extends Controller
{
    public function index(){
        $allTT = TestTemplate::get();
        $count = TestTemplate::count();

        return ["data" => $allTT, "count" => $count];
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
                throw new \Exception();
            return response($existingTestTemplate, 202);

        }
        catch(\Exception $e){
            return response()->json($e, 404);
        }        
    }
    public function delete(){
        try{
            $input = request()->input();
            $existingTestTemplate = TestTemplate::find($input["id"]);
            if($existingTestTemplate){
                $existingTestTemplate->delete();
            }
            else
                throw new \Exception();
            return response($existingTestTemplate, 202);

        }
        catch(\Exception $e){
            return response()->json($e, 404);
        }
    }
}

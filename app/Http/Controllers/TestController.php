<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\CustomException;
use App\User;
use App\Category;
use App\Question;
use App\TestTemplate;
use App\Test;

class TestController extends Controller
{
    private function gradeQuestion($questionAsArray){
        //get the options
        $questionAsArrayOptions = &$questionAsArray["options"]; //reference!
        //get the real question
        $realQuestion = Question::find($questionAsArray['id']);
        $realQuestionOptions = $realQuestion->options;
        
        foreach($realQuestionOptions as $realOption){
            foreach($questionAsArrayOptions as &$arrayOption){ //reference!
                if($realOption['option'] === $arrayOption['option']){
                    //if it's a match (true && true || false && false)
                    if(!($realOption['correct'] xor $arrayOption['selected'])){
                        $arrayOption['correct'] = true;
                    }
                    //if it's a miss (xor)
                    if($realOption['correct'] xor $arrayOption['selected']){
                        $arrayOption['correct'] = false;
                    }
                }
            }
        }
        return $questionAsArray;
    }

    public function index(User $user){
        return $user->allTests;
    }

    public function read(User $user, Test $test){
        if($test->user->id == $user->id)
            return $test;
        else{
            return response()->json("", 403);
        }
    }


    public function generate(User $user, TestTemplate $template){
        //check if the user can even do this test
        try{
            $found = false;
            foreach($user->tests as $userTest){
                if($userTest === $template->id) $found = true;
            };
            if(!$found) throw new CustomException("Not a valid template value!");
            //create a new test model
            $newTest = new Test;
            $newTest->fill([
                'name' => $template->name,
                'description' => $template->description,
                'timed' => $template->timed,
                'timedTotal' => $template->timedTotal,
                'timedTotalTime' => $template->timedTotalTime,
                'timedPerQuestion' => $template->timedPerQuestion,
                'timedPerQuestionTime' => $template->timedPerQuestionTime,
                'user_id' => $user->id
            ]);
            //get the categories to extract questions from
            $testCategories = $template->categories;
            //prepare an array
            $questionsArray = [];
            //for each category randomly select questions
            foreach ($testCategories as $category) {
                $extractedQuestionsModels = Question::inRandomOrder()
                    ->where([
                        ['category_id', '=', $category['id']],
                        ['difficulty', '>=', $category['minDiff']],
                        ['difficulty', '<=', $category['maxDiff']]
                    ])
                    ->limit($category['count'])
                    ->get();
                //and add them to the array of questions
                foreach($extractedQuestionsModels as $question){
                    $questionsArray[] = [
                        "id" => $question->id,
                        "question" => $question->question,
                        "note" => $question->note,
                        "category" => $question->category->name,
                        "difficulty" => $question->difficulty,
                        "multiselect" => $question->multiselect,
                        "options" => $question->options
                    ];
                }
            }
             //remove all options' answers and add the "selected" field
             foreach($questionsArray as &$question){
                 foreach($question["options"] as &$option){
                     unset($option["correct"]);
                     $option["correct"] = false;
                     $option["selected"] = false;
                }
            }

            $newTest->questions = $questionsArray;
            $newTest->save();
            return response()->json($newTest, 200);
            //remove the reference to the template from the user's assigned tests
            //...so that the user is unable to complete this test again
            //TODO
        }//try
        catch(CustomException $e){
            return response()->json($e, 400);
        }
    }//generate()

    public function store(){
        $input = request()->input();
        
        try{
            if(isset($input["id"]) && isset($input["questions"])){
                //get the test
                $testId = $input["id"];
                $realTest = Test::find($testId);
                //get the questions from the real test
                $realTestQuestions = $realTest->questions;
                //extract the questions and answers from the input
                $questionsArray = $input["questions"];
                //grade and update
                foreach($questionsArray as $questionAsArray){
                    //grade the question
                    $gradedQuestionAsArray = $this->gradeQuestion($questionAsArray);
                    //find a question and replace the default options with the graded ones
                    foreach($realTestQuestions as &$realTestQuestion){ //reference!
                        if($realTestQuestion['id'] == $gradedQuestionAsArray['id']){
                            $realTestQuestion['options'] = $gradedQuestionAsArray['options'];
                        }
                    }
                }
                //update the data
                $realTest->questions = $realTestQuestions;
                //dd($realTest);
                $realTest->save();
                return response()->json($realTest, 200);
            }
            else{
                throw new CustomException("Invalid request.");
            }
        }
        catch(CustomException $e){
            return response()->json($e, 400);
        }
    }//store()

    public function update(){
        $input = request()->input();

        try{
            if(isset($input["id"]) && isset($input["questions"])){
                $testId = $input["id"];
                $questionAsArray = $input["questions"][0];
                //grade the question
                $gradedQuestionAsArray = $this->gradeQuestion($questionAsArray);
                //get the test
                $realTest = Test::find($testId);
                //get the questions
                $realTestQuestions = $realTest->questions;
                //find a question and replace the default options with the graded ones
                foreach($realTestQuestions as &$realTestQuestion){ //reference!
                    if($realTestQuestion['id'] == $gradedQuestionAsArray['id']){
                        $realTestQuestion['options'] = $gradedQuestionAsArray['options'];
                    }
                }
                //update the data
                $realTest->questions = $realTestQuestions;
                //dd($realTest);
                $realTest->save();
                return response()->json("", 200);
            }
            else{
                throw new CustomException("Invalid request.");
            }
        }
        catch(CustomException $e){
            return response()->json($e, 400);
        }

    }//update()
}

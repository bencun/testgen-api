<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\CustomException;
use App\User;
use App\Category;
use App\Question;
use App\TestTemplate;

class TestController extends Controller
{
    public function generate(User $user, TestTemplate $template){
        //generate a new test and return it
        //User::inRandomOrder()->get();

        //remove the reference to the template from the user's assigned tests
        //...so that the user is unable to complete this test again
    }
}

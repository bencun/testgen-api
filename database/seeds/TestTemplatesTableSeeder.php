<?php

use Illuminate\Database\Seeder;
use App\TestTemplate;

class TestTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TestTemplate::create([
            'name' => "Junior full stack developer [timed]",
            'description' => "This template is used during the full stack developer interview.",
            'timed' => true,
            'timedTotal' => true,
            'timedTotalTime' => 3,
            'timedPerQuestion' => false,
            'timedPerQuestionTime' => 60,
            'categories' =>[
                [
                    'id' => 1,
                    'minDiff' => 1,
                    'maxDiff' => 7,
                    'count' => 3
                ],
                [
                    'id' => 2,
                    'minDiff' => 1,
                    'maxDiff' => 7,
                    'count' => 3
                ]
            ]
        ]);

        TestTemplate::create([
            'name' => "Junior full stack developer [timed per question]",
            'description' => "This template is used during the full stack developer interview.",
            'timed' => true,
            'timedTotal' => false,
            'timedTotalTime' => 3,
            'timedPerQuestion' => true,
            'timedPerQuestionTime' => 25,
            'categories' =>[
                [
                    'id' => 1,
                    'minDiff' => 1,
                    'maxDiff' => 7,
                    'count' => 3
                ],
                [
                    'id' => 2,
                    'minDiff' => 1,
                    'maxDiff' => 7,
                    'count' => 3
                ]
            ]
        ]);
    }
}

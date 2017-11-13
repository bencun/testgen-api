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
            'name' => "Junior full stack developer",
            'description' => "This template is used during the full stack developer interview.",
            'timed' => true,
            'timedTotal' => true,
            'timedTotalTime' => 45,
            'timedPerQuestion' => true,
            'timedPerQuestionTime' => 60,
            'categories' =>[
                [
                    'id' => 1,
                    'minDiff' => 2,
                    'maxDiff' => 7,
                    'count' => 3
                ],
                [
                    'id' => 2,
                    'minDiff' => 4,
                    'maxDiff' => 6,
                    'count' => 2
                ],
                [
                    'id' => 3,
                    'minDiff' => 1,
                    'maxDiff' => 4,
                    'count' => 3
                ],
            ]
        ]);
    }
}

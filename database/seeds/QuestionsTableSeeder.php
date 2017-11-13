<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::create([
            'category_id' => 1,
            'difficulty' => 3,
            'question' => "What are the opening and the closing tag of the PHP file?",
            'note' => "There are multiple correct answers.",
            'multiselect' => true,
            'options' => [
                [
                  "option" => "<!php",
                  "correct" => false
                ],
                [
                  "option" => "<?php",
                  "correct" => true
                ],
                [
                  "option" => "?>",
                  "correct" => true
                ],
                [
                  "option" => ">>",
                  "correct" => false
                ]
              ]
        ])->save();
        


        for ($i=1; $i < 49; $i++) {
            Question::create([
                'category_id' => ($i % 3) + 1,
                'difficulty' => ($i % 10) + 1,
                'question' => "Dummy question " . $i,
                'note' => "Dummy question note, category " . (($i % 3) + 1) . " and difficulty " . (($i % 10) + 1),
                'multiselect' => false,
                'options' => [
                    [
                        'option' => "Dummy option 1",
                        'correct' => false
                    ],
                    [
                        'option' => "Dummy option 2",
                        'correct' => true
                    ],
                ]
            ]);
        }
    }
}

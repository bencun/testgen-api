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
            'difficulty' => 2,
            'question' => "What function is used for logging the output to the console in Javascript?",
            'note' => "One answer applies.",
            'multiselect' => false,
            'options' => [
                [
                    "option" => "console.log()",
                    "correct" => true
                ],
                [
                    "option" => "window.log()",
                    "correct" => false
                ],
                [
                    "option" => "log.put()",
                    "correct" => false
                ]

              ]
        ])->save();

        Question::create([
            'category_id' => 1,
            'difficulty' => 5,
            'question' => "What does the keyword 'delete' do in Javascript?",
            'note' => "",
            'multiselect' => false,
            'options' => [
                [
                    "option" => "Deletes an object and releases the memory.",
                    "correct" => false
                ],
                [
                    "option" => "Removes the property of an object.",
                    "correct" => true
                ]
              ]
        ])->save();

        Question::create([
            'category_id' => 1,
            'difficulty' => 3,
            'question' => "Which objects below have a valid syntax in Javascript?",
            'note' => "There are multiple correct answers.",
            'multiselect' => true,
            'options' => [
                [
                    "option" => "{variable: 44}",
                    "correct" => true
                ],
                [
                    "option" => "{array: {element: 1}, {element: 2}}",
                    "correct" => false
                ],
                [
                    "option" => "{array: [{element: 'value'}, {element: 2}]}",
                    "correct" => true
                ],
              ]
        ])->save();

        Question::create([
            'category_id' => 1,
            'difficulty' => 2,
            'question' => "What is JSON?",
            'note' => "",
            'multiselect' => false,
            'options' => [
                [
                    "option" => "A programming language.",
                    "correct" => false
                ],
                [
                    "option" => "A network transfer protocol.",
                    "correct" => false
                ],
                [
                    "option" => "Data interchange format.",
                    "correct" => true
                ],
              ]
        ])->save();

        Question::create([
            'category_id' => 2,
            'difficulty' => 2,
            'question' => "What are the opening and closing tags of the PHP script?",
            'note' => "There are multiple correct answers.",
            'multiselect' => true,
            'options' => [
                [
                    "option" => "<?php",
                    "correct" => true
                ],
                [
                    "option" => "!php",
                    "correct" => false
                ],
                [
                    "option" => "?>",
                    "correct" => true
                ],
                [
                    "option" => "<?!",
                    "correct" => false
                ],
                [
                    "option" => "<<<php",
                    "correct" => false
                ],
                [
                    "option" => "?!>",
                    "correct" => false
                ]
              ]
        ])->save();

        Question::create([
            'category_id' => 2,
            'difficulty' => 6,
            'question' => "What function is used for secure password hashing in PHP?",
            'note' => "",
            'multiselect' => false,
            'options' => [
                [
                    "option" => "md5();",
                    "correct" => false
                ],
                [
                    "option" => "sha256_salt();",
                    "correct" => false
                ],
                [
                    "option" => "password_generate();",
                    "correct" => false
                ],
                [
                    "option" => "password_hash();",
                    "correct" => true
                ]
              ]
        ])->save();

        Question::create([
            'category_id' => 2,
            'difficulty' => 3,
            'question' => "Where should data validation take place when creating a modern website using PHP?",
            'note' => "",
            'multiselect' => false,
            'options' => [
                [
                    "option" => "Data validation should be done on client side.",
                    "correct" => false
                ],
                [
                    "option" => "Data validation should be done on server side.",
                    "correct" => true
                ],
                [
                    "option" => "Data validation isn't important.",
                    "correct" => false
                ]
              ]
        ])->save();

        for ($i=1; $i < 35 ; $i++) { 
            Question::create([
                'category_id' => 3,
                'difficulty' => 3,
                'question' => "Dummy question #".$i,
                'note' => "Dummy note #".$i,
                'multiselect' => false,
                'options' => [
                    [
                        "option" => "Dummy option #1.",
                        "correct" => false
                    ],
                    [
                        "option" => "Dummy option #2.",
                        "correct" => false
                    ],
                    [
                        "option" => "Dummy option #3.",
                        "correct" => false
                    ]
                  ]
            ])->save();
        }
    }
}

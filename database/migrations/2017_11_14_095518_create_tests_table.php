<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            //data copied from test template that was used
            $table->string('name');
            $table->text('description');
            $table->boolean('timed');
            $table->boolean('timedTotal');
            $table->integer('timedTotalTime');
            $table->boolean('timedPerQuestion');
            $table->integer('timedPerQuestionTime');

            //user who filled the test
            $table->integer('user_id');
            /*questions array
            each option has a "correct" attribute which determines if the option is a part of a valid answer
            "selected" means that the user has selected that option
            {
                question: stc,
                note: note,
                category: str
                difficulty: int,
                options:[
                    option: str,
                    correct: bool,
                    selected: bool
                ]
            }
            */
            $table->json('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}

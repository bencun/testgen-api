<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(["name" => "Vanilla Javascript", "description" => "This category contains vanilla JS questions."])->save();
        Category::create(["name" => "Vanilla PHP", "description" => "This category contains vanilla PHP (7.x) questions."])->save();
        Category::create(["name" => "Pagination demo category", "description" => "This category contains no real questions."])->save();
        //Category::create(["name" => "Laravel 5.x", "description" => "Questions about Laravel 5.x."])->save();        
    }
}

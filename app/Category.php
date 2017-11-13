<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class Category extends Model
{
    protected $guarded = ['created_at', 'updated_at'];
    protected $fillable = ["name", "description"];

    public function questions(){
        return $this->hasMany(Question::class);
    }
}

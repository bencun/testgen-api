<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Question extends Model
{
    protected $guarded = ['created_at', 'updated_at'];

    protected $casts = [
        'options' => 'array'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    protected $casts = [
        'questions' => 'array'
    ];
}

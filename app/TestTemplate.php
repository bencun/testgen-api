<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestTemplate extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    protected $casts = [
        'categories' => 'array'
    ];
}

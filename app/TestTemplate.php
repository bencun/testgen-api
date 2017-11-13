<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestTemplate extends Model
{
    protected $casts = [
        'categories' => 'array'
    ];
}

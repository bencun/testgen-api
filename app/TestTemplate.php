<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestTemplate extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    protected $casts = [
        'categories' => 'array'
    ];

    public function getTimedAttribute($timed)
    {
        return (bool) $timed;
    }

    public function getTimedTotalAttribute($timedTotal)
    {
        return (bool) $timedTotal;
    }
    
    public function getTimedPerQuestionAttribute($timedPerQuestion)
    {
        return (bool) $timedPerQuestion;
    }
}

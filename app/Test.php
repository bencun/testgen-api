<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Test extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    protected $casts = [
        'questions' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

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

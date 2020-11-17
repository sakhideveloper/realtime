<?php

namespace App;

use App\Quiz;
use App\QuizOption;
use App\QuizResponses;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = ['quiz_id','title','type','status'];

    public function quiz()
    {
    	return $this->belongsTo(Quiz::class);
    }

    public function options()
    {
    	return $this->hasMany(QuizOption::class,'question_id');
    }

    public function responses()
    {
    	return $this->belongsToMany(QuizOption::class,'quiz_responses','question_id','option_id')
        ->withPivot('created_at')->orderBy('pivot_created_at', 'desc');
    }
}

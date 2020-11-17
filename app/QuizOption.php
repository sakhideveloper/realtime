<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizOption extends Model
{
    protected $fillable = ['quiz_id','question_id','option','is_correct'];
}

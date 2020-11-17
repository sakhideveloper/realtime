<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizResponses extends Model
{
	 /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $fillable = ['question_id','option_id'];
}

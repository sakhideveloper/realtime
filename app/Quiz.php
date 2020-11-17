<?php

namespace App;

use App\QuizQuestion;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['quiz_hash','quiz_title','quiz_slug','status','qr_code'];

    public function questions()
    {
    	return $this->hasMany(QuizQuestion::class);
    }
}

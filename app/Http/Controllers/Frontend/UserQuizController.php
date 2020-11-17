<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Quiz;
use Illuminate\Http\Request;

class UserQuizController extends Controller
{
    public function launch($hashId)
    {
        $hashId = Quiz::where('quiz_hash',$hashId)->firstOrFail()->quiz_hash;

        return view('quizzes.launch',compact('hashId'));
    }

    public function taking($hashId)
    {
        return view('quizzes.frontend.taking');
    }
}

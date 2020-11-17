<?php

namespace App\Http\Livewire\Quizzes;

use App\Quiz;
use App\QuizResponses;
use Livewire\Component;

class QuizTakingComponent extends Component
{
    public $quizHash,$quiz,$answer,$status = true;

    protected $listeners = ['question-launched' => 'showResponses','goOffline' => 'showResponses'];

    public function showResponses()
    {
        $this->status = true;
    }

    public function submitResponse($questionId)
    {
        QuizResponses::create([
            'question_id' => $questionId,
            'option_id' => $this->answer,
        ]);
        
        if (session()->has('quizzy-'.$this->quizHash)) {
            $this->setSessionValues($questionId);     
        }
        else {
            session()->put('quizzy-'.$this->quizHash, [$questionId]);  
        }

        $this->answer = '';

        $this->status = false;
    }

    public function mount($quizHash)
    {
        $this->quizHash = $quizHash;
    }

    public function render()
    {
        $this->quiz = Quiz::with(['questions' => function($query) {
            $query->where('status',1);
        }])->where('quiz_hash',$this->quizHash)->firstOrFail();

        if($this->quiz->questions->first() != null)
        {
            if (in_array($this->quiz->questions->first()->id,session()->get('quizzy-'.$this->quizHash) ?? [])) {
                $this->status = false;
            }
        }

        return view('livewire.quizzes.quiz-taking-component');
    }

    protected function setSessionValues($questionId) 
    { 
        return session()->put('quizzy-'.$this->quizHash, array_unique(array_merge([$questionId] , session()->get('quizzy-'.$this->quizHash)))); 
    }
}

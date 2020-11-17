<?php

namespace App\Http\Livewire\Quizzes;

use App\Events\GoOffline;
use App\Quiz;
use App\QuizQuestion;
use Illuminate\Support\Collection;
use Livewire\Component;

class ResponseComponent extends Component
{
	public $question,$responses,$quiz_id;

    protected $listeners = ['question-launched' => 'showResponses'];

    public function showResponses($questionId)
    {
    	$this->question = QuizQuestion::with(['responses' => function($query){
            $query->orderBy('id');
        }])->findOrFail($questionId);
    }

    public function goOffline()
    {
        $this->question->update(['status' => 0]);

        $this->question = null;

        event(new GoOffline());
        $this->emit('goOffline');
    }

    public function render()
    {
        $this->quiz_id = request()->quiz_id;
        return view('livewire.quizzes.response-component');
    }
}

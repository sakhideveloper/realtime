<?php

namespace App\Http\Livewire\Quizzes;

use App\Events\QuestionLaunched;
use Illuminate\Support\Collection;
use Livewire\Component;

class QuestionsComponent extends Component
{
	public $questions;

    protected $listeners = ['goOffline' => 'reRender'];

	public function mount(Collection $questions)
	{
		$this->questions = $questions;
	}

	public function reRender()
	{
		# code...
	}

	public function launchQuestion($question_id)
	{	
		$question = $this->questions->where('id',$question_id)->first();

		if ($question->status != 1) {
			optional($this->questions->where('status',1)->first())->update(['status' => 0]);
			$question->update(['status' => 1]);			
		}

		event(new QuestionLaunched());
		$this->emit('question-launched',$question_id);
	}
	
    public function render()
    {
        return view('livewire.quizzes.questions-component');
    }
}

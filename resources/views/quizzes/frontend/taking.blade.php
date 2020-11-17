@extends('layouts.app')

@push('css')
	<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        	@livewire('quizzes.quiz-taking-component',['quizHash' => request()->quiz_id])
        </div>
    </div>
</div>
@endsection

@push('js')
  	<script>
	    // Enable pusher logging - don't include this in production
	    // Pusher.logToConsole = true;

	    var pusher = new Pusher('{{ env('PUSHER_APP_CLIENT') }}', {
	      cluster: 'mt1'
	    });

	    var channel = pusher.subscribe('quizzy');
	    
	    channel.bind('goOffline', function(data) {
	    	window.livewire.emit('goOffline');
	    });

	    channel.bind('question-launched', function(data) {
	    	window.livewire.emit('question-launched');
	    });
  	</script>
@endpush

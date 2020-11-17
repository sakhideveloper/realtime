<div>
<div class="card">
    @if ($quiz->questions->count())

    @if ($status)

    <div class="card-header">
        <h1>{{ $quiz->questions->first()->title }}</h1>
    </div>

    <div class="card-body">
       	
       	<form action="" method="POST" role="form" wire:submit.prevent="submitResponse({{ $quiz->questions->first()->id }})">
             <h4 class="mb-4">Your Answer ?</h4>
                
                <div class="form-group">
                    <ul class="list-group">
                    @forelse($quiz->questions->first()->options as $option)
                        <li class="list-group-item">
                              <div class="checkbox">
                                <input type="radio" name="answer" value="{{ $option->id }}" wire:model="answer" />
                                <label for="radio">
                                    {{ $option->option }}
                                </label>
                            </div>
                        </li>
                    @empty
                    @endforelse
                   </ul>        
                </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    @else
        <div class="card-body">
            <div class="alert alert-success">
                <strong>Hurrah!</strong> Waiting For New Question!!
            </div>
        </div>
    @endif

    @else
	    <div class="card-body">
		    <div class="alert alert-danger">
				<strong>Whoops!</strong> Looks Like Admin Locked the Question!!
			</div>
		</div>
    @endif
</div>

    
</div>

<ul class="list-group">
    @forelse($questions as $question)

    <li class="list-group-item">
        <h4>{{ $question->title }} ?</h4>
        
        @if ($question->status == 0)
            <a href="" class="btn btn-danger" style="display: block;" wire:click.prevent="launchQuestion({{ $question->id }})">Not Live</a>
        @else
            <a href="" class="btn btn-success" style="display: block;" wire:click.prevent="launchQuestion({{ $question->id }})">Live</a>
        @endif
    </li>

    @empty
    @endforelse
</ul> 
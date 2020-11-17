<div>
    @if (isset($question))
    <div wire:poll.750ms>
        <h1 style="padding-bottom: 20px;">
            {{ $question->title }}
            <a href="" wire:click.prevent="goOffline()" class="btn btn-danger" style="float: right;">
                GO OFFLINE
            </a>
        </h1>
        
        <table class="table table-hover">
            <tbody>
                @forelse($question->responses as $response)
                <tr>
                    <td>{{ $response->option }}</td>
                    <td>{{ $response->pivot->created_at->diffForHumans() }}</td>
                </tr>
                
                @empty

                @endforelse
            </tbody>
        </table>
    </div>
    @endif
</div>

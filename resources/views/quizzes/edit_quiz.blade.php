@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    Quizzes
                    <a href="{{ route('quiz.index') }}" class="btn btn-warning pull-right">Back</a>
                </div>

                <div class="card-body">
                    
                    @include('quizzes.partials.alert')
                    @include('quizzes.partials.errors')

                    <form action="{{ route('quiz.update',$quiz->id) }}" method="POST" role="form">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" id="" name="title" placeholder="Title"
                            value="{{ $quiz->quiz_title }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="inputStatus" class="form-control" required="required">
                                <option value="1" {{ $quiz->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $quiz->status == 0 ? 'selected' : '' }}>Disable</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                   
                </div>
            </div> 
        </div>
        <div class="col-md-4">
            <div class="visible-print text-center">
                {!! QrCode::size(200)->size(300)->gradient(255, 0, 0,21,55,87,'vertical')->generate(route('quiz.show',$quiz->quiz_hash)); !!}
                <p>Scan me to return to the original page.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
{{--  --}}
@endpush

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-4"  style="margin-bottom: 10px;">
            <div class="card">
                <div class="card-header">
                    Questions
                    <a href="{{ route('quiz.index') }}" class="btn btn-warning pull-right">Back</a>
                </div>

                <div class="card-body">

                    @include('quizzes.partials.alert')

                    @livewire('quizzes.questions-component',['questions' => $quiz->questions])                 
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Responses
                    <a href="{{ route('quiz.launch',$quiz->quiz_hash) }}" target="_blank" style="float:right;" class="btn btn-success">Launch</a>
                </div>

                <div class="card-body">

                   @livewire('quizzes.response-component')
                
                </div>
            </div>
        </div>        
    </div>
</div>
@endsection


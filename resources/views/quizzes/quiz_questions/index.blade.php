@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Quiz Questions
                    <a href="{{ route('quiz-question.create',['quiz_id' => $quiz->id]) }}" class="btn btn-warning pull-right">Add+</a>
                </div>

                <div class="card-body">

                    @include('quizzes.partials.alert')

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($quiz->questions as $question)
                            <tr>
                                <td>{{ $question->title }}</td>
                                <td>{{ $question->type == 1 ? 'Multiple Choice' : 'Unknown' }}</td>
                                <td>
                                    <div class="btn-group">
                                      <a href="{{ route('quiz-question.edit',$question->id) }}"  style="color:white;" class="btn btn-info btn-sm">Edit</a>
                                      <a href="javascript:" onclick="document.getElementById('question-del-form-{{ $question->id }}').submit()" class="btn btn-danger btn-sm">Delete</a>
                                    </div>

                                    <form action="{{ route('quiz-question.destroy',$question->id) }}" method="POST" 
                                        id="question-del-form-{{ $question->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
 {{--  --}}
@endpush

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Quizzes
                    <a href="{{ route('quiz.create') }}" class="btn btn-warning pull-right">Add+</a>
                </div>

                <div class="card-body">

                    @include('quizzes.partials.alert')

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Questions</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Results</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($quizzes as $quiz)
                            <tr>
                                <td>{{ $quiz->quiz_title }}</td>
                                <td><a href="{{ route('quiz-question.index',['quiz_id' => $quiz->id]) }}" class="btn btn-success btn-sm">Make</a></td>
                                <td>
                                    <span style="font-size: 18px;" class="badge badge-{{ $quiz->status == 1 ? 'success' : 'danger' }}">
                                        {{ $quiz->status == 1 ? 'Active' : 'Disabled' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                      <a href="{{ route('quiz.edit',$quiz->id) }}"  style="color:white;" class="btn btn-info btn-sm">Edit</a>
                                      <a href="" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('quiz.results.realtime',$quiz->quiz_hash) }}" class="btn btn-warning btn-sm">Resutls</a>
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Quizzes
                    <a href="{{ route('quiz.index') }}" class="btn btn-warning pull-right">Back</a>
                </div>

                <div class="card-body">
                    
                    @include('quizzes.partials.alert')
                    @include('quizzes.partials.errors')

                    <form action="{{ route('quiz.store') }}" method="POST" role="form">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" id="" name="title" placeholder="Title">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="inputStatus" class="form-control" required="required">
                                <option value="1">Active</option>
                                <option value="0">Disable</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
{{--  --}}
@endpush

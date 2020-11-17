@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Questions
                    <a href="{{ route('quiz-question.index',['quiz_id' => $quiz->id]) }}" class="btn btn-warning pull-right">Back</a>
                </div>

                <div class="card-body">
                    
                    @include('quizzes.partials.alert')
                    @include('quizzes.partials.errors')

                    <form action="{{ route('quiz-question.store') }}" method="POST" role="form">
                        @csrf
                        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" id="" name="title" placeholder="Title">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Type</label>
                            <select name="type" id="inputStatus" class="form-control" required="required">
                                <option value="1">Multiple Choice</option>
                            </select>
                        </div>

                        <button type="button" class="btn btn-danger mb-4" id="add-options">Add</button>
                        <table class="table table-hover" id="questions">
                            <thead>
                                <tr>
                                    <th>Option</th>
                                    <th>Is Correct?</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script type="text/javascript">
        // Video part
    var count = 0;
    html = '';
     
     
    dynamic_field_options(count);
       
    function dynamic_field_options(number)
    {
      html = '<tr>'; 
      html += '<td><input type="text" name="option[title][]" value="" placeholder="Title" class="form-control" required /></td>';
      html += '<td><input type="radio" name="option[is_correct][]" value="'+number+'" class="form-control"/></td>';
        
      if(number > 0)
       {
          html += '<td><button type="button" name="remove" class="btn btn-danger remove-options">Remove</button></td></tr>';
           
          $("#questions tbody").append(html);   
       }
      else
      {   
        html = '';
        $("#questions tbody").append(html);
      }    
    }
       
      $(document).on('click', '#add-options', function(){
      count++;

      dynamic_field_options(count);  
      });

      $(document).on('click', '.remove-options', function(){
      count--;
      $(this).parent().parent().remove();
      });
    </script>
@endpush

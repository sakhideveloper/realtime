@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Questions
                    <a href="{{ route('quiz-question.index',['quiz_id' => $question->quiz_id]) }}" class="btn btn-warning pull-right">Back</a>
                </div>

                <div class="card-body">
                    
                    @include('quizzes.partials.alert')
                    @include('quizzes.partials.errors')

                    <form action="{{ route('quiz-question.update',$question->id) }}" method="POST" role="form">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" id="" name="title" placeholder="Title" value="{{ $question->title }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Type</label>
                            <select name="type" id="inputStatus" class="form-control" required="required">
                                <option value="1" {{ $question->type == 1 ? 'selected' : '' }}>Multiple Choice</option>
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
                              @forelse($question->options as $option)
                                <tr>
                                  <input type="hidden" name="option[id][]" value="{{ $option->id }}">
                                  <td><input type="text" name="option[title][]" value="{{ $option->option }}" placeholder="Title" class="form-control" required /></td>
                                  <td><input type="radio" name="option[is_correct][]" value="{{ $loop->index }}" class="form-control" {{ $option->is_correct == 1 ? 'checked' : '' }} required /></td>
                                  <td><a href="{{ route('option.delete',[$question->id,$option->id]) }}" class="btn btn-danger">Delete</a></td>
                                </tr>
                              @empty

                              @endforelse
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

    var count = $("#questions tbody tr").length - 1;
    html = '';
     
     
    dynamic_field_options(count);
       
    function dynamic_field_options(number)
    {
      html = '<tr>'; 
      html += '<td><input type="text" name="option[title][]" value="" placeholder="Title" class="form-control" required /></td>';
      html += '<td><input type="radio" name="option[is_correct][]" value="'+number+'" class="form-control"/></td>';
        
      if(number > ($("#questions tbody tr").length - 1))
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

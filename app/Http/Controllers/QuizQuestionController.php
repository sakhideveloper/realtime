<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\QuizOption;
use App\QuizQuestion;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (empty($request->quiz_id)) {
            return back();
        }

        $quiz = Quiz::with('questions')->findOrFail($request->quiz_id);

        return view('quizzes.quiz_questions.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quiz = Quiz::findOrFail(request()->quiz_id);

        return view('quizzes.quiz_questions.add_new_question',compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (empty($request->quiz_id)) {
            return back();
        }

        $options = [];

        $question = QuizQuestion::create([
            'quiz_id' => $request->quiz_id,
            'title' => $request->title,
            'type' => $request->type, //1=multiple choice
        ]);

        for($i = 0;$i < count($request->option['title']);$i++) {
            $term = $i;
            $option[$i]['quiz_id'] = $request->quiz_id;
            $option[$i]['question_id'] = $question->id;
            $option[$i]['option'] = $request->option['title'][$i];
            $option[$i]['is_correct'] = isset($request->option['is_correct']) && $request->option['is_correct'][0] == ($term + 1) ? 1 : 0;
            $option[$i]['created_at'] = now();
            $option[$i]['updated_at'] = now();
        }

        \DB::table('quiz_options')->insert($option);

        return back()->with('success','All went well');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(QuizQuestion $quizQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit($quizQuestion)
    {
        $question = QuizQuestion::with('quiz','options')->findOrFail($quizQuestion);

        return view('quizzes.quiz_questions.edit_question',compact('question'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuizQuestion $quizQuestion)
    {
        $options = [];

        $quizQuestion->title = $request->title;
        $quizQuestion->type = $request->type; //1=multiple choice
        $quizQuestion->update();

        for($i = 0;$i < count($request->option['title']);$i++) {
            $term = $i;
            $option[$i]['quiz_id'] = $quizQuestion->quiz_id;
            $option[$i]['question_id'] = $quizQuestion->id;
            $option[$i]['option'] = $request->option['title'][$i];
            $option[$i]['is_correct'] = isset($request->option['is_correct']) && $request->option['is_correct'][0] == $term ? 1 : 0;
            $option[$i]['created_at'] = now();
            $option[$i]['updated_at'] = now();

            if (isset($request->option['id'][$i])) 
            {
                \DB::table('quiz_options')->where('question_id',$quizQuestion->id)
                ->where('id',$request->option['id'][$i])->update($option[$i]);
            }
            else
            {
                \DB::table('quiz_options')->where('question_id',$quizQuestion->id)->insert($option[$i]);
            }

        }
        
        return back()->with('success','Question Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizQuestion $quizQuestion)
    {
        if ($quizQuestion->delete()) {
            return back()->with('success','Question Deleted Successfully');
        }
    }

    public function optionDeleteByQuestion($question,$option)
    {
        $option = QuizOption::where('question_id',$question)->where('id',$option)->firstOrFail();

        if ($option->delete()) {
            return back()->with('success','Option Deleted Successfully');
        }
    }
}

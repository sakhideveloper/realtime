<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuizController extends Controller
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
    public function index()
    {
        $quizzes = Quiz::all();

        return view('quizzes.index',get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quizzes.add_new_quiz');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required|integer',
        ]);

        $quiz = Quiz::create([
            'quiz_hash' => Str::uuid(),
            'quiz_title' => $request->title,
            'quiz_slug' => Str::slug($request->title),
            'status' => $request->status
        ]);

        //@todo
        //add and store qr code
        
        if ($quiz) 
        {
            return back()->with('success','Quiz added successfully');
        }
        else
        {
            return back()->with('error','Ahan Something went wrong! Try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        return view('quizzes.edit_quiz',compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required|integer',
        ]);

        $quiz->quiz_title = $request->title;
        $quiz->quiz_slug = Str::slug($request->title);
        $quiz->status = $request->status;

        if ($quiz->update()) 
        {
            return back()->with('success','Quiz Updated successfully');
        }
        else
        {
            return back()->with('error','Ahan Something went wrong! Try again');
        }
    }

    /**
     * Quiz Launch Day 
     *
     */
    public function launch($hashId)
    {
        // 
    }

    /**
     * View Results 
     *
     */
    public function viewResults($hashId)
    {
        $quiz = Quiz::where('quiz_hash',$hashId)->with('questions')->firstOrFail();

        return view('quizzes.viewResults',compact('quiz'));        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        //
    }
}

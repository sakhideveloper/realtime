<?php
use App\Events\TestEvent;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//realtime on taking side...
// go with pusher

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::resource('quiz','QuizController');
Route::resource('quiz-question','QuizQuestionController');

// option routes
Route::get('/option/delete/{question_id}/{option_id}','QuizQuestionController@optionDeleteByQuestion')->name('option.delete');


Route::get('/launch/{quiz_id}',"Frontend\UserQuizController@launch")->name('quiz.launch');
Route::get('/taking/{quiz_id}',"Frontend\UserQuizController@taking")->name('quiz.take');

Route::get('/view/results/{quiz_id}',"QuizController@viewResults")->name('quiz.results.realtime');

Route::get('/home', 'HomeController@index')->name('home');





















Route::get('/broadcast',function(){
	event(new TestEvent());
	// broadcast(new TestEvent());
});

<?php

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

Route::get('/', function () 
{
    return view('auth.login');
});



Route::post('/authenticate','Auth\Login@authenticate')->name('authenticate');

Auth::routes();

Route::get('/', function () 
{
    return view('welcome');
});

Route::get('test/login', 'HomeController@index')->name('welcome');



Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'HomeController@users')->name('users');


Route::resource('general', 'GeneralController');

// Route::post('exams', 'ExamController@index');

Route::resource('exams', 'ExamController');
Route::get('test/login', 'ExamController@login');
Route::get('test/login', 'ExamController@login')->name('test.login');
Route::post('test/check_exam_details', 'ExamController@check_exam_details');
Route::get('test/instruction', 'ExamController@instruction')->name('test.instruction');


Route::get('exam/end-test', 'ExamController@EndTest');
Route::get('test/exam', 'ExamController@Exam');
Route::post('test/next', 'ExamController@Next');
//Route::get('test/next', 'ExamController@Next');


Route::get('/access-exam', 'ExamController@AccessExam')->name('access-exam');
Route::get('/promote-student', 'ResultController@promote_students')->name('promote-student');
// Route::post('/authenticate-exam-credentials', 'ExamController@check_exam_details')->name('authenticate-exam-credentials');


Route::get('/exam', 'GeneralController@newexam')->name('newexam');



Route::resource('results', 'ResultController');
Route::get('/check-result', 'ResultController@FindResult')->name('check-result');
Route::get('/getStudentResults','ResultController@getStudentResults', function() { return Result::with(['student', 'classed', 'session', 'subject'])->get(); });
// Route::get('results-upload', 'StudentController@studentUpload');
Route::post('/updateResultRemark', 'ResultController@updateResultRemark')->name('updateResultRemark');






Route::get('/getNextQuestion','ExamController@getNextQuestion');
Route::get('/getNextMarkedQuestion','ExamController@getNextMarkedQuestion');
Route::get('/getAllMarkedQuestion','ExamController@getAllMarkedQuestion');
Route::get('/getMarkedQuestion/{id}','ExamController@getMarkedQuestion');
Route::get('exams/markedQuestionPage','ExamController@markedQuestionPage');
Route::get('/getPreviousQuestion/{question_no}','ExamController@getPreviousQuestion');
Route::post('/updateLastViewQuestion','ExamController@updateLastViewQuestion');
Route::get('/getAnsweredQuestionCount','ExamController@getAnsweredQuestionCount');
Route::get('/getPendingQuestionCount','ExamController@getPendingQuestionCount');
Route::get('/getMarkQuestionCount','ExamController@getMarkQuestionCount');



Route::post('batch-excel-create', 'QuestionController@batchExcelCreate');
Route::post('user-exam-upload', 'ExamUserController@userExamUpload');

Route::post('student-upload', 'StudentController@studentUpload');

Route::post('staff-upload', 'StaffController@staffUpload');
Route::post('timetable-upload', 'TimeTableController@timeTableUpload');




Route::get('about', 'HomeController@about');











// Route to resolve Laravel to Vue Route
Route::get('/{vue_capture?}', function () 
{  
	if(\Auth::guest()){
		return redirect('login');
	}
   return view('welcome');
})->where('vue_capture', '^(?!storage).*$'); 


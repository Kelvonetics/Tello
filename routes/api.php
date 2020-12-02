<?php

use App\ExamPin;
use App\Http\Resources\Question;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
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

Route::middleware('auth:api')->get('/user', function (Request $request) 
{
    return $request->user();
});








//dashboard
Route::get('get_exams', 'HomeController@getExams');
Route::get('completed_exams', 'HomeController@completedExams');
Route::get('total_live_exams', 'HomeController@totalLiveExams');
Route::get('total_exam_users', 'HomeController@totalExamUsers');
Route::get('users_finished', 'HomeController@finishedUsers');
Route::get('total_live_users', 'HomeController@totalLiveUsers');






//User
//List Users
Route::get('users', 'UserController@index', function() { return User::with('state')->get(); });
Route::get('user/{id}', 'UserController@show');
Route::post('user', 'UserController@store');
Route::put('user', 'UserController@store');
Route::delete('user/{id}', 'UserController@destroy');


//List State




//QUESTIONS
//List Questions
Route::get('questions', 'QuestionController@index', function() { return Question::with(['classed', 'subject'])->get(); });
Route::get('question/{id}', 'QuestionController@show');
Route::post('question', 'QuestionController@store');
Route::put('question', 'QuestionController@store');
Route::delete('question/{id}', 'QuestionController@destroy');





//List Test Questions
Route::get('tests', 'TestController@index');
Route::get('test/{id}', 'TestController@show');


//Exam Types
Route::get('exam_types', 'ExamTypeController@index', function() { return ExamType::with('user')->get(); });
Route::get('exam_type/{id}', 'ExamTypeController@show');
Route::post('exam_type','ExamTypeController@store');
Route::put('exam_type', 'ExamTypeController@store');
Route::delete('exam_type/{id}','ExamTypeController@destroy');






//List Gradings
Route::get('gradings', 'GradingController@index', function() { return Grading::with(['exam', 'session'])->get(); });
Route::post('grading', 'GradingController@store');
Route::put('grading', 'GradingController@store');
Route::delete('grading/{id}', 'GradingController@destroy');



//List ExamUsers
Route::get('exam_users', 'ExamUserController@index');
Route::get('exam-users-by-id/{id}','ExamUserController@getUsersByExamId');
Route::get('exam_user/{id}', 'ExamUserController@show');
Route::post('exam_user', 'ExamUserController@store');
Route::put('exam_user', 'ExamUserController@store');
Route::delete('exam_user/{id}', 'ExamUserController@destroy');



//List Accesses
Route::get('accesses', 'AccessController@index');
Route::get('access/{id}', 'AccessController@show');
Route::get('access-exam-id/{id}', 'AccessController@showByExamId');
Route::post('access', 'AccessController@store');
Route::put('access/{access}', 'AccessController@update');
Route::delete('access/{id}', 'AccessController@destroy');












//Session
Route::get('sessions', 'SessionController@index');
Route::get('session/{id}', 'SessionController@show');
Route::post('session', 'SessionController@store');
Route::put('session', 'SessionController@store');
Route::delete('session/{id}', 'SessionController@destroy');
Route::get('session-by-id/{id}', 'SessionController@sessionById');


//students
Route::get('students', 'StudentController@index', function() { return Student::with(['classed', 'session', 'state'])->get(); });
Route::get('student/{id}', 'StudentController@show');
Route::post('student', 'StudentController@store');
Route::put('student', 'StudentController@store');
Route::delete('student/{id}', 'StudentController@destroy');

//Staff
Route::get('staffs', 'StaffController@index', function() { return Student::with(['designation', 'state', 'session'])->get(); });
Route::get('staff/{id}', 'StaffController@show');
Route::post('staff', 'StaffController@store');
Route::put('staff', 'StaffController@store');
Route::delete('staff/{id}', 'StaffController@destroy');

//Classes
Route::get('classes', 'ClassController@index', function() { return Subject::with(['classe', 'session'])->get(); });
Route::get('classe/{id}', 'ClassController@show');
Route::post('classe', 'ClassController@store');
Route::put('classe', 'ClassController@store');
Route::delete('classe/{id}', 'ClassController@destroy');

//Subject
Route::get('subjects', 'SubjectController@index', function() { return Subject::with(['session'])->get(); });
Route::get('subject/{id}', 'SubjectController@show');
Route::post('subject', 'SubjectController@store');
Route::put('subject', 'SubjectController@store');
Route::delete('subject/{id}', 'SubjectController@destroy');


//STUDENT PARENT
Route::get('parent_details', 'ParentDetailController@index');
Route::get('parent_detail/{id}', 'ParentDetailController@show');
Route::get('student-parent-by-id/{id}', 'ParentDetailController@showByStudentId');
Route::post('parent_detail', 'ParentDetailController@store');
Route::put('parent_detail/{parent_detail}', 'ParentDetailController@update');
Route::delete('parent_detail/{id}', 'ParentDetailController@destroy');

//TimeTable
Route::get('time_tables', 'TimeTableController@index', 
function() { return Student::with(['classed', 'session', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'])->get(); });
Route::get('time_table/{id}', 'TimeTableController@show');
Route::post('time_table', 'TimeTableController@store');
Route::put('time_table', 'TimeTableController@store');
Route::delete('time_table/{id}', 'TimeTableController@destroy');


//STAFF SUBJECTS
Route::get('staff_subjects/{id}', 'StaffSubjectController@index');
Route::get('staff_subject/{id}', 'StaffSubjectController@show');
Route::get('staff-subject-by-id/{id}', 'StaffSubjectController@showByStaffId');
Route::get('staff-subjects-by-id/{id}', 'StaffSubjectController@showSubjectsByStaffId');
Route::get('staff-details-by-id/{id}', 'StaffSubjectController@showDetailsByStaffId');
Route::post('staff_subject', 'StaffSubjectController@store');
Route::put('staff_subject/{staff_subject}', 'StaffSubjectController@update');
Route::delete('staff_subject/{id}', 'StaffSubjectController@destroy');


//STAFF QUALIFICATION
Route::get('staff_qualifications/{id}', 'StaffQualificationController@index');
Route::get('staff_qualification/{id}', 'StaffQualificationController@show');
Route::get('staff-qualification-by-id/{id}', 'StaffQualificationController@showByStaffId');
Route::get('staff-details-by-id/{id}', 'StaffQualificationController@showDetailsByStaffId');
Route::post('staff_qualification', 'StaffQualificationController@store');
Route::put('staff_qualification/{staff_qualification}', 'StaffQualificationController@update');
Route::delete('staff_qualification/{id}', 'StaffQualificationController@destroy');


//FEES
Route::get('fees', 'FeeController@index', function() { return Grading::with(['classed', 'session'])->get(); });
Route::get('fee/{id}', 'FeeController@show');
Route::post('fee', 'FeeController@store');
Route::put('fee', 'FeeController@store');
Route::delete('fee/{id}', 'FeeController@destroy');


//Exam
Route::get('exam_pins', 'ExamSetupController@index', function() { return ExamPin::with(['classed', 'subject', 'session'])->get(); });
Route::get('exam_pin/{id}', 'ExamSetupController@show');
Route::post('exam_pin', 'ExamSetupController@store');
Route::put('exam_pin', 'ExamSetupController@store');
Route::delete('exam_pin/{id}', 'ExamSetupController@destroy');


//results
Route::get('results', 'ResultController@index');




//Designation
Route::get('states', 'GeneralController@states');
Route::get('designations', 'GeneralController@designations');
Route::get('classed', 'GeneralController@classed');
Route::get('sessiones', 'GeneralController@sessions');
Route::get('year-books', 'GeneralController@yearBook');
Route::get('student-profile/{id}', 'GeneralController@studentProfile');

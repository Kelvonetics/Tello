<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth');
    }

    
        
   

    public function index(Request $request)
    {
        //$q = \App\Question::inRandomOrder()->get(); 

        $auth_exam = session('auth_exam'); 

        $date = date('Y-m-d');  
        $first_no = \App\Question::where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->
                                   where('term', $auth_exam->term)->orderBy('id', 'asc')->first();  
                                   
        $last_no = \App\Question::where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->
                                   where('term', $auth_exam->term)->orderBy('id', 'desc')->first(); 
        
        //GET A RANDOM NUMBER WITHIN THE QUESTION BANK RANGE 
        label1:
        $rand_no = rand($first_no->id, $last_no->id);

        //checking if question picked belongs to the right category
        $try_quest = \App\Question::where('id', $rand_no)->first();

        if($try_quest->subject_id == $auth_exam->subject_id && $try_quest->class_id == $auth_exam->class_id && $try_quest->term == $auth_exam->term)
        {
            $temp_question = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('question_id', $rand_no)->where('subject_id',$auth_exam->subject_id)->where('class_id',$auth_exam->class_id)->where('term',$auth_exam->term)->orderBy('id', 'asc')->first();
        
            if($temp_question) 
            {  
                // $rand_no++;       
                goto label1;   //pick another number                
            }
            else
            {       
                //logic for getting the last question details for this applicant
                $question_no_details = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('subject_id',$auth_exam->subject_id)->where('class_id',$auth_exam->class_id)->where('term',$auth_exam->term)->orderBy('id', 'desc')->first();

                if($question_no_details)
                {
                    $question_no = $question_no_details->question_no; 
                    $question_no++;
                    $time_left = $question_no_details->time_left;
                }
                else
                {
                    $question_no = 1;
                    $time_left = ($auth_exam->duration * 60); //this amount to (2700) 45 minutes by default.
                }                     

                //pulling the question based on the selected random number
                $questions = \App\Question::where('id', $rand_no)->first();
                //return $questions;

                //Inserting the question into the temporary question table
                $question = \App\TempQuestion::updateOrCreate
                (['id'=> $request->idd],
                [               
                    'subject_id' => $questions->subject_id, 
                    'class_id' => $questions->class_id, 
                    'term' => $questions->term, 
                    'section_id' => $questions->section_id, 
                    'questions' => $questions->questions,  
                    'type_id' => $questions->type_id,
                    'group1' => $questions->group1, 
                    'group2' => $questions->group2, 
                    'group3' => $questions->group3, 
                    'group4' => $questions->group4,
                    'option1' => $questions->option1, 
                    'option2' => $questions->option2, 
                    'option3' => $questions->option3, 
                    'option4' => $questions->option4, 
                    'answer' => $questions->answer, 
                    'question_id' => $rand_no,
                    'question_no' => $question_no,
                    'registration_no' => $auth_exam->registration_no,
                    'picked' => 0, 
                    'answered' => 0, 
                    'time_left' => $time_left, 
                    'date' => $date,
                    'refresh' => 0, 
                    'last_viewed' => 0,
                    'created_by' => 1,
                ]);             
            } 
        }
        else 
        {
            goto label1;
        }
        
         

        $answered = \App\TempQuestion::where('answered', 0)->where('picked', 0)->where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->count();

        $unanswered = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->count();
        $answered = $answered- 1;

        $marked = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('picked', 1)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->count();

        $pending = $auth_exam->no_of_questions - $answered - $marked;

        $mark = $auth_exam->mark_per_question;
        
        return view('exams.exams', compact('question', 'marked', 'answered', 'pending', 'auth_exam', 'mark'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        switch ($request->type) 
        {
            case 'next':
                return $this->Next($request);
            break;


            case 'exam':
                return $this->Exam($request);
            break;


            case 'check_exam_details':
                return $this->check_exam_details($request);
            break;


            default:
                # code...
            break;
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$route)
    {
        //
        switch ($route) 
        {
            case 'instruction':
                # code...
                return $this->Instruction($request);
                break;


            case 'end-test':
                # code...
                return $this->EndTest($request);
                break;


            case 'test':
                # code...
                return $this->Exam($request);
                break;


            

            default:
                return $this->index($request);
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }






    //functions
    public function login(Request $reques)
    {
        $exams = \App\ExamType::orderBy('test_name', 'asc')->get();
        return view('exams.login', compact('exams'));
    }



    public function check_exam_details(Request $request)
    {    
        // return $request->all();    
        try
        { 
            $date = date('Y-m-d');
            $auth_exam = \App\ExamPin::where('registration_no', $request->registration_no)->
                                   where('subject_id', $request->subject_id)->
                                   where('class_id', $request->class_id)->
                                   where('session_id', $request->session_id)->
                                   where('term', $request->term)->
                                   where('pin', $request->pin)->first();
                            
            if($auth_exam)
            {
                session(['auth_exam'=>$auth_exam]);                
                
                return view('exams.instruction')->with('auth_exam', $auth_exam);
            }
            else
            {
                return redirect()->route('access-exam')->with('error', 'Sorry, Exam Credential Do Not Match. ');
            }        
        }
        catch (\Exception $e) 
        {
            return redirect()->route('access-exam')->with('error', 'Sorry, Exam Credential Do Not Match. '.$e->getMessage());
        }        
    }



    public function Instruction(Request $reques)
    {
        return view('exams.instruction');
    }


    public function EndTest(Request $reques)
    {
        return view('exams.end-test');
    }



    public function Exam(Request $request)
    {  
        $auth_exam = session('auth_exam');             
        try
        {  
            $date = date('Y-m-d'); 
            $question_no = $request->q_n;
            $temp_question_ans = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('question_no', $question_no)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->first();
            $question_number = $request->question_number;
            $ans = $request->options;
            $ans != '' ? $answered = $ans : $answered = 0;
            //setting marks for each question
            $score_per_question = (100 / $auth_exam->no_of_questions);
            if($answered == $temp_question_ans->answer) { $scores = $score_per_question; } else{ $scores = 0.00; }

            //script to end text.
            if($request->end_test == 'end_test')
            {
                $data = array
                (
                  'question_no' => $question_no,
                  'picked' => 0,  
                  'scores' => $scores,
                  'answered' => $answered,  
                  'time_left' => $request->time_left, 
                  'updated_at' => date('Y-m-d h:i:s')
                );
                \App\TempQuestion::where('question_no', $question_no)->where('registration_no', $auth_exam->registration_no)->where('date', $date)->update($data);


                //computing result
                $total_scores = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->sum('scores'); 
                $total_scores = round($total_scores, 1); 
                $total_question = $auth_exam->no_of_questions;
                $total_answered = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)
                ->where('answered', 'A')->orwhere('answered', 'B')->orwhere('answered', 'C')->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->orwhere('answered', 'D')->count();
                $correct = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->where('scores', '!=', 0.00)->count();
                $incorrect = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->where('scores', 0.00)->count();
                $un_answered = $total_question - $total_answered;

                $grade = \App\Grading::where('exam_id', 1)->where('from', '<=', round($total_scores, 0))->where('to', '>=', round($total_scores, 0))->first();
                $time_used = $temp_question_ans->time_left - ($auth_exam->duration / 60);  
             
                //inserting question
                $question = \App\Result::insert
                (
                [               
                     'registration_no' => $temp_question_ans->registration_no,
                     'subject_id' => $temp_question_ans->subject_id, 
                     'class_id' => $temp_question_ans->class_id,
                     'term' => $temp_question_ans->term, 
                     'session_id' => $auth_exam->session_id,
                     'scores' => $total_scores, 
                     'total_question' => $total_question, 
                     'answered' => $total_answered, 
                     'answered_correct' => $correct, 
                     'answered_incorrect' => $incorrect, 
                     'un_answered' => $un_answered, 
                     'grade' => $grade->grade_name,
                     'time_used' => $time_used,
                     'date' => $temp_question_ans->date,
                ]);

                \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->delete();

                return view('exams.end-test')->with('info', 'Test ended, the Test coodinator will get back to you soon');
            }
            //script to submit answer and load the next question.
            else
            {             
                //condition for next btn
                if($question_number == 0)
                {
                    $data = array
                    (
                      'question_no' => $question_no, 
                      'picked' => 0, 
                      'scores' => $scores,
                      'answered' => $answered,  
                      'time_left' => $request->time_left,
                      'updated_at' => date('Y-m-d h:i:s')
                    );
                }//condition for marked for review
                else
                {
                    $data = array
                    (
                      'question_no' => $question_no, 
                      'picked' => 1, 
                      'scores' => $scores, 
                      // 'answered' => $answered,  
                      'time_left' => $request->time_left,
                      'updated_at' => date('Y-m-d h:i:s')
                    );
                }
                
                \App\TempQuestion::where('question_no', $question_no)->update($data);

                return redirect('exams');
            }
                        
        }
        catch (\Exception $e) 
        {
            return redirect('exams')->with('error', 'Sorry, An Error Occurred Please Try Again. '.$e->getMessage());
        } 
    }




    public function Next(Request $request)
    {        
        $date = date('Y-m-d');
        try
        {   
            $question_no = $request->question_number;
            $add_temp = \App\TempQuestion::updateOrCreate
            (['id'=> $request->id],
            [               
                 'category_id' => $request->question_number, 
                 'section_id' => $request->question_number, 
                 'questions' => $request->question_number, 
                 'option1' => $request->question_number, 
                 'option2' => $request->question_number, 
                 'option3' => $request->question_number, 
                 'option4' => $request->question_number, 
                 'answer' => $request->question_number, 
                 'question_id' => $request->question_number,
                 'question_no' => $question_number,
                 'registration_no' => 1,
                 'picked' => 1, 
                 'answered' => 0, 
                 'time_left' => 10, 
                 'date' => $date,
                 'refresh' => 1, 
                 'last_viewed' => 0,
                 'created_by' => 1,
            ]);
        }
        catch (\Exception $e) 
        {
            return redirect('exams')->with('error', 'Sorry, An Error Occurred Please Try Again. '.$e->getMessage());
        }
            return redirect('exams');
    }













    
    public function getNextQuestion(Request $request)
    {   
        $auth_exam = session('auth_exam');  

        //SCRIPT TO GET NEXT QUESTION
        $date = date('Y-m-d');   
        $first_no = \App\Question::where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->orderBy('id', 'asc')->first();  
        $last_no = \App\Question::where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->orderBy('id', 'desc')->first();  
        
        // 
        label1:
        $rand_no = rand($first_no->id, $last_no->id);

        //checking if question picked belongs to the right category
        $try_quest = \App\Question::where('id', $rand_no)->first();
        if($try_quest->subject_id == $auth_exam->subject_id && $try_quest->class_id == $auth_exam->class_id && $try_quest->term == $auth_exam->term)
        {
            $temp_question = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->where('date', $date)->where('question_id', $rand_no)->orderBy('id', 'asc')->first();
            if($temp_question) 
            {         
                // $rand_no++;       
                goto label1;   //pick another number 
            }
            else
            {
                $question_no_details = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->where('date', $date)->orderBy('id', 'desc')->first();

                if($question_no_details)
                {
                    $question_no = $question_no_details->question_no; 
                    $question_no++;
                    $time_left = $question_no_details->time_left;
                }
                else
                {
                    $question_no = 1;
                    $time_left = ($auth_exam->duration / 60); //this amount to (2700) 45 minutes by default.
                }                     

                $questions = \App\Question::where('id', $rand_no)->first();

                $question = \App\TempQuestion::updateOrCreate
                (['id'=> $request->idd],
                [               
                    'subject_id' => $questions->subject_id, 
                    'class_id' => $questions->class_id, 
                    'term' => $questions->term,
                    'section_id' => $questions->section_id, 
                    'questions' => $questions->questions, 
                    'type_id' => $questions->type_id,  
                    'group1' => $questions->group1, 
                    'group2' => $questions->group2, 
                    'group3' => $questions->group3, 
                    'group4' => $questions->group4, 
                    'option1' => $questions->option1, 
                    'option2' => $questions->option2, 
                    'option3' => $questions->option3, 
                    'option4' => $questions->option4, 
                    'answer' => $questions->answer, 
                    'question_id' => $rand_no,
                    'question_no' => $question_no,
                    'registration_no' => $auth_exam->registration_no,
                    'picked' => 0, 
                    'answered' => 0, 
                    'time_left' => $time_left, 
                    'date' => $date,
                    'refresh' => 0, 
                    'last_viewed' => 0,
                    'created_by' => 1,
                ]);             
            } 


            //SCRIPT TO UPDATE TEMPQUESTION DETAILS
            $question_no = $request->q_n;
            // return $auth_exam->registration_no .':'. $auth_exam->subject_id .':'. $auth_exam->class_id .':'. $auth_exam->term;
            $temp_question_ans = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->where('date', $date)->where('question_no', $question_no)->first();
            $question_number = $request->question_number;
            $ans = $request->options;
            $ans != '' ? $answered = $ans : $answered = 0;
            
            //setting marks for each question
            $score_per_question = (100 / $auth_exam->no_of_questions);
            if($answered == $temp_question_ans->answer) { $scores = $score_per_question; } else{ $scores = 0.00; }

            //script to end text.
            if($request->end_test == 'end_test')
            {
                $data = array
                (
                'question_no' => $question_no,
                'picked' => 0,  
                'scores' => $scores,
                'answered' => $answered,  
                'time_left' => $request->time_left, 
                'updated_at' => date('Y-m-d h:i:s')
                );
                \App\TempQuestion::where('question_no', $question_no)->where('registration_no', $auth_exam->registration_no)->where('date', $date)->update($data);

                //computing result
                $scores = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->sum('scores');    
                $scores = round($scores, 1);
                $total_question = $auth_exam->no_of_questions;
                $answered = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)
                ->where('answered', 'A')->orwhere('answered', 'B')->orwhere('answered', 'C')->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->orwhere('answered', 'D')->count();
                $correct = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->where('scores', '!=', 0.00)->count();
                $incorrect = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->where('scores', 0.00)->count();
                $un_answered = $total_question - $answered;
                $grade = \App\Grading::where('exam_id', $auth_exam->id)->where('from', '<>', round($scores, 0))->where('to', '<>', round($scores, 0))->first();
                $time_used = $temp_question_ans->time_left - ($auth_exam->duration / 60);  

                //inserting question
                $question = \App\TestResult::insert
                (
                [               
                    'registration_no' => $temp_question_ans->registration_no,
                    'category_id' => $temp_question_ans->category_id,  
                    'scores' => $scores, 
                    'total_question' => $total_question, 
                    'answered' => $answered, 
                    'answered_correct' => $correct, 
                    'answered_incorrect' => $incorrect, 
                    'un_answered' => $un_answered, 
                    'grade' => $grade,
                    'time_used' => $time_used,
                    'date' => $temp_question_ans->date,
                ]);
                \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->delete();            


            //return view('exams.instruction')->with('info', 'Test ended, the Test coodinator will get back to you soon');
            }
            //script to submit answer and load the next question.
            else
            {             
                //condition for next btn
                if($question_number == 0)
                {
                    $data = array
                    (
                    'question_no' => $question_no, 
                    'picked' => 0, 
                    'scores' => $scores,
                    'answered' => $answered,  
                    'time_left' => $request->time_left,
                    'updated_at' => date('Y-m-d h:i:s')
                    );
                }//condition for marked for review
                else
                {
                    $data = array
                    (
                    'question_no' => $question_no, 
                    'picked' => 1, 
                    'scores' => $scores, 
                    // 'answered' => $answered,  
                    'time_left' => $request->time_left,
                    'updated_at' => date('Y-m-d h:i:s')
                    );
                }
                
                \App\TempQuestion::where('question_no', $question_no)->update($data);

                //return redirect('exams');
            }
        }        
        else 
        {
            goto label1;
        }
      
        $marked = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('picked', 1)->count();

        return response()->json($question);
    }


    //START 
    public function getNextMarkedQuestion(Request $request)
    {  
        $auth_exam = session('auth_exam');  

        //SCRIPT TO 
        $date = date('Y-m-d'); 


        //SCRIPT TO UPDATE TEMPQUESTION DETAILS
        $question_no = $request->q_n_mark;
        $temp_question_ans = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('question_no', $question_no)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->first();
        $ans = $request->options_mark;
        $question_number = $request->question_number;
        $ans != '' ? $answered = $ans : $answered = 0;
        
        //setting marks for each question
        $score_per_question = (100 / $auth_exam->duration);
        if($answered == $temp_question_ans->answer) { $scores = $score_per_question; } else{ $scores = 0.00; }

        //script to end text.
        if($request->end_test_mark == 'end_test')
        {
            $data = array
            (
              'question_no' => $question_no,
              'picked' => 0,  
              'scores' => $scores,
              'answered' => $answered,  
              'time_left' => $request->time_left, 
              'updated_at' => date('Y-m-d h:i:s')
            );
            \App\TempQuestion::where('question_no', $question_no)->where('registration_no', $auth_exam->registration_no)->where('date', $date)->update($data);

            //computing result
            $scores = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->sum('scores');    $scores = round($scores, 1);
            $total_question = $no_of_questions;
            $answered = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)
            ->where('answered', 'A')->orwhere('answered', 'B')->orwhere('answered', 'C')->orwhere('answered', 'D')->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->count();
            $correct = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('scores', '!=', 0.00)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->count();
            $incorrect = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('scores', 0.00)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->count();
            $un_answered = $total_question - $answered;
            $grade = \App\Grading::where('exam_id', $auth_exam->id)->where('from', '<>', round($scores, 0))->where('to', '<>', round($scores, 0))->first();
            $time_used = $temp_question_ans->time_left - ($auth_exam->duration / 60);  

            //inserting question
            $question = \App\TestResult::insert
            (
            [               
                 'registration_no' => $temp_question_ans->registration_no,
                 'subject_id' => $temp_question_ans->subject_id,  
                 'class_id' => $temp_question_ans->class_id,  
                 'term' => $temp_question_ans->term,  
                 'section_id' => $temp_question_ans->section_id,
                 'scores' => $scores, 
                 'total_question' => $total_question, 
                 'answered' => $answered, 
                 'answered_correct' => $correct, 
                 'answered_incorrect' => $incorrect, 
                 'un_answered' => $un_answered, 
                 'grade' => $grade,
                 'time_used' => $time_used,
                 'date' => $temp_question_ans->date,
            ]);
            \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->delete();


        //return view('exams.instruction')->with('info', 'Test ended, the Test coodinator will get back to you soon');
        }
        //script to mark question as pending and load the next question.
        else if($question_number != '')
        {
            $data = array
            (
              'question_no' => $question_no, 
              'picked' => 1, 
              'scores' => 0.00,
              'answered' => $answered,  
              'time_left' => $request->time_left,
              'updated_at' => date('Y-m-d h:i:s')
            );
            \App\TempQuestion::where('question_no', $question_no)->update($data);
        }

        //script to submit answer and load the next question.
        else
        {    
            $data = array
            (
              'question_no' => $question_no, 
              'picked' => 0, 
              'scores' => $scores,
              'answered' => $answered,  
              'time_left' => $request->time_left,
              'updated_at' => date('Y-m-d h:i:s')
            );
            \App\TempQuestion::where('question_no', $question_no)->update($data);
        }
      
        $question = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('picked', 1)->first();

        return response()->json($question);
    }




    
    //SCRIPT TO GET ALL MARKED QUESTION
    public function getAllMarkedQuestion(Request $request)
    {  
        $auth_exam = session('auth_exam'); 

        $date = date('Y-m-d');         

        //getting all marked for review question
        $marked_questions = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('picked', 1)->orderBy('id', 'asc')->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->get();
        return response()->json($marked_questions);
        // return [];
    }

    
        //SCRIPT TO GET MARKED QUESTION
    public function getMarkedQuestion(Request $request, $id)
    {   
        $auth_exam = session('auth_exam'); 

        $date = date('Y-m-d');         

        //getting all marked for review question
        $mark_question = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('question_no', $id)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->first();
        return view('exams.marked_question_page',compact('mark_question'));
    }
    
    //SCRIPT TO GET MARKED QUESTION COUNT
    public function getAnsweredQuestionCount(Request $request)
    {  
        $auth_exam = session('auth_exam'); 
        $date = date('Y-m-d');         

        //getting answered question Count
        $answered_question_count = \App\TempQuestion::where('answered', 0)->where('picked', 0)->where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->count();
        $answered_question_count = $answered_question_count - 1;
        return response()->json($answered_question_count);
    }
    
    //SCRIPT TO GET PENDING QUESTION
    public function getPendingQuestionCount(Request $request)
    {  
        $auth_exam = session('auth_exam'); 
        $date = date('Y-m-d');         

        //getting pending question Count
        $pq_count = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->count();
        $pending_question_count = ($auth_exam->no_of_questions - $pq_count + 1);
        return response()->json($pending_question_count);
    }
    
    //SCRIPT TO GET ALL MARKED QUESTION
    public function getMarkQuestionCount(Request $request)
    {  
        $auth_exam = session('auth_exam'); 
        $date = date('Y-m-d');         

        //getting all marked question Count
        $marked_question_count = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->where('picked', 1)->where('subject_id', $auth_exam->subject_id)->where('class_id', $auth_exam->class_id)->where('term', $auth_exam->term)->count();
        return response()->json($marked_question_count);
    }



    public function updateLastViewQuestion()
    {
        try
        {   
            $date = date('Y-m-d');
            $last_view_no = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->orderBy('id', 'asc')->get();
            //$last_view_no = ($last_view_no->id - 1 );
        
            $data = array
            (
              'last_viewed' => '1', 'updated_at' => date('Y-m-d h:i:s')
            );
            \App\TempQuestion::where('id', $last_view_no->id)->update($data);
        }
        catch (\Exception $e) 
        {
            return  response()->json(['status'=>'error', 'info'=>'Sorry, Could Not Update Please Try Again. ' .$e->getMessage()]);
        }

    }


    
    public function getPreviousQuestion(Request $request)
    {            
        //getting total questions, first and last question no. 

        $auth_exam = session('$auth_exam'); 
        $date = date('Y-m-d');
        $last_question = \App\TempQuestion::where('registration_no', $auth_exam->registration_no)->where('date', $date)->orderBy('id', 'desc')->where('question_no', 1)->first();
        if(count($last_question) > 0)
        {
            $question_no = $last_question->question_no;
            $question_no++;
            $question = $last_question;
        }
        else { $question_no++; }
                

        return response()->json($question);
    }


    
   
   
    public function AccessExam()
    {
        $subjects = \App\Subject::orderBy('subject_name', 'asc')->get();
        $classes = \App\Classed::orderBy('class_name', 'asc')->get();
        $sessions = \App\Session::orderBy('session_name', 'asc')->get();

        return view('exams.access-exam', compact('subjects', 'classes', 'sessions'));
    }
   
    public function AuthenticateExamCredentials(Request $request)
    {
        $auth_exam = \App\ExamPin::where('registration_no', $request->registration_no)->
                                   where('subject_id', $request->subject_id)->
                                   where('class_id', $request->class_id)->
                                   where('session_id', $request->session_id)->
                                   where('term', $request->term)->
                                   where('pin', $request->pin)->first();

        return view('exams.access-exam', compact('subjects', 'classes', 'sessions'));
    }


}

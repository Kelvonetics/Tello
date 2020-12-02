<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Result as ResultResource;

class ResultController extends Controller
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



    public function index()
    {
        //
        $sessions = \App\Session::orderBy('id', 'asc')->get();
        $classes = \App\Classed::orderBy('id', 'asc')->get();
        $results = '';

        return view('results.results', compact('classes', 'sessions', 'results'));        
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
            case 'promote':
                return $this->PromoteStudent($request);
            break;
            
            case 'get-results':
                return $this->GetResult($request);
            break;
            
            case 'remarks':
                return $this->updateResultRemark($request);
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
    public function show(Request $request, $id)
    {
        //
        switch ($request->type) 
        {
            case 'check-result':
                return $this->CheckStudentResult($request);
            break;


            default:
                # code...
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



    public function promote_students(Request $request)
    {
        $classes = \App\Classed::orderBy('id', 'asc')->get();
        $sessions = \App\Session::orderBy('id', 'asc')->get();

        return view('results.promote-student', compact('classes', 'sessions'));
    }


    public function PromoteStudent(Request $request)
    {
        try
        {  $total_count_students = 0;  $promoted_students = 0;
            //getting all the student for that class
            $students_in_this_class = \App\Student::where('class_id', $request->class_id)->where('session_id', $request->session_id)->get();
            //looping through all the students in that class
            foreach ($students_in_this_class as $student) 
            {
                //GETTING ALL THE SOCRES FOR THAT SESSION (ALL TERMS)
                $overall_results = \App\Result::where('session_id', $request->session_id)->where('registration_no', $student->registration_no)
                                              ->where('promoted', 0)->sum('scores');
                $count_records = \App\Result::where('session_id', $request->session_id)->where('registration_no', $student->registration_no)
                                            ->where('promoted', 0)->count();

                if($count_records > 0)
                {
                    //testing if the overall marks meets the requirement for promotion
                    if(($overall_results / $count_records) >= 36)
                    {
                        //promote this student      if($request->class_id == 6){ $class_id == 7; }  
                        $new_class_id = $request->class_id + 1;  
                        $new_session_id = $request->session_id + 1;    
                        //update student to new class and session          
                        $data = array
                        (
                            'class_id' => $new_class_id, 
                            'session_id' => $new_session_id, 
                            'updated_at' => date('Y-m-d h:i:s')
                        );
                        \App\Student::where('registration_no', $student->registration_no)->update($data);   

                        //Set promotion status to true in resul table         
                        $data = array
                        (
                            'promoted' => 1,  
                            'updated_at' => date('Y-m-d h:i:s')
                        );
                        \App\Result::where('session_id', $request->session_id)->where('registration_no', $student->registration_no)->update($data); 
                        $promoted_students++;             
                    }
                }
                $total_count_students++;
            }
            
            return redirect()->route('promote-student')->with('info', $promoted_students.' of '.$total_count_students.' Students in '.$student->classed->class_name.', Session '.$student->session->session_name.' Promoted Successfully. ');
        }
        catch (\Exception $e) 
        {
            return redirect()->route('promote-student')->with('error', 'Sorry, An Error Occurred Please Try Again. '.$e->getMessage());
        }        
	}


    public function CheckStudentResult(Request $request)
    {
        try
        {
            //getting all the student for that class
            $results = \App\Result::where('registration_no', $request->registration_no)->where('class_id', $request->class_id)
                                  ->where('term', $request->term)->where('session_id', $request->session_id)->get();            
            
            return redirect()->back()->with($results, 'results');
        }
        catch (\Exception $e) 
        {
            return redirect()->back()->with('error', 'Sorry, An Error Occurred Please Try Again. '.$e->getMessage());
        }        
	}


    public function getStudentResults(Request $request)
    {
        // return $request->all();
        $results = \App\Result::where('registration_no', $request->registration_no)->where('class_id', $request->class_id)
                                  ->where('term', $request->term)->where('session_id', $request->session_id)->with(['student', 'classed', 'session', 'subject'])->get();

        return response()->json($results);       
	}


    public function FindResult(Request $request)
    {        
        $classes = \App\Classed::orderBy('id', 'asc')->get();
        $sessions = \App\Session::orderBy('id', 'asc')->get();

        return view('results.check-result', compact('classes', 'sessions'));      
	}

    public function GetResult(Request $request)
    {
        // return $request->all();
        $results = \App\Result::where('registration_no', $request->registration_no)->where('class_id', $request->class_id)
                                  ->where('term', $request->term)->where('session_id', $request->session_id)->get();

        $student = \App\Student::where('registration_no', $request->registration_no)->first(); 

        $one_result = \App\Result::where('registration_no', $request->registration_no)->where('class_id', $request->class_id)
                                  ->where('term', $request->term)->where('session_id', $request->session_id)->first();

        if($one_result) { $result_remark = \App\ResultRemark::where('id', $one_result->id)->first(); } else{ $result_remark = ''; }                        
        

        return view('results.results', compact('results', 'one_result', 'student', 'result_remark'));      
	}

    
    public function updateResultRemark(Request $request)
    {
        try
        {
            if($request->id)
            {
                $data = array
                (
                    'result_id' => $request->result_id,
                    'student_id' => $request->student_id,
                    'overall' => $request->overall,
                    'overall_grade' => $request->overall_grade,
                    'recomendation' => $request->recomendation,
                    'remark' => $request->remark, 
                    'updated_at' => date('Y-m-d h:i:s')
                );
                \App\ResultRemark::where('id', $request->id)->update($data);
                return response()->json(['status'=>'ok', 'info'=>'Student Result Remark Updated Successfully.']);
            }
            else 
            {
                $remarks = \App\ResultRemark::updateOrCreate
                (['id'=> $request->id],
                [               
                    'result_id' => $request->result_id,
                    'student_id' => $request->student_id,
                    'overall' => $request->overall,
                    'overall_grade' => $request->overall_grade,
                    'recomendation' => $request->recomendation,
                    'remark' => $request->remark,
                    'created_by' => \Auth::user()->id,
                ]);           
                return response()->json(['status'=>'ok', 'info'=>'Student Result Remark Added Successfully.']);
            }
        }
        catch (\Exception $e) 
        {
            return response()->json(['error', 'Sorry, An Error Occurred Please Try Again. '.$e->getMessage()]);
        }
               
	}
}

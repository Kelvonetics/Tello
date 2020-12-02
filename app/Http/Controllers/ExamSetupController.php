<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ExamPin as ExamPinResource;

class ExamSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->filled('all'))
        {
            $exam_codes = \App\ExamPin::with(['classed', 'subject', 'session'])->orderBy('id', 'desc')->get();
            return ['data'=>$exam_codes];         
        }
        else
        {
            $exam_codes = \App\ExamPin::with(['classed', 'subject', 'session'])->orderBy('id', 'desc')->paginate(15);
            return ExamPinResource::collection($exam_codes);
        }        
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
        $subject = \App\Subject::findOrFail($request->subject_id);

		$subject_code = substr($subject->subject_name, 0, 3);
        $students = \App\Student::where('class_id', $request->class_id)->where('status_id', 1)->get();
        foreach ($students as $student) 
        {
            $PIN = substr($subject_code, 0, 3).'-'; 
            $PIN = strtoupper($PIN);
            $PIN = $PIN.rand(1000000, 9999999);

            $exam_pin = \App\ExamPin::updateOrCreate
            (['id'=> $request->id],
            [               
                'subject_id' => $request->subject_id,
                'pin' => $PIN,
                'class_id' => $request->class_id,
                'term' => $request->term,
                'session_id' => $request->session_id,
                'registration_no' => $student->registration_no,
                'date' => $request->date,
                'no_of_questions' => $request->no_of_questions,
                'duration' => $request->duration,
                'status_id' => 0,
                'created_by' => 1,
            ]);
        }
        
        $exam_codes = \App\ExamPin::with(['classed', 'subject'])->orderBy('id', 'desc')->paginate(15);
        return ExamPinResource::collection($exam_codes);        
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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


}

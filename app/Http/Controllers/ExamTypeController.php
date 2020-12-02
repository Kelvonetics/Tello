<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ExamType as ExamTypeResource;
class ExamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('all'))
        {
          $examType = \App\ExamType::with('user')->orderBy('id', 'desc')->get();
          return ['data'=>$examType];         
        }
        else
        {
            $examType = \App\ExamType::with('user')->orderBy('id', 'desc')->paginate(15);
            return ExamTypeResource::collection($examType);
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
        $examType = $request->isMethod('put') ? \App\ExamType::findOrFail($request->examtype_id) : new \App\ExamType;
        $no_of_questions = $request->no_of_questions;
        $mark = 100 / $no_of_questions;
        $mark_per_question = round($mark, 2);

        if($request->isMethod('put') == true)
        {
            $examType->id = $request->examtype_id;
            $examType->test_name = $request->test_name;
            $examType->session_id = $request->session_id;
            $examType->class_id = $request->class_id;
            $examType->subject_id = $request->subject_id;
            $examType->no_of_questions = $no_of_questions;
            $examType->mark_per_question = $mark_per_question;
            $examType->duration = $request->duration;
            $examType->user_id = $request->user_id;

            if($examType->save()) 
            {
                return new ExamTypeResource($examType);
            }    
        }
        else
        {
            // $examType->id = $request->examtype_id;
            $examType->test_name = $request->test_name;
            $examType->session_id = $request->session_id;
            $examType->class_id = $request->class_id;
            $examType->subject_id = $request->subject_id;
            $examType->no_of_questions = $no_of_questions;
            $examType->mark_per_question = $mark_per_question;
            $examType->duration = $request->duration;
            $examType->user_id = $request->user_id;

            if($examType->save()) 
            {
                return new ExamTypeResource($examType);
            }
        }
        
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
        $examType = \App\ExamType::findOrFail($id);
        if($examType->delete())
        {
            return new ExamTypeResource($examType);
        } 
    }
}

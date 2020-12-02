<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Question as QuestionResource;

use App\Question;

class QuestionController extends Controller
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
          $questions = \App\Question::with(['classed', 'subject'])->orderBy('id', 'desc')->get();
          return ['data'=>$questions];         
        }
        else
        {
            $questions = \App\Question::with(['classed', 'subject'])->orderBy('id', 'desc')->paginate(15);
            return QuestionResource::collection($questions);
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
        //
        $question = $request->isMethod('put') ? \App\Question::findOrFail($request->question_id) : new \App\Question;
        // dd($request->all()); 
        if($request->isMethod('put') == true)
        {
            $question->id = $request->question_id;
            $question->subject_id = $request->subject_id;
            $question->class_id = $request->class_id;
            $question->term = $request->term;
            $question->section_id = $request->section_id;
            $question->questions = $request->questions;
            $question->group1 = $request->group1;
            $question->group2 = $request->group2;
            $question->group3 = $request->group3;
            $question->group4 = $request->group4;
            $question->option1 = $request->option1;
            $question->option2 = $request->option2;
            $question->option3 = $request->option3;
            $question->option4 = $request->option4;
            $question->answer = $request->answer;
            $question->created_by = 1;

            if($question->save())
            {
                return new QuestionResource($question);
            }
        }
        else
        {
            // $question->id = $request->question_id;
            $question->category_id = $request->category_id;
            $question->subject_id = $request->subject_id;
            $question->class_id = $request->class_id;
            $question->term = $request->term;
            $question->section_id = $request->section_id;
            $question->group1 = $request->group1;
            $question->group2 = $request->group2;
            $question->group3 = $request->group3;
            $question->group4 = $request->group4;
            $question->option1 = $request->option1;
            $question->option2 = $request->option2;
            $question->option3 = $request->option3;
            $question->option4 = $request->option4;
            $question->answer = $request->answer;
            $question->created_by = 1;

            if($question->save())
            {
                return new QuestionResource($question);
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
        $question = \App\Question::findOrFail($id);
        return new QuestionResource($question);
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
        $question = \App\Question::findOrFail($id);
        if($question->delete())
        {
            return new QuestionResource($question);
        }
    }

    function batchExcelCreate(Request $request)
    {
        
        $blob = $request->blob;     
        $delimeter = 'data:application/vnd.ms-excel;base64';
        $blob = explode($delimeter,$blob);

        $blob = base64_decode($blob[1]);
        $blob = explode("\n",$blob);
        $bin = [];
        foreach ($blob as $blb)
        {
           $bin[] = str_getcsv($blb);
        }
        
        unset($bin[count($bin) - 1]);
     
        $cols = $bin[0];
        unset($bin[0]);
        $data = [];
        $refined = [];

        foreach ($bin as $bin_)
        {
          foreach ($cols as $k=>$col)
          {
             $data[$col] = $bin_[$k];
          }
          $refined[] = $data;
          $data = [];   
        }

        foreach ($refined as $toInsert)
        {
            Question::create($toInsert);
        }

        return $refined;

    }

}

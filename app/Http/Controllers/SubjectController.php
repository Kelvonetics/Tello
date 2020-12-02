<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Subject as SubjectResource;

class SubjectController extends Controller
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
          $subjects = \App\Subject::with(['classed', 'session'])->orderBy('subject_name', 'asc')->get();
          return [
              'data'=>$subjects
          ];         
        }
        else
        {
            $subjects = \App\Subject::with(['classed', 'session'])->orderBy('subject_name', 'asc')->paginate(15);
            return SubjectResource::collection($subjects);
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
        $subject = $request->isMethod('put') ? \App\Subject::findOrFail($request->subject_id) : new \App\Subject;
        // return $request->all();
        if($request->isMethod('put') == true)
        {
            $subject->id = $request->subject_id;
            $subject->subject_name = $request->subject_name;
            $subject->subject_type = $request->subject_type;
            $subject->class_id = $request->class_id;
            $subject->session_id = $request->session_id;
            // $subject->status_id = $request->status_id;
            $subject->created_by = 1;

            if($subject->save())
            {
                return new SubjectResource($subject);
            }
        }
        else
        {
            $subject->subject_name = $request->subject_name;
            $subject->subject_type = $request->subject_type;
            $subject->class_id = $request->class_id;
            $subject->session_id = $request->session_id;
            // $subject->status_id = $request->status_id;
            $subject->created_by = 1;

            if($subject->save())
            {
                return new SubjectResource($subject);
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
        $subject = \App\Subject::findOrFail($id);
        return new SubjectResource($subject);
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
        $subject = \App\Subject::findOrFail($id);
        if($subject->delete())
        {
            return new SubjectResource($subject);
        }
    }
}

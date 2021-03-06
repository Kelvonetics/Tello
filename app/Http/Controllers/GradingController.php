<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Grading as GradingResource;

class GradingController extends Controller
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
          $gradings = \App\Grading::with(['exam', 'session'])->orderBy('id', 'desc')->get();
          return [
              'data'=>$gradings
          ];         
        }
        else
        {
            $gradings = \App\Grading::with(['exam', 'session'])->orderBy('id', 'desc')->paginate(15);
            return GradingResource::collection($gradings);
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
        $grading = $request->isMethod('put') ? \App\Grading::findOrFail($request->grading_id) : new \App\Grading;
        
        if($request->isMethod('put') == true)
        {
            $grading->id = $request->grading_id;
            $grading->exam_id = $request->exam_id;
            $grading->session_id = $request->session_id;
            $grading->grade_name = $request->grade_name;
            $grading->from = $request->from;
            $grading->to = $request->to;
            $grading->description = $request->description;
            $grading->created_by = 1;   //Auth::user()->id;

            if($grading->save()) 
            {
                return new GradingResource($grading);
            }
        }
        else
        {
            // $grading->id = $request->grading_id;
            $grading->exam_id = $request->exam_id;
            $grading->session_id = $request->session_id;
            $grading->grade_name = $request->grade_name;
            $grading->from = $request->from;
            $grading->to = $request->to;
            $grading->description = $request->description;
            $grading->created_by = 1;   //Auth::user()->id;

            if($grading->save()) 
            {
                return new GradingResource($grading);
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
        //
        $grading = \App\Grading::findOrFail($id);
        if($grading->delete())
        {
            return new GradingResource($grading);
        }
    }
}

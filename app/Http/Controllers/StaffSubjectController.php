<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\StaffSubject as StaffSubjectResource;

class StaffSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        //
        if ($request->filled('all'))
        {
          $staff_subjects = \App\StaffSubject::where('staff_no', $id)->orderBy('id', 'desc')->get();
          return ['data'=>$staff_subjects];         
        }
        else
        {
            $staff_subjects = \App\StaffSubject::where('staff_no', $id)->orderBy('id', 'desc')->paginate(15);
            return StaffSubjectResource::collection($staff_subjects);
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
        // return $request->all();
        $staff_subject = $request->isMethod('put') ? \App\StaffSubject::findOrFail($request->staff_subject_id) : new \App\StaffSubject;

        $staff_subject->id = $request->staff_subject_id;
        $staff_subject->staff_no = $request->staff_no;
        $staff_subject->subject_id = $request->subject_id;
        $staff_subject->class_id = $request->class_id;
        $staf->session_id = $request->session_id;
        $staff_subject->created_by = 1;


        if($staff_subject->save())
        {
            return new StaffSubjectResource($staff_subject);
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
        $staff_subject = \App\StaffSubject::findOrFail($id);
        return new StaffSubjectResource($staff_subject);
    }


    //get Parent Details by Staff Number
    function showByStaffId($id)
    {
         $staff_subject = \App\StaffSubject::where('staff_no', $id)->first();
         return ['data'=>$staff_subject];
    }


    //get Staff Subjects by Staff Number
    function showSubjectsByStaffId($id)
    {
         $staff_subject = \App\StaffSubject::where('staff_no', $id)->paginate(10);
         return ['data'=>$staff_subject];
    }


    function showDetailsByStaffId($id)
    {
         $staff_detail = \App\Staff::where('staff_no', $id)->first();
         return ['data'=>$staff_detail];
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
    public function update(Request $request, \App\StaffSubject $staff_subject)
    {
        //
        //$staff_subject = $request->isMethod('put') ? \App\Access::findOrFail($request->access_id) : new \App\Access;

        // $staff_subject->id = $request->staff_subject_id;
        $staff_subject->staff_no = $request->staff_no;
        $staff_subject->subject_id = $request->subject_id;
        $staff_subject->class_id = $request->class_id;
        $staff_subject->created_by = 1;

        if($staff_subject->save())
        {
            return new StaffSubjectResource($staff_subject);
        }
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
        $staff_subject = \App\StaffSubject::findOrFail($id);
        if($staff_subject->delete())
        {
            return new StaffSubjectResource($staff_subject);
        } 
    }
}

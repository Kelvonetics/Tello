<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\StaffQualification as StaffQualificationResource;

class StaffQualificationController extends Controller
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
          $staff_qualifications = \App\StaffQualification::where('staff_no', $id)->orderBy('id', 'desc')->get();
          return ['data'=>$staff_qualifications];         
        }
        else
        {
            $staff_qualifications = \App\StaffQualification::where('staff_no', $id)->orderBy('id', 'desc')->paginate(15);
            return StaffQualificationResource::collection($staff_qualifications);
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
        $staff_qualification = $request->isMethod('put') ? \App\StaffQualification::findOrFail($request->staff_qualification_id) : new \App\StaffQualification;

        $staff_qualification->id = $request->staff_qualification_id;
        $staff_qualification->staff_no = $request->staff_no;
        $staff_qualification->instituite = $request->instituite;
        $staff_qualification->course = $request->course;
        $staff_qualification->grade = $request->grade;
        $staff_qualification->start_date = $request->start_date;
        $staff_qualification->end_date = $request->end_date;
        $staff_qualification->certificate = $request->certificate;
        $staff_qualification->status_id = $request->status_id;
        $staff_qualification->created_by = 1;


        if($staff_qualification->save())
        {
            return new StaffQualificationResource($staff_qualification);
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
        $staff_qualification = \App\StaffQualification::findOrFail($id);
        return new StaffQualificationResource($staff_qualification);
    }


    //get Parent Details by Staff Number
    function showByStaffId($id)
    {
         $staff_qualification = \App\StaffQualification::where('staff_no', $id)->first();
         return ['data'=>$staff_qualification];
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

    public function update(Request $request, \App\StaffQualification $staff_qualification)
    {
        //
        $staff_qualification->staff_no = $request->staff_no;
        $staff_qualification->instituite = $request->instituite;
        $staff_qualification->course = $request->course;
        $staff_qualification->grade = $request->grade;
        $staff_qualification->start_date = $request->start_date;
        $staff_qualification->end_date = $request->end_date;
        $staff_qualification->certificate = $request->certificate;
        $staff_qualification->status_id = $request->status_id;
        $staff_qualification->created_by = 1;

        if($staff_qualification->save())
        {
            return new StaffQualificationResource($staff_qualification);
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
        $staff_qualification = \App\StaffQualification::findOrFail($id);
        if($staff_qualification->delete())
        {
            return new StaffQualificationResource($staff_qualification);
        } 
    }
}

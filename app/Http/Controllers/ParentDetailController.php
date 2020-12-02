<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ParentDetail as ParentDetailResource;

class ParentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $parent_details = \App\ParentDetail::orderBy('id', 'desc')->paginate(10);
        return ParentDetailResource::collection($parent_details);
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
        $parent_detail = $request->isMethod('put') ? \App\ParentDetail::findOrFail($request->parent_detail_id) : new \App\ParentDetail;

        $parent_detail->id = $request->parent_detail_id;
        $parent_detail->registration_no = $request->registration_no;
        $parent_detail->title = $request->title;
        $parent_detail->firstname = $request->firstname;
        $parent_detail->lastname = $request->lastname;
        $parent_detail->email = $request->email;
        $parent_detail->phone = $request->phone;
        $parent_detail->relationship = $request->relationship;
        $parent_detail->created_by = 1;


        if($parent_detail->save())
        {
            return new ParentDetailResource($parent_detail);
        }
    }


    public function update(Request $request,\App\ParentDetail $parent_detail)
    {
        //
       // $parent_detail = $request->isMethod('put') ? \App\Access::findOrFail($request->access_id) : new \App\Access;

        // $parent_detail->id = $request->parent_detail_id;
        $parent_detail->registration_no = $request->registration_no;
        $parent_detail->title = $request->title;
        $parent_detail->firstname = $request->firstname;
        $parent_detail->lastname = $request->lastname;
        $parent_detail->email = $request->email;
        $parent_detail->phone = $request->phone;
        $parent_detail->relationship = $request->relationship;
        $parent_detail->created_by = 1;

        if($parent_detail->save())
        {
            return new ParentDetailResource($parent_detail);
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
        $parent_detail = \App\ParentDetail::findOrFail($id);
        return new ParentDetailResource($parent_detail);
    }

    //get Parent Details by Student Number
    function showByStudentId($id)
    {
         $parent_detail = \App\ParentDetail::where('registration_no', $id)->first();
         return ['data'=>$parent_detail];
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $parent_detail = \App\ParentDetail::findOrFail($id);
        if($parent_detail->delete())
        {
            return new ParentDetailResource($parent_detail);
        } 
    }
}

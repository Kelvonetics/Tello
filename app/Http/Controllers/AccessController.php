<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Access as AccessResource;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $accesses = \App\Access::orderBy('id', 'desc')->paginate(10);
        return AccessResource::collection($accesses);
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
        $access = $request->isMethod('put') ? \App\Access::findOrFail($request->access_id) : new \App\Access;

        $access->id = $request->access_id;
        $access->exam_id = $request->exam_id;
        $access->who_can_access = $request->who_can_access;
        $access->exam_date = date('Y-m-d', strtotime($request->exam_date));
        $access->exam_code = $request->exam_code;
        $access->notify_who = $request->notify_who;
        $access->when_to_notify = $request->when_to_notify;
        $access->created_by = 1;


        if($access->save())
        {
            return new AccessResource($access);
        }
    }


    public function update(Request $request,\App\Access $access)
    {
        //
       // $access = $request->isMethod('put') ? \App\Access::findOrFail($request->access_id) : new \App\Access;

        // $access->id = $request->access_id;
        $access->exam_id = $request->exam_id;
        $access->who_can_access = $request->who_can_access;
        $access->exam_date = date('Y-m-d', strtotime($request->exam_date));
        $access->exam_code = $request->exam_code;
        $access->notify_who = $request->notify_who;
        $access->when_to_notify = $request->when_to_notify;
        $access->created_by = 1;


        if($access->save())
        {
            return new AccessResource($access);
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
        $access = \App\Access::findOrFail($id);
        return new AccessResource($access);
    }

    function showByExamId($id)
    {
         $access = \App\Access::where('exam_id',$id)->first();
         return ['data '=> $access];
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
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $access = \App\Access::findOrFail($id);
        if($access->delete())
        {
            return new AccessResource($access);
        } 
    }
}

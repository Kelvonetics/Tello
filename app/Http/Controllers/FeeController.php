<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Fee as FeeResource;

class FeeController extends Controller
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
          $fees = \App\Fee::with(['classed', 'session'])->orderBy('id', 'desc')->get();
          return ['data'=>$fees];         
        }
        else
        {
            $fees = \App\Fee::with(['classed', 'session'])->orderBy('id', 'desc')->paginate(15);
            return FeeResource::collection($fees);
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
        // return $request->all();
        $fee = $request->isMethod('put') ? \App\Fee::findOrFail($request->fee_id) : new \App\Fee;

        if($request->isMethod('put') == true)
        {
            $fee->id = $request->fee_id;
            $fee->fee_name = $request->fee_name;
            $fee->fee_type_id = $request->fee_type_id;
            $fee->currency = $request->currency;
            $fee->amount = $request->amount;
            $fee->class_id = $request->class_id;
            $fee->session_id = $request->session_id;
            $fee->frequency = $request->frequency;
            $fee->status_id = 0;
            $fee->created_by = 1;

            if($fee->save())
            {
                return new FeeResource($fee);
            }
        }
        else 
        {
            // $fee->id = $request->fee_id;
            $fee->fee_name = $request->fee_name;
            $fee->fee_type_id = $request->fee_type_id;
            $fee->currency = $request->currency;
            $fee->amount = $request->amount;
            $fee->class_id = $request->class_id;
            $fee->session_id = $request->session_id;
            $fee->frequency = $request->frequency;
            $fee->status_id = 0;
            $fee->created_by = 1;

            if($fee->save())
            {
                return new FeeResource($fee);
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
        $fee = \App\Fee::findOrFail($id);
        return new Fee($fee);
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
        $fee = \App\Fee::findOrFail($id);
        if($fee->delete())
        {
            return new FeeResource($fee);
        }
    }
}

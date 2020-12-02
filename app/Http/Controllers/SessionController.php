<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Session as SessionResource;

class SessionController extends Controller
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
          $sessions = \App\Session::orderBy('id', 'desc')->get();
          return ['data'=>$sessions];         
        }
        else
        {
            $sessions = \App\Session::orderBy('id', 'desc')->paginate(15);
            return SessionResource::collection($sessions);
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
        $session = $request->isMethod('put') ? \App\Session::findOrFail($request->session_id) : new \App\Session;
        
        if($request->isMethod('put') == true)
        {
            $session->id = $request->session_id;
            $session->session_name = $request->session_name;
            $session->start_date = $request->start_date;
            $session->end_date = $request->end_date;
            // $session->status_id = $request->status_id;
            $session->created_by = 1;

            if($session->save())
            {
                return new SessionResource($session);
            }
        }
        else
        {
            // $session->id = $request->session_id;
            $session->session_name = $request->session_name;
            $session->start_date = $request->start_date;
            $session->end_date = $request->end_date;
            // $session->status_id = $request->status_id;
            $session->created_by = 1;

            if($session->save())
            {
                return new SessionResource($session);
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
        $session = \App\Session::findOrFail($id);
        return new SessionResource($session);
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
        $session = \App\Session::findOrFail($id);
        if($session->delete())
        {
            return new SessionResource($session);
        }
    }




    //get Session Details by ID
    function sessionById($id)
    {
         $session_detail = \App\Session::where('id', $id)->first();
         // return $session_detail;
         return ['data'=>$session_detail];
    }
}

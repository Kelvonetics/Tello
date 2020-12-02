<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Classed as ClassedResource;

class ClassController extends Controller
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
          $classes = \App\Classed::with(['session'])->orderBy('class_name', 'asc')->get();
          return [
              'data'=>$classes
          ];         
        }
        else
        {
            $classes = \App\Classed::with(['session'])->orderBy('class_name', 'asc')->paginate(15);
            return ClassedResource::collection($classes);
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
        $classe = $request->isMethod('put') ? \App\Classed::findOrFail($request->classe_id) : new \App\Classed;
        if($request->isMethod('put') == true)
        {
            $classe->id = $request->classe_id;
            $classe->class_name = $request->class_name;
            $classe->class_type = $request->class_type;
            $classe->session_id = $request->session_id;
            $classe->status_id = 1;
            $classe->created_by = 1;

            if($classe->save())
            {
                return new ClassedResource($classe);
            }
        }
        else
        {
            // $classe->id = $request->classe_id;
            $classe->class_name = $request->class_name;
            $classe->class_type = $request->class_type;
            $classe->session_id = $request->session_id;
            $classe->status_id = 1;
            $classe->created_by = 1;

            if($classe->save())
            {
                return new ClassedResource($classe);
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
        $classe = \App\Classed::findOrFail($id);
        return new ClassedResource($classe);
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
        $classe = \App\Classed::findOrFail($id);
        if($classe->delete())
        {
            return new ClassedResource($classe);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TimeTable as TimeTableResource;

class TimeTableController extends Controller
{
   private $delimiter = 'data:application/vnd.ms-excel;base64,';
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
          $time_tables = \App\TimeTable::with(['classed', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'session'])->orderBy('id', 'desc')->get();
          return ['data'=>$time_tables];         
        }
        else
        {
            $time_tables = \App\TimeTable::with(['classed', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'session'])->orderBy('id', 'desc')->paginate(15);
            return TimeTableResource::collection($time_tables);
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
        $time_table = $request->isMethod('put') ? \App\TimeTable::findOrFail($request->time_table_id) : new \App\TimeTable;

        if($request->isMethod('put') == true)
        {
            $time_table->id = $request->time_table_id;
            $time_table->session_id = $request->session_id;
            $time_table->class_id = $request->class_id;
            $time_table->term_id = $request->term_id;
            $time_table->week = $request->week;
            $time_table->time_slot = $request->time_slot;
            $time_table->monday = $request->monday;
            $time_table->tuesday = $request->tuesday;
            $time_table->wednesday = $request->wednesday;
            $time_table->thursday = $request->thursday;
            $time_table->friday = $request->friday;
            $time_table->status_id = 1;
            $time_table->created_by = 1;

            if($time_table->save())
            {
                return new TimeTableResource($time_table);
            }
        }
        else
        {
            $time_table->session_id = $request->session_id;
            $time_table->class_id = $request->class_id;
            $time_table->term_id = $request->term_id;
            $time_table->week = $request->week;
            $time_table->time_slot = $request->time_slot;
            $time_table->monday = $request->monday;
            $time_table->tuesday = $request->tuesday;
            $time_table->wednesday = $request->wednesday;
            $time_table->thursday = $request->thursday;
            $time_table->friday = $request->friday;
            $time_table->status_id = 1;
            $time_table->created_by = 1;

            if($time_table->save())
            {
                return new TimeTableResource($time_table);
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
        $time_table = \App\TimeTable::findOrFail($id);
        return new TimeTableResource($time_table);
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
        $time_table = \App\TimeTable::findOrFail($id);
        if($time_table->delete())
        {
            return new TimeTableResource($time_table);
        }
    }






    function timeTabletUpload(Request $request)
    {
        // dd($request->blob);
        $blob = $request->blob;     

        $refined = $this->decodeExcelRawData($blob);

        foreach ($refined as $toInsert)
        {
            // dd($toInsert);
            $data = array(
            'session_id' => $toInsert["session_id"],
            'class_id' => $toInsert["class_id"],
            'term_id' => $toInsert["term_id"],
            'week' => $toInsert["week"],
            'time_slot' => $toInsert["time_slot"],            
            'monday' => $toInsert["monday"],
            'tuesday' => $toInsert["tuesday"],
            'wednesday' => $toInsert["wednesday"],
            'thursday' => $toInsert["thursday"],
            'friday' => $toInsert["friday"],
            'status_id' => 1,
            'created_by' => 1
            );
            \App\TimeTable::create($data);
        }

        // dd($post);

        return $refined;

    }



    private function decodeExcelRawData($raw)
    {
        $r = explode($this->delimiter,$raw);
        // dd($r);
        // echo count($r);
        // dd($r);
        if (count($r) > 1 && empty($r[0]) )
        {
            $r = $r[1];
            $binary = base64_decode($r);
            $bin = [];
            $binary = explode("\n",$binary);
            foreach ($binary as $bin_)
            {
                $bin[] = str_getcsv($bin_); 
            }
            unset($bin[count($bin) - 1]);
             
            $columns = $bin[0];
            unset($bin[0]);
            $data = [];
            $refined = [];
             
            foreach ($bin as $bin_)
            {
                foreach ($columns as $k=>$col)
                {
                    $data[$col] = $bin_[$k];
                } 
                $refined[] = $data;
                $data = []; //reset data here. 
            }
            return $refined;
        }
        else
        {
        return [];
        }
     
    } 

}

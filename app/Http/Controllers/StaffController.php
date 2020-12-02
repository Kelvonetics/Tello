<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Staff as StaffResource;

class StaffController extends Controller
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
          $staffs = \App\Staff::with(['designation', 'state', 'session'])->orderBy('id', 'desc')->get();
          return ['data'=>$staffs];         
        }
        else
        {
            $staffs = \App\Staff::with(['designation', 'state', 'session'])->orderBy('id', 'desc')->paginate(15);
            return StaffResource::collection($staffs);
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
        $staff = $request->isMethod('put') ? \App\Staff::findOrFail($request->staff_id) : new \App\Staff;

        //\log::info($request->all());
        if($request->isMethod('put') == true)
        {   
            //remove Extra Parts
            $photo = $request->photo;
            if($photo != '')
            { 
                $exploded = explode(",",$photo);
                //Extensions
                if(str_contains($exploded[0], 'png')) {   $extension = 'png';  }else if(str_contains($exploded[0], 'gif')) {   $extension = 'gif';   }else{   $extension = 'jpg';  }
                //Decoding
                $decoded = base64_decode($exploded[1]);
                $fileName = str_random() . "." .$extension;

                $fileName = str_random().'.'.$extension;
                $path = public_path().'/assets/images/uploads/'.$fileName;
                file_put_contents($path, $decoded);
            } 
            else{ $fileName = ''; }

            $staff->id = $request->staff_id;
            $staff->staff_no = $staff_no;
            $staff->firstname = $request->firstname;
            $staff->midname = $request->midname;
            $staff->lastname = $request->lastname;
            $staff->email = $request->email;
            $staff->password = bcrypt($request->password);
            $staff->phone = $request->phone;
            $staff->address = $request->address;
            $staff->gender = $request->gender;
            $staff->doj = $request->doj;
            $staff->marital_status = $request->marital_status;
            $staff->designation_id = $request->designation_id;
            $staff->state_id = $request->state_id;
            $staff->nationality = $request->nationality;
            $staff->photo = $fileName;
            $staff->session_id = $request->session_id;
            $staff->status_id = $request->status_id;
            $staff->created_by = 1;

            if($staff->save())
            {
                return new staffResource($staff);
            }
        }
        else
        {
            $staff_no = self::getStaffNumber();
            //remove Extra Parts
            $photo = $request->photo;
            if($photo != '')
            { 
                $exploded = explode(",",$photo);
                //Extensions
                if(str_contains($exploded[0], 'png')) {   $extension = 'png';  }else if(str_contains($exploded[0], 'gif')) {   $extension = 'gif';   }else{   $extension = 'jpg';  }
                //Decoding
                $decoded = base64_decode($exploded[1]);
                $fileName = str_random() . "." .$extension;

                $fileName = str_random().'.'.$extension;
                $path = public_path().'/assets/images/uploads/'.$fileName;
                file_put_contents($path, $decoded);
            } 
            else{ $fileName = 'avatar.png'; }

            $staff->staff_no = $staff_no;
            $staff->firstname = $request->firstname;
            $staff->midname = $request->midname;
            $staff->lastname = $request->lastname;
            $staff->email = $request->email;
            $staff->password = bcrypt($request->password);
            $staff->phone = $request->phone;
            $staff->address = $request->address;
            $staff->gender = $request->gender;
            $staff->doj = $request->doj;
            $staff->marital_status = $request->marital_status;
            $staff->designation_id = $request->designation_id;
            $staff->state_id = $request->state_id;
            $staff->nationality = $request->nationality;
            $staff->photo = $fileName;
            $staff->session_id = $request->session_id;
            $staff->status_id = $request->status_id;
            $staff->created_by = 1;

            if($staff->save())
            {
                return new staffResource($staff);
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
        $staff = \App\Staff::findOrFail($id);
        return new StaffResource($staff);
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
        $staff = \App\Staff::findOrFail($id);
        if($staff->delete())
        {
            return new StaffResource($staff);
        }
    }




    function staffUpload(Request $request)
    {
        // dd($request->blob);
        $blob = $request->blob;     

        $refined = $this->decodeExcelRawData($blob);

        foreach ($refined as $toInsert)
        {
            // dd($toInsert);
            $staff_no = self::getStaffNumber();
            $data = array(
            'staff_no' => $staff_no,
            'firstname' => $toInsert["firstname"],
            'midname' => $toInsert["midname"],
            'lastname' => $toInsert["lastname"],
            'email' => $toInsert["email"],            
            'password' => bcrypt($toInsert["password"]),
            'phone' => $toInsert["phone"],
            'address' => $toInsert["address"],
            'gender' => $toInsert["gender"],
            'doj' => $toInsert["doj"],
            'marital_status' => $toInsert["marital_status"],
            'designation_id' => $toInsert["designation_id"],
            'state_id' => $toInsert["state_id"],
            'nationality' => $toInsert["nationality"],
            'photo' => 'user.png',
            'session_id' => $toInsert["session_id"],
            'status_id' => 1,
            'created_by' => 1
            );
            \App\Staff::create($data);
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



    //generate random alphanumerics value
    function getStaffNumber()
    {
        $tot = \App\Staff::orderBy('id', 'desc')->first();
        $total = $tot->id;
        $total += 1;
        $staff_no = '';
        $staff_no .= 'STAFF-';
        $staff_no .= date('Y'); 
        if($total < 10) {           $staff_no .= '-000';    }
        else if($total >= 10){      $staff_no .= '-00';     }
        else if($total >= 100){     $staff_no .= '-0';      }
        else if($total >= 1000){    $staff_no .= '-';       }
        $staff_no .= $total;

        return $staff_no;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\ParentDetail as ParentDetailResource;
use Excel;

class StudentController extends Controller
{

   private $delimiter = 'data:application/vnd.ms-excel;base64,';
                       //data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,

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
          $students = \App\Student::with(['classed', 'session', 'state'])->orderBy('id', 'desc')->get();
          return ['data'=>$students];         
        }
        else
        {
            $students = \App\Student::with(['classed', 'session', 'state'])->orderBy('id', 'desc')->paginate(15);
            return StudentResource::collection($students);
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
        $student = $request->isMethod('put') ? \App\Student::findOrFail($request->student_id) : new \App\Student;
           
        //return $request->all();
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

            $student->id = $request->student_id;   
            $student->firstname = $request->firstname;
            $student->midname = $request->midname;
            $student->lastname = $request->lastname;
            $student->email = $request->email;
            $student->password = bcrypt($request->password);
            $student->class_id = $request->class_id;
            $student->phone = $request->phone;
            $student->address = $request->address;
            $student->gender = $request->gender;
            $student->dob = $request->dob;
            $student->state_id = $request->state_id;
            $student->nationality = $request->nationality;
            $student->category_id = $request->category_id;
            $student->session_id = $request->session_id;
            $student->photo = $path;
            $student->session_id = $request->session_id;
            $student->status_id = 1;
            $student->created_by = 1;

            if($student->save())
            {
                return new StudentResource($student);
            }
        }
        else
        {
            $registration_no = self::getRegNumber();
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

            $student->registration_no = $registration_no;
            $student->firstname = $request->firstname;
            $student->midname = $request->midname;
            $student->lastname = $request->lastname;
            $student->email = $request->email;
            $student->password = bcrypt($request->password);
            $student->class_id = $request->class_id;
            $student->phone = $request->phone;
            $student->address = $request->address;
            $student->gender = $request->gender;
            $student->dob = $request->dob;
            $student->state_id = $request->state_id;
            $student->nationality = $request->nationality;
            $student->category_id = $request->category_id;
            $student->session_id = $request->session_id;
            $student->photo = $path;
            $student->session_id = $request->session_id;
            $student->status_id = 1;
            $student->created_by = 1;

            if($student->save())
            {
                return new StudentResource($student);
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
        $student = \App\Student::findOrFail($id);
        return new StudentResource($student);
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
        $student = \App\Student::findOrFail($id);
        if($student->delete())
        {
            return new StudentResource($student);
        }
    }




    function studentUpload(Request $request)
    {
        // dd($request->blob);
        $blob = $request->blob;     

        $refined = $this->decodeExcelRawData($blob);

        foreach ($refined as $toInsert)
        {
            // dd($toInsert);
            $registration_no = self::getRegNumber();
            $data = array(
            'registration_no' => $registration_no,
            'firstname' => $toInsert["firstname"],
            'midname' => $toInsert["midname"],
            'lastname' => $toInsert["lastname"],
            'email' => $toInsert["email"],            
            'password' => bcrypt($toInsert["password"]),
            'class_id' => $toInsert["class_id"],
            'phone' => $toInsert["phone"],
            'address' => $toInsert["address"],
            'gender' => $toInsert["gender"],
            'dob' => $toInsert["dob"],
            'state_id' => $toInsert["state_id"],
            'nationality' => $toInsert["nationality"],
            'category_id' => $toInsert["category_id"],
            'session_id' => $toInsert["session_id"],
            'photo' => 'user.png',
            'session_id' => $toInsert["session_id"],
            'status_id' => 1,
            'created_by' => 1
            );
            \App\Student::create($data);
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
    function getRegNumber()
    {
        $tot = \App\Student::orderBy('id', 'desc')->first();
        $total = $tot->id;
        $total += 1;
        $reg_no = '';
        $reg_no .= 'STUD-';
        $reg_no .= date('Y'); 
        if($total < 10) {           $reg_no .= '-000';    }
        else if($total >= 10){      $reg_no .= '-00';     }
        else if($total >= 100){     $reg_no .= '-0';      }
        else if($total >= 1000){    $reg_no .= '-';       }
        $reg_no .= $total;

        return $reg_no;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ExamUser as ExamUserResource;

class ExamUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $exam_users = \App\ExamUser::orderBy('id', 'desc')->paginate(5);
        return ExamUserResource::collection($exam_users);
    }

    public function getUsersByExamId($id){
        // return [];
        $query = \App\ExamUser::where('exam_id',$id)->paginate(10);
        return ExamUserResource::collection($query);
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
        //GETTING RANDOM EXAM CODE
        $code = self::exam_code();
        $exam_user = $request->isMethod('put') ? \App\ExamUser::findOrFail($request->exam_user_id) : new \App\ExamUser;
        
        if($request->isMethod('put') == true)
        {
            $exam_user->id = $request->exam_user_id;
            $exam_user->exam_id = $request->exam_id;
            $exam_user->firstname = $request->firstname;
            $exam_user->lastname = $request->lastname;
            $exam_user->email = $request->email;
            $exam_user->password = bcrypt($request->password);
            $exam_user->phone = $request->phone;
            $exam_user->address = $request->address;
            $exam_user->dob = $request->dob;
            $exam_user->gender = $request->gender;
            $exam_user->marital_status = $request->marital_status;
            $exam_user->state_id = $request->state_id;
            $exam_user->nationality = $request->nationality;
            $exam_user->photo = 'avatar.png';
            $exam_user->code = $code;
            $exam_user->created_by = 1;

            if($exam_user->save())
            {
                return new ExamUserResource($exam_user);
            }
        }
        else
        {
            // $exam_user->id = $request->exam_user_id;
            $exam_user->exam_id = $request->exam_id;
            $exam_user->firstname = $request->firstname;
            $exam_user->lastname = $request->lastname;
            $exam_user->email = $request->email;
            $exam_user->password = bcrypt($request->password);
            $exam_user->phone = $request->phone;
            $exam_user->address = $request->address;
            $exam_user->dob = $request->dob;
            $exam_user->gender = $request->gender;
            $exam_user->marital_status = $request->marital_status;
            $exam_user->state_id = $request->state_id;
            $exam_user->nationality = $request->nationality;
            $exam_user->photo = 'avatar.png';
            $exam_user->code = $code;
            $exam_user->created_by = 1;

            if($exam_user->save())
            {
                return new ExamUserResource($exam_user);
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
        $exam_user = \App\ExamUser::findOrFail($id);
        return new ExamUserResource($exam_user);
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
        $exam_user = \App\ExamUser::findOrFail($id);
        if($exam_user->delete())
        {
            return new ExamUserResource($exam_user);
        } 
    }




    function userExamUpload(Request $request)
    {
        
        $blob = $request->blob;     
        $delimeter = 'data:application/vnd.ms-excel;base64';
        $blob = explode($delimeter, $blob);

        $blob = base64_decode($blob[1]);
        $blob = trim($blob);


        $bom = pack("CCC", 0xef, 0xbb, 0xbf);
        if (0 === strncmp($blob, $bom, 3)) 
        {
            // echo "BOM detected - file is UTF-8\n";
            $blob = substr($blob, 3);
            // echo $blob;
        }


        $blob = explode("\n", $blob);
        $bin = [];
        foreach ($blob as $blb)
        {
           $bin[] = str_getcsv(trim($blb));
        }
        
        // unset($bin[count($bin) - 1]);
     
        $cols = $bin[0];
        unset($bin[0]);
        $data = [];
        $refined = [];

        foreach ($bin as $bin_)
        {
          foreach ($cols as $k => $col)
          {
             $data[trim($col)] = trim($bin_[$k]);
          }
          $refined[] = $data;
          $data = [];   
        }

        // dd($refined);

        foreach ($refined as $toInsert)
        {
            //dd($toInsert);
            $code = self::exam_code();
            $data = array(
              "exam_id" => $request->exam_id,
              "firstname" => $toInsert['firstname'],
              "lastname" => $toInsert['lastname'],
              "email" => $toInsert['email'],
              "password" => $toInsert['password'],
              "phone" => $toInsert['phone'],
              "address" => $toInsert['address'],
              "dob" => $toInsert['dob'],
              "gender" => $toInsert['gender'],
              "marital_status" => $toInsert['marital_status'],
              "state_id" => $toInsert['state_id'],
              "nationality" => $toInsert['nationality'],
              "photo" => $toInsert['photo'],
              "code" => $code,
              "created_by" => "1"
        );
            \App\ExamUser::create($data);
        }

        // dd($post);

        return $refined;

    }

    //generate random alphanumerics value
    function exam_code()
    {
        $letters = array_merge(range('a','z'),range('A','Z'));
 
        $rand = $letters[rand(0, 51)];
        $rand1 = $letters[rand(0, 51)];

        $code = 'CBT-';
        $code .= $rand;
        $code .= mt_rand(11, 99);            
        $code .= $rand1;
        $code .= mt_rand(11, 99);

        return $code;
    }

}

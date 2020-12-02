@extends('layouts.app-test')


<style type="text/css">
    *
    {
    	font-size: 13px;
    }

    .reg-details
    {
        text-align: center; margin-top: 5px;
    }
    .result-img
    {
        width:70%; height:80%; border-radius: 10px; margin: 0px auto;
    }

    .res-font
    {
        font-size: 15px;
    }
</style>

@section('content')

<!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content" style="width: 70%; margin: auto">

      <div class="row">
          <div class="col-xl-2 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px"> Results 

              <!-- <button class="btn btn-sm pull-right" style="border:thin line black; background:#202020; color:#fff;" @click="exportPDF"><i class="fa fa-file-excel-o"> </i>  </button> -->
            </h2> 
          </div>
          <div class="col-xl-3 col-md-3 col-sm-3" style="text-align: left; padding-bottom: 0px"> 
              <div class="form-group">
                  <div class="input-search">
                    <button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
                    <input type="text" class="form-control pull-right" placeholder="Search" v-model="search" />
                  </div>
              </div>
          </div>              
          <div class="col-xl-7 col-md-2 col-sm-3" style="text-align: right; padding-bottom: 0px">         

              <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#resultModal" data-toggle="modal" 
            data-original-title="Click To Check Student Result">    <i class="icon fa-graduation-cap" aria-hidden="true"> </i> Check Result
              </button>              
          </div>
      </div>

    

      <div class="panel" style="margin-top: -10; padding: 2px 5px;" id="result-card">
        <div class="row page-content">
          <div class="col-12" style="border-radius:6px">

              

            <div class="table-responsive">
                    <div class="col-12" style="border-right: thin dotted #ddd">
                        <table class="table table-sm">
                            <tbody id="">                             
                                <tr>
                                    <td class="res-font" style="width: 10%">NAMES </td>
                                    <td class="res-font" style="width: 25%">@if($student){{$student->firstname}} {{$student->lastname}}@endif</td>
                                    <td class="res-font" style="width: 10%">CLASS </td>
                                    <td class="res-font" style="width: 25%">@if($one_result){{$one_result->classed->class_name}}@endif</td>
                                    <td class="res-font" style="width: 10%"> </td>
                                    <td style="width: 20%" rowspan="3">
                                        <img class="result-img" src="@if($student){{ asset($student->photo) }}@endif" title="Student Pic" style="max-height:120px; min-height:100px; max-width:95%; min-width:95%; margin-bottom: 10px; margin-top:-4px">
                                        <div style="text-align:center"> @if($one_result){{$one_result->registration_no}}@endif </div>
                                    </td> 
                                </tr>
                                <tr>
                                    <td class="res-font">TERM </td>
                                    <td class="res-font">@if($one_result){{$one_result->term}}@endif</td>                         
                                    <td class="res-font">SESSION </td>
                                    <td class="res-font">@if($one_result){{$one_result->session->session_name}}@endif</td>                             
                                </tr>
                                <tr>
                                    <td class="res-font">GENDER </td>
                                    <td class="res-font">@if($student){{$student->gender}}@endif</td> 
                                    <td class="res-font">CATEGORY </td>
                                    <td class="res-font">
                                        @if($student)
                                            @if($student->category_id == 1) Day Student  @else Boarding Student Student @endif 
                                        @endif
                                    </td>                             
                                </tr>  
                            </tbody>
                        </table>
                    </div>
                
                
                

                <table class="table table-striped table-sm" style="background:palegoldenrod;">
                    <thead class="thead-dark">
                    <tr>
                        <th style="width: 60%">Subjects</th>
                        <th style="width: 20%">Marks</th>
                        <th style="width: 20%">Grade</th>
                    </tr>
                    </thead>
                    <tbody id="second-term"> @php $overall = 0; @endphp
                        @forelse($results as $result)                              
                            <tr>
                                <td>{{$result->subject->subject_name}}</td>
                                <td>{{$result->scores}}</td>
                                <td>{{$result->grade}}</td>                                                               
                            </tr>   @php $overall += $result->scores;   @endphp
                        @empty
                            No Result Found!
                        @endforelse 
                    </tbody>
                </table>
            </div>


            

        </div>
      </div>
    </div>




             

           
        </div>
    </div>




    
    


@endsection



@section('script')



<script>

    $("#remarkForm").on('submit',function(e)
    { 
        e.preventDefault();

        $.ajax(
        {
            url:'{{url('/updateResultRemark')}}',
            type:'post',
            data:{
            id:$('#id').val(),
            result_id:$('#result_id').val(),
            student_id:$('#student_id').val(),
            overall:$('#overall').val(),
            overall_grade:$('#overall_grade').val(),
            recomendation:$('#recomendation').val(),
            remark:$('#remark').val(),
            _token:'{{csrf_token()}}'
            },
            success:function(data)
            { 
                //$('#saveBtn').val(),     //disable buttom                  
                if(data.status=='ok')
                {
                    toastr.success(data.info, {timeOut:10000});
                    return;
                }
            
                return toastr.error(data.info, {timeOut:10000});
            }
        });
    });

</script>


  @if(Session::has('info'))
      <script>
          $(function() 
          {
              toastr.success('{{session('info')}}', {timeOut:100000});
          });
      </script>
  @elseif(Session::has('error'))
      <script>
          $(function() 
          {
              toastr.error('{{session('error')}}', {timeOut:100000});
          });
      </script>
  @endif

@endsection
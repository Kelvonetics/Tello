@extends('layouts.app-test')


<style type="text/css">
    *
    {
    	font-size: 13px;
    }
</style>

@section('content')

<!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

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

  

           
        </div>
    </div>




    
    <!-- Modal -->
    <form id="" action="{{url('results')}}" method="POST">
        @csrf 
        <input type="hidden" class="form-control" name="type" id="" value="get-results"> 
        <div class="modal fade modal-just-me" id="resultModal">
            <div class="modal-dialog">
                <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">X</span>  </button>
            <h4 class="modal-title">Enter Student Details</h4>
            </div>

                <div class="modal-body">

                    <div class="example-wrap">
                        <div class="example">
                                
                                <div class="form-group row">
                                    <label class="col-md-3 control-label"> Registration NO </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control round" name="registration_no" id="registration_no" require />
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label class="col-md-3 control-label"> Class </label>
                                    <div class="col-md-9">
                                        <select class="form-control round" name="class_id" id="class_id" required>
                                            <option value=""> </option>
                                            @forelse($classes as $class)
                                                <option value="{{$class->id}}"> {{$class->class_name}} </option>  
                                            @empty
                                                <option value="">  </option>                     
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 control-label"> Term </label>
                                    <div class="col-md-9">
                                        <select class="form-control round" name="term" id="term" required>
                                            <option value=""></option>
                                            <option value="first">First Term</option>
                                            <option value="second">Second Term</option>
                                            <option value="third">Third Term</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 control-label"> Session </label>
                                    <div class="col-md-9">
                                        <select class="form-control round" name="session_id" id="session_id" required>
                                            <option value=""> </option>
                                            @forelse($sessions as $session)
                                                <option value="{{$session->id}}"> {{$session->session_name}} </option>  
                                            @empty
                                                <option value="">  </option>                     
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                  
                                            
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-0" style="text-align:left">
                                        <button type="reset" class="btn btn-outline btn-warning btn-round">Clear</button>
                                    </div>
                                    
                                    <div class="col-md-6 offset-md-0" style="text-align:right">
                                        <button type="submit" class="btn btn-dark btn-round" id="check_result_btn"> Find Result </button>
                                    </div>
                                </div>                              
                            </div>
                    </div>
                   

                </div>

            </div>
            </div>
        </div>
    </form>


@endsection



















@section('script')


<script>
    $("#resultForm").on('submit',function(e)
    { 
        e.preventDefault();
        var registration_no = $('#registration_no').val(); 
        var class_id = $('#class_id').val(); 
        var term = $('#term').val(); 
        var session_id = $('#session_id').val(); 

        $('#result-card').show();
        $('#resultModal').trigger('click');

        $('#student-result').empty();
        $('#names').val();
        $('#class').val();
        $('#terms').val();
        $('#session').val();
        $('#gender').val();
        $('#category').val();

        $.get('{{url('getStudentResults')}}?registration_no='+registration_no+'&class_id='+class_id+'&term='+term+'&session_id='+session_id, function(data)
        {  
            $.each(data, function(index, results)
            {
                alert(results);
                //student result data
                $('#names').val(results);
                $('#class').val(results.classed.class_name);
                $('#terms').val(results.term);
                $('#session').val(results.session_id);
                $('#gender').val(results.gender);
                $('#category').val(results.category_id);

                $('#student-result').append('<tr>  <td>'+results.subject_id+'</td> <td>'+results.scores+'</td>   <td>'+results.grade+'</td>  <td>'+results.subject_id+'</td> <td>'+results.scores+'</td> <td>'+results.grade+'</td>  </tr>');
            });
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
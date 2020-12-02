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
          <div class="col-md-12" style="text-align: left; padding-bottom: 0px">
            <h2 style="margin-top: -1px"> Check Exam Credentials </h2> 
          </div>          
      </div>

    

      <div class="panel" style="margin-top: -10; padding: 2px 5px;">
        <div class="row page-content">
          <div class="col-md-12">

              <!-- Example Basic -->
              <div class="row">  

                <div class="col-md-3">

                </div>             

                <div class="col-md-6" style="border-right: thin solid #ddd; border-left: thin solid #ddd"> 
                    <form id="authForm" action="{{url('exams')}}" method="POST">
                        @csrf 
                        <input type="hidden" class="form-control" name="type" id="" value="check_exam_details">                 
                        <h4 class="modal-title">Enter Exam Details</h4>
                            <div class="example">
                                
                                <div class="form-group row">
                                    <label class="col-md-3 control-label"> Registration NO </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control round" name="registration_no" id="registration_no" require/>
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label class="col-md-3 control-label"> Subject </label>
                                    <div class="col-md-9">
                                        <select class="form-control round" name="subject_id" id="subject_id" required>
                                            <option value=""> </option>
                                            @forelse($subjects as $subject)
                                                <option value="{{$subject->id}}"> {{$subject->subject_name}} </option>  
                                            @empty
                                                <option value="">  </option>                     
                                            @endforelse
                                        </select>
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
                                    <label class="col-md-3 control-label"> PIN </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control round" name="pin" id="pin" require/>
                                    </div>
                                </div>   
                                            
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-0" style="text-align:left">
                                        <button type="reset" class="btn btn-outline btn-warning btn-round">clear</button>
                                    </div>
                                    
                                    <div class="col-md-6 offset-md-0" style="text-align:right">
                                        <button type="submit" class="btn btn-dark pull-right btn-round">Authenticate </button>
                                    </div>
                                </div>                              
                            </div>
                    </form>
                </div>

                <div class="col-md-3">

                </div>

              </div>
        </div>
      </div>
    </div>




             

           
        </div>
    </div>


@endsection



















@section('script')








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
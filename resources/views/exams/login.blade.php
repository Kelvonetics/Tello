@extends('layouts.app')


<style type="text/css">
    *
    {
    	font-size: 13px;
    }
</style>

@section('content')


    <div class="row" style="padding: 0px 15px; margin-top: -10px"> 

        
        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header">
              
              <div class="col-md-4 offset-md-4" style="border: #e1e1e1 thin dotted; padding: 0px 0px">     
                  <form action="{{ url('test/check_exam_details') }}" method="POST">
                    @csrf
                    <div class="modal-header" style="background: #eee">
                        <h4 class="modal-title" id="myModalLabel">Login To Exam </h4>
                    </div>  <br>         

                    <div style="padding: 15px">
                      <div class="form-group row">
                          <label class="col-md-3 control-label" for="email">Email</label>
                          <div class="col-md-9">
                              <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
                          </div>
                      </div>             

                      <div class="form-group row">
                          <label class="col-md-3 control-label" for="code">Exam Code</label>
                          <div class="col-md-9">
                              <input type="text" class="form-control" placeholder="Code" name="code" id="code" required>
                          </div>
                      </div>             

                      <div class="form-group row">
                          <label class="col-md-3 control-label" for="exam_id">Exam</label>
                          <div class="col-md-9">
                              <select class="form-control" name="exam_id" id="exam_id" required>
                                  <option value=""> Select Exam </option>
                                      @if(count($exams)>0)
                                          @foreach($exams as $exams)
                                              <option value="{{$exams->id}}">{{$exams->test_name}}</option>
                                          @endforeach
                                      @endif
                              </select>
                          </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-2">
                          <button type="reset" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Reset</button>
                        </div>
                        <div class="col-md-8"> </div>
                        <div class="col-md-2">
                          <button type="submit" class="btn btn-success btn-sm">Login</button>
                        </div>
                      </div>
                    </div>
                  </form>
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
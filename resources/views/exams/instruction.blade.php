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

            <div class="box box-success">
              <div class="box-header with-border">
                
                <div class="row">
                  <div class="container-fluid col-sm-10">
                      <h2 class="title" style="text-align:center">Please Read The Instructions Carefully</h2>
                      <h3 class="box-title">Test Instructions</h3>
                      <p style="font-size:16px">1.The examination is a set of multiple choice questions.</p>
                      <p style="font-size:16px">2. The clock would be set at the server. The countdown timer in the top right corner of the screen will display the remaining time available for you to complete the examination.
                      When the timer reaches zero, the examination would end by itself, submitting the scores for the questions answered within that period, and you would not be required to end the examination.</p>
                      <p style="font-size:16px">3. The Question palette displayed at the right side of the screen will show the status of each question using one of the following symbols:</p>
                      <h5><button class="btn btn-success btn-sm"><i class="fa fa-check"></i>   Answered</button> - For the questions answered</h5>
                      <h5><button class="btn btn-warning btn-sm" style="color:white"><i class="fa fa-asterisk"></i>   Marked</button> - For the questions marked for review</h5>
                      <h5><button class="btn btn-default btn-sm"><i class="fa fa-question"></i>   Pending</button> - For the questions not answered</h5>
                      <p style="font-size:16px">*The Marked for Review status for a question simply indicates that you would like to look at the question again</p>
                      <p style="font-size:16px">4. </p>
                      <h3 class="box-title">Navigating to a Question</h3>
                      <p style="font-size:16px">5.To answer a question, do the following.</p>
                      <p style="font-size:16px">a.- Select your option when on the current question</p>
                      <p style="font-size:16px">b.- Click on the green next button to save your answer and move to the next question</p>
                      <p style="font-size:16px">c.- Click on the mark for review button to move to the next question and mark that question for review</p>
                  </div>

                  <div class="container-fluid col-sm-2">
                      <center>
                      <img src="{{asset('assets/dist/img/avatar.png')}}" alt="avatar" style="border-radius:50%;margin-top:30px;width:100;height:100;">
                      </center>
                      <h4 style="text-align:center;margin-top:15px">Applicant</h4>
                  </div>
                </div>

                  
                @if($auth_exam)
                  <a href="{{url('/exams')}}" class="btn btn-success btn-lg" style="float:right"> Take Test</a>
                @endif    

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool"><i class="fa fa-list"></i></button>
                </div>
                <!-- /.box-tools -->
              </div> <br> <br>                
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
@extends('layouts.app-test')


<style type="text/css">
    *
    {
    	font-size: 13px;
    }

    p 
    {
      text-align: center;
      font-size: 40px;
      margin-top: 0px;
      color: #C32148;
    }
    #markBtn_
    {
      background: #FF9966;
    }
    #markBtn_:hover
    {
      background: #E97451;
    }



    /*radio style*/
    /* The container */
    .container 
    {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 22px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Hide the browser's default radio button */
    .container input 
    {
      position: absolute;
      opacity: 0;
      cursor: pointer;
    }

    /* Create a custom radio button */
    .checkmark 
    {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #ccc;
      border-radius: 50%;
      margin-left: 5px;
    }

    /* On mouse-over, add a grey background color */
    .container:hover input ~ .checkmark 
    {
      background-color: #396;
      margin-left: 5px;
    }

    /* When the radio button is checked, add a blue background */
    .container input:checked ~ .checkmark 
    {
      background-color: #396;
      margin-left: 5px;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .checkmark:after 
    {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .container input:checked ~ .checkmark:after 
    {
      display: block;
    }

    /* Style the indicator (dot/circle) */
    .container .checkmark:after 
    {
      top: 9px;
      left: 9px;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: white;
    }

    .option-pad
    {
      margin-left: 30px;
    }

    .barge-span
    {
      padding: 35px 20px;    border-radius: 7px;
    }


    .timer
    {
      background-color:#eee;
      color: #E52B50 !important;
      font-size:20px;
      text-align:center;
    }

    .multiple
    {
      display: none;
    }

    .multiple_mark
    {
      display: none;
    }
</style>

@section('content')

<!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

      <!-- <div class="row">
          <div class="col-md-12" style="text-align: left; padding-bottom: 0px">
            <h2 style="margin-top: -1px"> Check Exam Credentials </h2> 
          </div>          
      </div> -->

    

      <div class="panel" style="margin-top: -10; padding: 2px 5px;">
        <div class="row page-content">
          <div class="col-md-12">

  
            <div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <!-- <div class="box box-success">-->
                  <div class="row box-header with-border"> 

                        <div class="col-md-2"><b> Name </b> : {{Auth::user()->firstname.' '. Auth::user()->lastname}}</div>
                        <div class="col-md-2"><b> Exam </b> : {{$auth_exam->subject->subject_name}}</div>
                        <div class="col-md-2"><b> Class </b> : {{$auth_exam->classed->class_name}} </div>
                        <div class="col-md-2"><b> Term </b> : {{$auth_exam->term}} - {{$auth_exam->session->session_name}}</div>
                        <!-- <div class="col-md-2"> 
                          <select class="form-control" name="language" id="language" style="width: 100%; font-size:12px">
                            <option value="English">English Language</option>
                          </select>
                        </div> -->
                        <div class="col-md-1">
                          <select class="form-control" name="font" id="font" style="width: 100%; font-size:12px">
                            <option value="12">Font - 12</option>
                            <option value="13">Font - 13</option>
                            <option value="14">Font - 14</option>
                            <option value="15">Font - 15</option>
                            <option value="16">Font - 16</option>
                            <option value="17">Font - 17</option>
                            <option value="18">Font - 18</option>
                          </select>
                        </div>
                        <div class="col-md-2 pull-right"> Time Left : <span id="timer" style="font-size: 15px;"> </span>
                        </div>
                        <br> <br>
                  </div>

                        <!-- first start -->
                        <form id="all_quest" action="{{url('exams')}}" method="POST">
                          @csrf
                          <div id="first"> 
                          <div id="" class="row" style="padding-left: 0px; padding-right: 0px"> 
                                <div id="new_div" class="col-md-12 col-sm-12" style="border: thin dotted #e1e1e1">
                                  <div class="box-body" id="old_div">
                                      <div class="row" style="font-size:13px; min-height: 40%">

                                          <div class="col-md-9"> 
                                            <div class="row">
                                            <div class="col-md-10 pull-left" id="" style="padding-left: 15px">
                                              <h3 id="quest_no_append"> Question : <span id="quest_no" style="font-size: 16px"> {{$question->question_no}} of {{$auth_exam->no_of_questions}} </span> </h3> 
                                              <br>
                                              <div id="quest_append"> <h3 id="Question"> {{$question->questions}} </h3> </div>

                                            
                                              <div id="group" style="font-size:18px!important; font-=weight: lighter" @if($question->type_id == 0) class="multiple" @endif>
                                                <div id="" class="row"> 
                                                  <div id="group1_append" class="col-md-6" style=""> <div id="group1"> I : {{$question->group1}} </div> </div>
                                                  <div id="group2_append" class="col-md-6" style=""> <div id="group2"> II : {{$question->group2}} </div> </div>
                                                </div>

                                                <div id="" class="row"> 
                                                  <div id="group3_append" class="col-md-6" style=""> <div id="group3"> III : {{$question->group3}} </div> </div>
                                                  <div id="group4_append" class="col-md-6" style=""> <div id="group4"> IV : {{$question->group4}} </div> </div>
                                                </div>
                                              </div>  <hr>
                                              

                                              <!-- Question and Answer Div -->
                                              <div class="col-md-12" style="padding: 0px">
                                                  <div class="col-md-12" style="">
                                                      <div class="box-header" style="font-size: 14px">  <span class="box-title">A</span>    </div>
                                                        
                                                      <label id="opt1_append" class="container" style="padding-left: 10px; font-weight: lighter;"> 
                                                        <input type="radio" id="A"  name="options" value="A">     <span class="checkmark"></span>
                                                        <span id="opt_1" class="option-pad"> {{$question->option1}} </span> 
                                                      </label>
                                                  
                                                      <div class="box-header" style="font-size: 14px">  <span class="box-title">B</span>    </div>

                                                      <label id="opt2_append" class="container" style="padding-left: 10px; font-weight: lighter;"> 
                                                        <input type="radio" id="B"  name="options" value="B">     <span class="checkmark"></span>
                                                        <span id="opt_2" class="option-pad"> {{$question->option2}} </span> 
                                                      </label>
                                                  
                                                      <div class="box-header" style="font-size: 14px">  <span class="box-title">C</span>    </div>
                                                      
                                                      <label id="opt3_append" class="container" style="padding-left: 10px; font-weight: lighter;"> 
                                                        <input type="radio" id="C"  name="options" value="C">     <span class="checkmark"></span>
                                                        <span id="opt_3" class="option-pad"> {{$question->option3}} </span> 
                                                      </label>
                                                  
                                                      <div class="box-header" style="font-size: 14px">  <span class="box-title">D</span>   </div>

                                                      <label id="opt4_append" class="container" style="padding-left: 10px; font-weight: lighter;"> 
                                                        <input type="radio" id="D"  name="options" value="D">     <span class="checkmark"></span>
                                                        <span id="opt_4" class="option-pad"> {{$question->option4}} </span> 
                                                      </label>
                                                  </div>  
                                              </div>
                                              <!-- Options -->
                                            </div>

                                            <div class="col-md-2 pull-left" id="" style="padding-left: 15px">
                                              <h4 id="mark_append"> Marks : <span id="marks" style="font-size: 16px"> {{$mark}} </span> </h4>
                                            </div>
                                            </div>
                                        </div>


                                          

                                        {{-- countdown Timer --}}
                                        <div id="new_div" class="col-md-3 col-sm-12" style="border: thin dotted #e1e1e1">
                                          <div class="row" style="padding: 15px 5px">        <br>               

                                            <div class="col-xl-4 col-md-12 col-sm-12"> 
                                              <button type="button" class="btn btn-icon btn-success" style="font-size: 14px; border: 0px"><i class="fa fa-check"></i>
                                              <span id="answ"> {{$answered}} </span> Answered</button> 
                                            </div>

                                            <div class="col-xl-4 col-md-12 col-sm-12"> 
                                              <button type="button" class="btn btn-icon btn-default" style="font-size: 14px; margin-left: 5px; border: 0px"><i class="fa fa-question"></i> <span id="pend"> {{$pending}} </span> Pending </button> 
                                            </div>

                                            <div class="col-xl-4 col-md-12 col-sm-12"> 
                                              <button type="button" id="showMark" class="btn btn-icon btn-warning" style="font-size: 14px; border: 0px" @if($marked == 0) disabled @endif><i class="fa fa-asterisk"></i> <span id="marked_numb">{{$marked}}</span> Marked </button> 
                                            </div>
                                          </div>

                                          <div class="table-responsive">
                                              <div id="DateCountdown" data-timer="{{$question->time_left}}" style="width: 100%; height: 20%"></div>
                                              <input type="hidden" class="form-control" id="time_left" name="time_left" value="">
                                          </div>

                                          <div style="display:none">Time left = <span id="time"></span></div>

                                        </div>
                                                                              

                                      </div> 
                                    </div> 
                                </div>
                          </div>

                          <br><br>

                          <div class="row" style="padding-left: 0px; padding-right: 0px"> 
                            <div class="col-md-12" style="">                        
                              <input type="hidden" class="form-control" name="q_n" id="q_n" value="{{$question->question_no}}">
                              <input type="hidden" class="form-control" name="question_number" id="question_number" value="">
                              <input type="hidden" class="form-control" name="end_test" id="end_test" value="">
                              <input type="hidden" class="form-control" name="mark_pending" id="mark_pending" value="">
                              <input type="hidden" class="form-control" id="options" value="" />

                              <input type="hidden" class="form-control" name="type" id="" value="exam">
                            </div>  <br>

                            <div class="col-md-7" style="">
                                <button type="reset" id="clear" name="next" class="btn btn-default pull-left btn-sm">Clear</button>
                                <button type="button" id="markBtn_" name="mark" class="btn btn-warning pull-left btn-sm" style="margin-left: 30px">Mark for Review</button>
                                <button type="button" id="nextBtn_" name="next" class="btn btn-success pull-left btn-sm" style="margin-left: 30px">Next</button>
                            </div>

                            <div class="col-md-5" style="text-align:right">
                                <button type="submit" id="EndBtn" class="btn btn-danger pull-right btn-sm" 
                                onclick="return confirm('Are you sure you want to END Test?')">End Test</button>
                            </div>
                          </div>
                            
                          </div>
                        </form>
                        <!-- first end-->










                        <!-- Marked Question DIV -->
                        <form id="mark_quest" action="{{url('exams_mark')}}" method="POST" style="display: none;">
                          @csrf

                          <div class="box-body" id="first"> 
                                <div class="row" style="font-size:13px; min-height: 40%">
                                  <div id="markedQuestionPage" class="col-md-9" style="border: thin dotted #e1e1e1">
                                    
                                  </div>


                                  
                                  <div id="new_div" class="col-md-3 col-sm-12" style="border: thin dotted #e1e1e1">   
                                      <div id="mark_quest_btn" class="col-md-12"> 
                                        
                                      </div>
                                  </div>

                                      
                                </div> 
                          <br><br>

                          <div class="row" style="padding-left: 0px; padding-right: 0px"> 
                            <div class="col-md-12" style="">                        
                              <input type="hidden" class="form-control" name="q_n_mark" id="q_n_mark" value="">
                              <input type="hidden" class="form-control" id="options_mark" value="" />
                              <input type="hidden" class="form-control" name="end_test_mark" id="end_test_mark" value="">

                              <input type="hidden" class="form-control" name="type" id="" value="exam">
                            </div>

                            <div class="col-md-6" style="">
                                <button type="reset" id="clear_mark" name="next_mark" class="btn btn-default pull-left btn-sm" style="display:none">Clear</button>
                                <button type="button" id="nextBtn_mark" name="next_mark" class="btn btn-success pull-left btn-sm" style="margin-left: 30px; display:none">Next</button>
                            </div>

                            <div class="col-md-6" style="">
                                <button type="submit" id="EndBtn_mark" class="btn btn-danger pull-right btn-sm" 
                                onclick="return confirm('Are you sure you want to END Test?')">End Test</button>
                            </div>
                          </div>  <br> <br>

                          <div class="row" style="padding-left: 0px; padding-right: 0px">                       
                              <button type="button" id="backToQuest" name="back" class="btn btn-info pull-right btn-sm" style="">Back to Questions</button>
                          </div>
                            
                          </div>
                        </form>
                        <!-- first end-->

                  <!-- </div>
                </div> 
              </div>-->
            </div>


          </div>
        </div>
      </div>


    </div>
  </div>

    


    

@endsection















@section('script')

<script>
  $(function()
  {
  //('input[name=options]')
  
    

  function bindOptionClick()
  {
    $('input[name=options]').each(function()
    {
        $(this).on('click',function()
        {
            $('#options').val($(this).val());
            $('#options_mark').val($(this).val());
            $('#end_test').val('');
        });

    });    
  }


  bindOptionClick();
   
    var ans = 0;  var mar = 0;  var pen = '{{$auth_exam->no_of_questions}}';   var no_of_quest = '{{$auth_exam->no_of_questions}}';
    //SCRIPT FOR NEXT BUTTON CLICK
    $('#nextBtn_').click(function(e)
    { 
      ans++;
      pen--;

      $('#end_test').val('');
      $('#question_number').val('');

      //AJAX CALL TO FETCH NEXT QUESTION      
      $.ajax(
      {
        url:'{{url('/getNextQuestion')}}',
        type:'get',
        data:{
          q_n:$('#q_n').val(),
          question_number:$('#question_number').val(),
          end_test:$('#end_test').val(),
          options:$('#options').val(),
          time_left:$('#time_left').val()
        },
        success:function(data)
        {                      
          //Remove Old Question 
          if(data.question_no == no_of_quest) {   $('#nextBtn_').hide();   $('#markBtn_').hide();  } else{}  

          $('#quest_no').remove();         
          $('#Question').remove();    
          $('#group1').remove();  
          $('#group2').remove();  
          $('#group3').remove();  
          $('#group4').remove(); 
          $('#opt_1').remove();   
          $('#opt_2').remove();   
          $('#opt_3').remove();   
          $('#opt_4').remove();

          //Append New Question   
          $('#quest_no_append').append('<span id="quest_no" style="font-size: 16px"> '+data.question_no+' of '+{{$auth_exam->no_of_questions}}+' </span>');
          $('#quest_append').append('<h3 id="Question"> '+data.questions+' </h3>'); 
          if(data.type_id == 1) 
          { 
              $('#group1_append').append('<div id="group1"> I : '+data.group1+' </div> '); 
              $('#group2_append').append('<div id="group2"> II : '+data.group2+' </div> '); 
              $('#group3_append').append('<div id="group3"> III : '+data.group3+' </div> '); 
              $('#group4_append').append('<div id="group4"> IV : '+data.group4+' </div> '); 
          } 
          $('#opt1_append').append('<span id="opt_1" class="option-pad"> '+data.option1+' </span>');   
          $('#opt2_append').append('<span id="opt_2" class="option-pad"> '+data.option2+' </span>');   
          $('#opt3_append').append('<span id="opt_3" class="option-pad"> '+data.option3+' </span>');   
          $('#opt4_append').append('<span id="opt_4" class="option-pad"> '+data.option4+' </span>'); 
           
          $('#q_n').val(data.question_no);

          $("input:radio").prop('checked', false);

          // $("#answ").html(ans);
          // $("#pend").html(pen);

              // test for multiple answer question 
              if(data.type_id == 1) 
              {
                  $("#group").removeClass("multiple");
              }
              else
              {
                  $("#group").addClass("multiple");
              }
        }
      });  

        //AJAX CALL FOR ANSWERED QUESTION COUNT 
        $.get('{{url('getAnsweredQuestionCount')}}', function(data)
        {
            $('#answ').html(data);     
        });

        //AJAX CALL FOR PENDING QUESTION COUNT 
        $.get('{{url('getPendingQuestionCount')}}', function(data)
        {
            $('#pend').html(data);      
        });
      
        //AJAX CALL FOR MARKED QUESTION COUNT 
        $.get('{{url('getMarkQuestionCount')}}', function(data)
        {
            $('#marked_numb').html(data);
            if(data == 0){ $('#showMark').attr("disabled", true);  }   else { $('#showMark').attr("disabled", false); }       
        });
                  

      //ENABLE AND DESABLE PREV - NEXT BUTTON
      enableDisableNextBtn();

      //Increamenting Question Number             
      // var number = $('#q_n').val();
      // number++;
      // $('#ans_quest').html(number);
      // $('#q_n').val(number);

    });




    //SCRIPT FOR NEXT BUTTON CLICK
    $('#nextBtn_mark').click(function(e)
    { 
      ans++;
      mar--;
      $('#opT').show();

      //AJAX CALL TO FETCH NEXT MARK QUESTION      
      $.ajax(
      {
        url:'{{url('/getNextMarkedQuestion')}}',
        type:'get',
        data:{
          q_n_mark:$('#q_n_mark').val(),
          end_test:$('#end_test_mark').val(),
          options_mark:$('#options_mark').val(),
          time_left:$('#time_left').val()
        },
        success:function(data)
        {           
            //if there are no more marked questions
            if(data.question_no == no_of_quest) 
            {   
              $('#nextBtn_mark').hide(); 
              $('#backToQuest').trigger('click');   
            } 
            else
            {
              $('#quest_no_mark').remove();         
              $('#Question_mark').remove();  
              $('#group1_mark').remove();  
              $('#group2_mark').remove();  
              $('#group3_mark').remove();  
              $('#group4_mark').remove();    
              $('#opt_1_mark').remove();   
              $('#opt_2_mark').remove();   
              $('#opt_3_mark').remove();   
              $('#opt_4_mark').remove();           
              
              //Append New Question   
              $('#quest_no_append_mark').append('<span id="quest_no_mark" style="font-size: 16px"> '+data.question_no+' </span>');
              $('#quest_append_mark').append('<h3 id="Question_mark"> '+data.questions+' </h3>');   
              if(data.type_id == 1) 
              { 
                  $('#group1_append_mark').append('<div id="group1_mark"> I : '+data.group1+' </div> '); 
                  $('#group2_append_mark').append('<div id="group2_mark"> II : '+data.group2+' </div> '); 
                  $('#group3_append_mark').append('<div id="group3_mark"> III : '+data.group3+' </div> '); 
                  $('#group4_append_mark').append('<div id="group4_mark"> IV : '+data.group4+' </div> '); 
              } 
              $('#opt1_append_mark').append('<span id="opt_1_mark" class="option-pad"> '+data.option1+' </span>');   
              $('#opt2_append_mark').append('<span id="opt_2_mark" class="option-pad"> '+data.option2+' </span>');   
              $('#opt3_append_mark').append('<span id="opt_3_mark" class="option-pad"> '+data.option3+' </span>');   
              $('#opt4_append_mark').append('<span id="opt_4_mark" class="option-pad"> '+data.option4+' </span>'); 

              $('#nextBtn_mark').hide();   $('#clear_mark').hide(); 
            
              $("input:radio").prop('checked', false);   
              var id = $('#q_n_mark').val();
              $('#'+id+'').remove(); 
              // --window.marked;
              // $('#q_n_mark').val(data.question_no);

              // if(window.marked <= 0)
              // {
              //   $('#backToQuest').trigger('click');
              //   $('#marked_numb').html(window.marked);
              // }
            

              // $("#answ").html(ans);
              // $("#marked_numb").html(mar);
              $('#end_test').val('');



                // test for multiple answer question 
                if (data.type_id == 1) 
                {
                    $("#group_mark").removeClass("multiple_mark");
                }
                else
                {
                    $("#group_mark").addClass("multiple_mark");
                }
            }              
        }
      });   

        //AJAX CALL FOR ANSWERED QUESTION COUNT 
        $.get('{{url('getAnsweredQuestionCount')}}', function(data)
        {
            $('#answ').html(data);     
        });

        //AJAX CALL FOR PENDING QUESTION COUNT 
        $.get('{{url('getPendingQuestionCount')}}', function(data)
        {
            $('#pend').html(data);      
        });
      
        //AJAX CALL FOR MARKED QUESTION COUNT 
        $.get('{{url('getMarkQuestionCount')}}', function(data)
        {
            $('#marked_numb').html(data);
            if(data == 0){   $('#backToQuest').trigger('click');      $('#showMark').attr("disabled", true);  }   
            else { $('#showMark').attr("disabled", false); }       
        });        

    });

   window.marked = 0;

    //SCRIPT FOR FETCHING MARKED QUESTIONS
    $('#showMark').click(function(e)
    {
      $('#all_quest').hide();
      $('#mark_quest').show();
      $('.opT').hide();


      //var id = $(this).val();   
        $.get('{{url('getAllMarkedQuestion')}}', function(data)
        { 
          $('#mark_quest_btn').html('');
          $.each(data, function(index, markQuestionObj)
          {  
            window.marked = index + 1;             
            
            $('#mark_quest_btn').append('<button type="button" id="'+markQuestionObj.question_no+'" class="label label-warning markQn" style="padding: 15px 10px; font-size: 14px; border: 0px;"><i class="fa fa-asterisk"></i> '+markQuestionObj.question_no+' </button> '); 
          });
          refreshJumpQuestions(); 
        });
    });



    //SCRIPT FOR NEXT MARKED QUESTION
    function refreshJumpQuestions()
    {
        $('.markQn').each(function()
        {
          // alert('called....');
          
          $('.opT').show();
          
          $('#quest_no_mark').remove();         
          $('#Question_mark').remove();  
          $('#group1_mark').remove();  
          $('#group2_mark').remove();  
          $('#group3_mark').remove();  
          $('#group4_mark').remove();    
          $('#opt_1_mark').remove();   
          $('#opt_2_mark').remove();   
          $('#opt_3_mark').remove();   
          $('#opt_4_mark').remove(); 
          
          $('#group1_append_mark').remove(); 
          $('#group2_append_mark').remove(); 
          $('#group3_append_mark').remove();
          $('#group4_append_mark').remove(); 
          
          $('#opt1_append_mark').remove();   
          $('#opt2_append_mark').remove();   
          $('#opt3_append_mark').remove();   
          $('#opt4_append_mark').remove(); 

          $('#end_test').val('');
          $(this).on('click',function()
          {
              var id = $(this).attr('id');
              $('#q_n_mark').val(id);
              $('#end_test_mark').val('');
              //AJAX CALL TO FETCH NEXT QUESTION      
              $.ajax(
              {
                url:'{{url('/getMarkedQuestion')}}/' + id,
                type:'get',
                data:{
                  q_n:id
                },
                success:function(data)
                {
                  $('#markedQuestionPage').html(data); //load("{{ url('exams/markedQuestionPage') }}?question_no="+id);
                  bindOptionClick();                      
                }
              });   

              //enable Clear and Next Buttons
              $('#clear_mark').show();       $('#nextBtn_mark').show();  
          });
        });

    }




    $('#backToQuest').click(function(e)
    {
      $('#mark_quest').hide();
      $('#all_quest').show();
    });




     $('#markBtn_').mousedown(function()
     {
        var numb = $('#q_n').val();
        $('#question_number').val(numb);
        $('#end_test').val('');

        //SCRIPT FOR MARKING QUESTION AND LOAD NEXT QUESTION.
          var no_of_quest = '{{$auth_exam->no_of_questions}}';
          mar++;
          pen--;
          //AJAX CALL TO FETCH NEXT QUESTION      
          $.ajax(
          {
            url:'{{url('/getNextQuestion')}}',
            type:'get',
            data:{
              q_n:$('#q_n').val(),
              question_number:$('#question_number').val(),
              end_test:$('#end_test').val(),
              options:$('#options').val(),
              time_left:$('#time_left').val()
            },
            success:function(data)
            {                          
              //Remove Old Question 
              if(data.question_no == no_of_quest) {   $('#nextBtn_').hide();   $('#markBtn_').hide();  } else{}  

              $('#quest_no').remove();         
              $('#Question').remove();    
              $('#group1').remove();  
              $('#group2').remove();  
              $('#group3').remove();  
              $('#group4').remove(); 
              $('#opt_1').remove();   
              $('#opt_2').remove();   
              $('#opt_3').remove();   
              $('#opt_4').remove();

              //Append New Question   
              $('#quest_no_append').append('<span id="quest_no" style="font-size: 16px"> '+data.question_no+' of '+{{$auth_exam->no_of_questions}}+' </span>');
              $('#quest_append').append('<h3 id="Question"> '+data.questions+' </h3>');  
              if(data.type_id == 1) 
              { 
                  $('#group1_append').append('<div id="group1"> I : '+data.group1+' </div> '); 
                  $('#group2_append').append('<div id="group2"> II : '+data.group2+' </div> '); 
                  $('#group3_append').append('<div id="group3"> III : '+data.group3+' </div> '); 
                  $('#group4_append').append('<div id="group4"> IV : '+data.group4+' </div> '); 
              } 
              $('#opt1_append').append('<span id="opt_1" class="option-pad"> '+data.option1+' </span>');   
              $('#opt2_append').append('<span id="opt_2" class="option-pad"> '+data.option2+' </span>');   
              $('#opt3_append').append('<span id="opt_3" class="option-pad"> '+data.option3+' </span>');   
              $('#opt4_append').append('<span id="opt_4" class="option-pad"> '+data.option4+' </span>'); 
           
              $('#q_n').val(data.question_no);

              $("input:radio").prop('checked', false);

              // $("#pend").html(pen);
              // $("#marked_numb").html(mar);

              // test for multiple answer question 
              if (data.type_id== 1) 
              {
                  $("#group").removeClass("multiple");
              }
              else
              {
                  $("#group").addClass("multiple");
              }
            }
          }); 

          //AJAX CALL FOR ANSWERED QUESTION COUNT 
          // $.get('{{url('getAnsweredQuestionCount')}}', function(data)
          // {
          //     $('#answ').html(data);     
          // });

          //AJAX CALL FOR PENDING QUESTION COUNT 
          $.get('{{url('getPendingQuestionCount')}}', function(data)
          {
              $('#pend').html(data);      
          });
        
          //AJAX CALL FOR MARKED QUESTION COUNT 
          $.get('{{url('getMarkQuestionCount')}}', function(data)
          {
              $('#marked_numb').html(data);
              if(data == 0){ $('#showMark').attr("disabled", true);  }   else { $('#showMark').attr("disabled", false); }       
          });    

          //ENABLE AND DESABLE PREV - NEXT BUTTON
          enableDisableNextBtn();

          //Increamenting Question Number             
          // var number = $('#q_n').val();
          // number++;
          // $('#ans_quest').html(number);
          // $('#q_n').val(number);
          $('#end_test').val('');

     });

     $('#nextBtn').mousedown(function()
     {
        $('#end_test').val('');
     });

     $('#EndBtn').mousedown(function()
     {
        $('#end_test').val('end_test');
     });

     $('#EndBtn_mark').mousedown(function()
     {
        $('#end_test_mark').val('end_test');
     });




  });





  //TIMER SCRIPT
  $(function()
  {
    $("#DateCountdown").TimeCircles(
    {
        "animation": "ticks",
        "bg_width": 0.1,
        "fg_width": 0.08,
        "circle_bg_color": "#60686F",
        "direction": "Counter-clockwise",
        "time": {
            "Days": {
                "text": "Days",
                "color": "#FFCC66",
                "show": false
            },
            "Hours": {
                "text": "Hours",
                "color": "#50C878",
                "show": true
            },
            "Minutes": {
                "text": "Minutes",
                "color": "#396",               //007FFF
                "show": true
            },
            "Seconds": {
                "text": "Seconds",
                "color": "#D73B3E",         //FF9999
                "show": true
            }
        }
    });
    $("#DateCountdown").TimeCircles({count_past_zero: false}); 
    //$("#DateCountdown").TimeCircles().getTime();


    $('#DateCountdown').TimeCircles().addListener(function(unit, value, total) 
    {
      var time = $('#DateCountdown').TimeCircles().getTime()
      $('#time_left').val(time);
    });


  });




  //SCRIPT TO DESABLE NEXT BUTTON
  function enableDisableNextBtn()
  {
    var no_of_quest = '{{$auth_exam->no_of_questions}}';
      if($('#q_n').val() == no_of_quest)
      {
          $('#nextBtn_').hide();        
      }
      else
      {
          $('#nextBtn_').show();     
      }
  }



</script>


<script>
  var duration = '{{$auth_exam->duration}}';

    var insertZero = n => n < 10 ? "0"+n : ""+n,
        displayTime = n => n ? time.textContent = insertZero(~~(n/3600)%3600) + ":" + insertZero(~~(n/60)%60) + ":" + insertZero(n%60)
                        : time.textContent = "Time Up", 
        countDownFrom = n => (displayTime(n), setTimeout(_ => n ? sid = countDownFrom(--n) : displayTime(n), 1000)), sid;
    countDownFrom(2700);
    setTimeout(_ => clearTimeout(sid), 2700000000);   //20005      

    // alert('Time Up ' + time.textContent);

    



    //javascript timer
    document.getElementById('timer').innerHTML = duration + ":" + 00;
    startTimer();

    function startTimer() 
    {
      var presentTime = document.getElementById('timer').innerHTML;
      var timeArray = presentTime.split(/[:]+/);
      var m = timeArray[0];
      var s = checkSecond((timeArray[1] - 1));
      if(s == 59)
      {
        m = m - 1;
      }
      if(m == 0 && s == 0)
      {
        // alert('timer completed');
        $.alert(
          {
            title: 'Time Up',
            content: 'Please Click Ok',
            animation: 'zoom',
            closeAnimation: 'scale',
            theme: 'black',
            columnClass: 'col-md-6 col-md-offset-3',
            animationBounce: 1.5,
            confirmButtonClass: 'btn-danger'
          });

          $("#end_test").val('end_test');



          //end test 
          $.ajax(
          {
            url:'{{url('/exams')}}',
            type:'post',
            data:{
              q_n:$('#q_n').val(),
              question_number:$('#question_number').val(),
              end_test:$('#end_test').val(),
              options:$('#options').val(),
              time_left:$('#time_left').val(),
              type:'exam',
              _token:'{{csrf_token()}}'
            },
            success:function(data)
            {                 
              window.location.href = "{{ url('test/instruction') }}";
            }
            
          }); 

      }
      
      document.getElementById('timer').innerHTML = m + ":" + s;
      setTimeout(startTimer, 1000);
    }

    function checkSecond(sec) 
    {
      if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
      if (sec < 0) {sec = "59"};
      return sec;
    }

    
    
</script>




  @if(Session::has('info'))
      <script>
          $(function() 
          {
              toastr.success('{{session('info')}}', {timeOut:50000});
          });
      </script>
  @elseif(Session::has('error'))
      <script>
          $(function() 
          {
              toastr.error('{{session('error')}}', {timeOut:50000});
          });
      </script>
  @endif

@endsection
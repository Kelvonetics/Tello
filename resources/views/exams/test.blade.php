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
            <div class="box-header with-border">
              <h3 class="box-title">Test Questions</h3>

              

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool"><i class="fa fa-list"></i></button>
              </div>
              <!-- /.box-tools -->
            </div> <br> <br>
              <!-- first start -->
              <div id="first"> 
                @if($questions)
                    @foreach($questions as $question)
                    @if($question->id > 0 && $question->id <=4)
                      <div id="new_div">
                        <div class="box-body" id="old_div">
                            <div class="row" style="">
                                <div class="col-md-11">
                                    <h4> Question : <span id="quest_no" style="font-size: 17px"> {{$question->id}} </span> </h4>
                                </div>
                                <div class="col-md-1">
                                    <span class="pull-right"> <span id="ans_quest"> {{$question->id}} </span> of 45</span>
                                </div>

                                <div class="col-md-12" id="quest_append">
                                    <h5 id="question_n"> {{$question->questions}} </h5>
                                </div>
                                    
                            </div> <hr><br>


                            <div class="row" style="">
                                <div class="col-md-6" style="">
                                    <!-- Options -->
                                      <div class="">
                                        <div class="box-header" style="font-size: 14px">  <span class="box-title">A</span>    </div>
                                        <div class="box-body">
                                          <!-- Minimal style -->                                 
                                          <!-- radio -->
                                          <div class="form-group">
                                            <label id="opt1_append">  <input type="radio" name="r3" class="flat-red"> <span id="opt_1"> {{$question->option1}} </span> </label>
                                          </div>
                                        </div>
                                        
                                      </div>
                                      <!-- Options -->
                                </div>
                                <div class="col-md-6" style="">
                                    <!-- Options -->
                                      <div class="">
                                        <div class="box-header" style="font-size: 14px">  <span class="box-title">B</span>    </div>
                                        <div class="box-body">
                                          <!-- Minimal style -->                                 
                                          <!-- radio -->
                                          <div class="form-group">
                                            <label id="opt2_append">  <input type="radio" name="r3" class="flat-red"> <span id="opt_2"> {{$question->option2}} </span> </label>
                                          </div>
                                        </div>
                                        
                                      </div>
                                      <!-- Options -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6" style="">
                                    <!-- Options -->
                                      <div class="">
                                        <div class="box-header" style="font-size: 14px">  <span class="box-title">C</span>    </div>
                                        <div class="box-body">
                                          <!-- Minimal style -->                                 
                                          <!-- radio -->
                                          <div class="form-group">
                                            <label id="opt3_append">  <input type="radio" name="r3" class="flat-red"> <span id="opt_3"> {{$question->option3}} </span> </label>
                                          </div>
                                        </div>
                                        
                                      </div>
                                      <!-- Options -->
                                </div>
                                <div class="col-md-6" style="">
                                    <!-- Options -->
                                      <div class="">
                                        <div class="box-header" style="font-size: 14px">  <span class="box-title">D</span>    </div>
                                        <div class="box-body">
                                          <!-- Minimal style -->                                 
                                          <!-- radio -->
                                          <div class="form-group">
                                            <label id="opt4_append">  <input type="radio" name="r3" class="flat-red"> <span id="opt_4"> {{$question->option4}} </span> </label>
                                          </div>
                                        </div>
                                        
                                      </div>
                                      <!-- Options -->
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-11" style="">
                                    
                                    <button type="submit" id="prevBtn" name="prev" class="btn btn-warning btn-sm pull-left">Prev</button>
                                    <button type="submit" id="nextBtn" name="next" class="btn btn-success btn-sm pull-right">Next</button>


                                </div>
                                <div class="col-md-1" style="">
                                  <input type="text" class="form-control" name="check" id="check" value="{{$question->id}}">
                                    <button type="submit" id="EndBtn" name="next" class="btn btn-danger btn-sm pull-right">End Test</button>
                                </div>
                            </div>
                        </div> 
                      </div> 
                    @endif
                    @endforeach
                @endif
              </div>
              <!-- first end-->





              <!-- second start -->
              <div id="second"> 
                @if($questions)
                    @foreach($questions as $question)
                    @if($question->id >= 4 && $question->id <=8)
                      <div id="new_div">
                        <div class="box-body" id="old_div">
                            <div class="row" style="">
                                <div class="col-md-11">
                                    <h4> Question : <span id="quest_no" style="font-size: 17px"> {{$question->id}} </span> </h4>
                                </div>
                                <div class="col-md-1">
                                    <span class="pull-right"> <span id="ans_quest"> {{$question->id}} </span> of 45</span>
                                </div>

                                <div class="col-md-12" id="quest_append">
                                    <h5 id="question_n"> {{$question->questions}} </h5>
                                </div>
                                    
                            </div> <hr><br>


                            <div class="row" style="">
                                <div class="col-md-6" style="">
                                    <!-- Options -->
                                      <div class="">
                                        <div class="box-header" style="font-size: 14px">  <span class="box-title">A</span>    </div>
                                        <div class="box-body">
                                          <!-- Minimal style -->                                 
                                          <!-- radio -->
                                          <div class="form-group">
                                            <label id="opt1_append">  <input type="radio" name="r3" class="flat-red"> <span id="opt_1"> {{$question->option1}} </span> </label>
                                          </div>
                                        </div>
                                        
                                      </div>
                                      <!-- Options -->
                                </div>
                                <div class="col-md-6" style="">
                                    <!-- Options -->
                                      <div class="">
                                        <div class="box-header" style="font-size: 14px">  <span class="box-title">B</span>    </div>
                                        <div class="box-body">
                                          <!-- Minimal style -->                                 
                                          <!-- radio -->
                                          <div class="form-group">
                                            <label id="opt2_append">  <input type="radio" name="r3" class="flat-red"> <span id="opt_2"> {{$question->option2}} </span> </label>
                                          </div>
                                        </div>
                                        
                                      </div>
                                      <!-- Options -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6" style="">
                                    <!-- Options -->
                                      <div class="">
                                        <div class="box-header" style="font-size: 14px">  <span class="box-title">C</span>    </div>
                                        <div class="box-body">
                                          <!-- Minimal style -->                                 
                                          <!-- radio -->
                                          <div class="form-group">
                                            <label id="opt3_append">  <input type="radio" name="r3" class="flat-red"> <span id="opt_3"> {{$question->option3}} </span> </label>
                                          </div>
                                        </div>
                                        
                                      </div>
                                      <!-- Options -->
                                </div>
                                <div class="col-md-6" style="">
                                    <!-- Options -->
                                      <div class="">
                                        <div class="box-header" style="font-size: 14px">  <span class="box-title">D</span>    </div>
                                        <div class="box-body">
                                          <!-- Minimal style -->                                 
                                          <!-- radio -->
                                          <div class="form-group">
                                            <label id="opt4_append">  <input type="radio" name="r3" class="flat-red"> <span id="opt_4"> {{$question->option4}} </span> </label>
                                          </div>
                                        </div>
                                        
                                      </div>
                                      <!-- Options -->
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-11" style="">
                                    
                                    <button type="submit" id="prevBtn" name="prev" class="btn btn-warning btn-sm pull-left">Prev</button>
                                    <button type="submit" id="nextBtn" name="next" class="btn btn-success btn-sm pull-right">Next</button>


                                </div>
                                <div class="col-md-1" style="">
                                  <input type="text" class="form-control" name="check" id="check" value="{{$question->id}}">
                                    <button type="submit" id="EndBtn" name="next" class="btn btn-danger btn-sm pull-right">End Test</button>
                                </div>
                            </div>
                        </div> 
                      </div> 
                    @endif
                    @endforeach
                @endif
              </div>
              <!-- second end-->





              <!-- third start -->
              <div id="third"> 
                @if($questions)
                    @foreach($questions as $question)
                    @if($question->id >= 4 && $question->id <=8)
                      <div id="new_div">
                        <div class="box-body" id="old_div">
                            <div class="row" style="">
                                <div class="col-md-11">
                                    <h4> Question : <span id="quest_no" style="font-size: 17px"> {{$question->id}} </span> </h4>
                                </div>
                                <div class="col-md-1">
                                    <span class="pull-right"> <span id="ans_quest"> {{$question->id}} </span> of 45</span>
                                </div>

                                <div class="col-md-12" id="quest_append">
                                    <h5 id="question_n"> {{$question->questions}} </h5>
                                </div>
                                    
                            </div> <hr><br>


                            <div class="row" style="">
                                <div class="col-md-6" style="">
                                    <!-- Options -->
                                      <div class="">
                                        <div class="box-header" style="font-size: 14px">  <span class="box-title">A</span>    </div>
                                        <div class="box-body">
                                          <!-- Minimal style -->                                 
                                          <!-- radio -->
                                          <div class="form-group">
                                            <label id="opt1_append">  <input type="radio" name="r3" class="flat-red"> <span id="opt_1"> {{$question->option1}} </span> </label>
                                          </div>
                                        </div>
                                        
                                      </div>
                                      <!-- Options -->
                                </div>
                                <div class="col-md-6" style="">
                                    <!-- Options -->
                                      <div class="">
                                        <div class="box-header" style="font-size: 14px">  <span class="box-title">B</span>    </div>
                                        <div class="box-body">
                                          <!-- Minimal style -->                                 
                                          <!-- radio -->
                                          <div class="form-group">
                                            <label id="opt2_append">  <input type="radio" name="r3" class="flat-red"> <span id="opt_2"> {{$question->option2}} </span> </label>
                                          </div>
                                        </div>
                                        
                                      </div>
                                      <!-- Options -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6" style="">
                                    <!-- Options -->
                                      <div class="">
                                        <div class="box-header" style="font-size: 14px">  <span class="box-title">C</span>    </div>
                                        <div class="box-body">
                                          <!-- Minimal style -->                                 
                                          <!-- radio -->
                                          <div class="form-group">
                                            <label id="opt3_append">  <input type="radio" name="r3" class="flat-red"> <span id="opt_3"> {{$question->option3}} </span> </label>
                                          </div>
                                        </div>
                                        
                                      </div>
                                      <!-- Options -->
                                </div>
                                <div class="col-md-6" style="">
                                    <!-- Options -->
                                      <div class="">
                                        <div class="box-header" style="font-size: 14px">  <span class="box-title">D</span>    </div>
                                        <div class="box-body">
                                          <!-- Minimal style -->                                 
                                          <!-- radio -->
                                          <div class="form-group">
                                            <label id="opt4_append">  <input type="radio" name="r3" class="flat-red"> <span id="opt_4"> {{$question->option4}} </span> </label>
                                          </div>
                                        </div>
                                        
                                      </div>
                                      <!-- Options -->
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-11" style="">
                                    
                                    <button type="submit" id="prevBtn" name="prev" class="btn btn-warning btn-sm pull-left">Prev</button>
                                    <button type="submit" id="nextBtn" name="next" class="btn btn-success btn-sm pull-right">Next</button>


                                </div>
                                <div class="col-md-1" style="">
                                  <input type="text" class="form-control" name="check" id="check" value="{{$question->id}}">
                                    <button type="submit" id="EndBtn" name="next" class="btn btn-danger btn-sm pull-right">End Test</button>
                                </div>
                            </div>
                        </div> 
                      </div> 
                    @endif
                    @endforeach
                @endif
              </div>
              <!-- third end-->






              <!-- fourth start -->
              <div id="fourth"> 
                @if($questions)
                    @foreach($questions as $question)
                    @if($question->id >= 4 && $question->id <=8)
                      <div id="new_div">
                        <div class="box-body" id="old_div">
                            <div class="row" style="">
                                <div class="col-md-11">
                                    <h4> Question : <span id="quest_no" style="font-size: 17px"> {{$question->id}} </span> </h4>
                                </div>
                                <div class="col-md-1">
                                    <span class="pull-right"> <span id="ans_quest"> {{$question->id}} </span> of 45</span>
                                </div>

                                <div class="col-md-12" id="quest_append">
                                    <h5 id="question_n"> {{$question->questions}} </h5>
                                </div>
                                    
                            </div> <hr><br>


                            <div class="row" style="">
                                <div class="col-md-6" style="">
                                    <!-- Options -->
                                      <div class="">
                                        <div class="box-header" style="font-size: 14px">  <span class="box-title">A</span>    </div>
                                        <div class="box-body">
                                          <!-- Minimal style -->                                 
                                          <!-- radio -->
                                          <div class="form-group">
                                            <label id="opt1_append">  <input type="radio" name="r3" class="flat-red"> <span id="opt_1"> {{$question->option1}} </span> </label>
                                          </div>
                                        </div>
                                        
                                      </div>
                                      <!-- Options -->
                                </div>
                                <div class="col-md-6" style="">
                                    <!-- Options -->
                                      <div class="">
                                        <div class="box-header" style="font-size: 14px">  <span class="box-title">B</span>    </div>
                                        <div class="box-body">
                                          <!-- Minimal style -->                                 
                                          <!-- radio -->
                                          <div class="form-group">
                                            <label id="opt2_append">  <input type="radio" name="r3" class="flat-red"> <span id="opt_2"> {{$question->option2}} </span> </label>
                                          </div>
                                        </div>
                                        
                                      </div>
                                      <!-- Options -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6" style="">
                                    <!-- Options -->
                                      <div class="">
                                        <div class="box-header" style="font-size: 14px">  <span class="box-title">C</span>    </div>
                                        <div class="box-body">
                                          <!-- Minimal style -->                                 
                                          <!-- radio -->
                                          <div class="form-group">
                                            <label id="opt3_append">  <input type="radio" name="r3" class="flat-red"> <span id="opt_3"> {{$question->option3}} </span> </label>
                                          </div>
                                        </div>
                                        
                                      </div>
                                      <!-- Options -->
                                </div>
                                <div class="col-md-6" style="">
                                    <!-- Options -->
                                      <div class="">
                                        <div class="box-header" style="font-size: 14px">  <span class="box-title">D</span>    </div>
                                        <div class="box-body">
                                          <!-- Minimal style -->                                 
                                          <!-- radio -->
                                          <div class="form-group">
                                            <label id="opt4_append">  <input type="radio" name="r3" class="flat-red"> <span id="opt_4"> {{$question->option4}} </span> </label>
                                          </div>
                                        </div>
                                        
                                      </div>
                                      <!-- Options -->
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-11" style="">
                                    
                                    <button type="submit" id="prevBtn" name="prev" class="btn btn-warning btn-sm pull-left">Prev</button>
                                    <button type="submit" id="nextBtn" name="next" class="btn btn-success btn-sm pull-right">Next</button>


                                </div>
                                <div class="col-md-1" style="">
                                  <input type="text" class="form-control" name="check" id="check" value="{{$question->id}}">
                                    <button type="submit" id="EndBtn" name="next" class="btn btn-danger btn-sm pull-right">End Test</button>
                                </div>
                            </div>
                        </div> 
                      </div> 
                    @endif
                    @endforeach
                @endif
              </div>
              <!-- fourth end-->

           
          </div>
        </div>   


                  

    </div>


@endsection



















@section('script')

<script>
  $(function()
  {
     alert();
     $('#second').hide();
     $('#third').hide();
     $('#fourth').hide();
  }
</script>

@endsection
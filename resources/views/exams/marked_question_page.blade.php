    
      
      <div class="col-md-9" style="">
        <div class="col-md-10" id="" style="padding-left: 0px">
          <h3 id="quest_no_append_mark"> Question : <span id="quest_no_mark" style="font-size: 16px"> {{$mark_question->question_no}}  </span> </h3> 
          <br>
          <div id="quest_append_mark"><h3 id="Question_mark"> {{$mark_question->questions}} </h3></div>
          

                                 
            <div id="group_mark" style="font-size:18px!important; font-=weight: lighter" @if($mark_question->type_id == 0) class="multiple_mark" @endif>
              <div id="" class="row"> 
                <div id="" class="col-md-6 opT" style=""> <div id="Question"> I : {{$mark_question->group1}} </div> </div>
                <div id="" class="col-md-6 opT" style=""> <div id="Question"> II : {{$mark_question->group2}} </div> </div>
              </div>

              <div id="" class="row"> 
                <div id="" class="col-md-6 opT" style=""> <div id="Question"> III : {{$mark_question->group3}} </div> </div>
                <div id="" class="col-md-6 opT" style=""> <div id="Question"> IV : {{$mark_question->group4}} </div> </div>
              </div>
            </div>
          </div>

        <div class="col-md-2" id="mark_append_mark" style="padding-left: 0px">
          <h4 id="mark_append"> Marks : <span id="marks" style="font-size: 16px">  </span> </h4>
        </div>
      </div>


      <!-- Question and Answer Div --> <br>
      <div class="col-md-12" style="padding: 0px; ">
          <div class="col-md-12">
              <div class="box-header" style="font-size: 14px">  <span class="box-title opT">A</span>    </div>
                
              <label id="opt1_append_mark" class="container" style="padding-left: 10px; font-weight: lighter;"> 
                <input type="radio" id="A"  name="options" value="A">     <span class="checkmark"></span>
                <span id="opt_1_mark" class="option-pad"> {{$mark_question->option1}} </span> 
              </label>                
          
              <div class="box-header" style="font-size: 14px">  <span class="box-title opT">B</span>    </div>

              <label id="opt2_append_mark" class="container" style="padding-left: 10px; font-weight: lighter;"> 
                <input type="radio" id="B"  name="options" value="B">     <span class="checkmark"></span>
                <span id="opt_2_mark" class="option-pad"> {{$mark_question->option2}} </span> 
              </label>
          
              <div class="box-header" style="font-size: 14px">  <span class="box-title opT">C</span>    </div>
              
              <label id="opt3_append_mark" class="container" style="padding-left: 10px; font-weight: lighter;"> 
                <input type="radio" id="C"  name="options" value="C">     <span class="checkmark"></span>
                <span id="opt_3_mark" class="option-pad"> {{$mark_question->option3}} </span> 
              </label>
          
              <div class="box-header" style="font-size: 14px">  <span class="box-title opT">D</span>   </div>

              <label id="opt4_append_mark" class="container" style="padding-left: 10px; font-weight: lighter;"> 
                <input type="radio" id="D"  name="options" value="D">     <span class="checkmark"></span>
                <span id="opt_4_mark" class="option-pad"> {{$mark_question->option4}} </span> 
              </label>
          </div>                                       
        
      </div>
      <!-- Options -->

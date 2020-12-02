

<template>

    <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

    <div class="row">
          <div class="col-xl-2 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px">Questions 

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
              <!-- <classExcelExport :data="allClasses" :file_name="'All Classes'"></classExcelExport>  -->
              <file-upload @done-uploading="fetchQuestions" :api_url="'http://localhost:8000/batch-excel-create'" id="id1"></file-upload>            

              <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-toggle="modal" data-target="#addQuestionModal" 
                    data-original-title="Add New Staff" @click="clearForm()">  <i class="icon wb-plus" aria-hidden="true"></i>
              </button>              
          </div>
      </div>

    

      <div class="panel" style="margin-top: -10; padding: 2px 5px;">
        <div class="row page-content">
          <div class="col-md-12">


            <!-- Example Basic -->
              <div class="example-wrap">               

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead class="thead-dark">
                          <tr>
                            <th>Subject</th>
                            <th>Class</th>
                            <th>Term</th>
                            <th>Question</th>
                            <th>Option 1</th>
                            <th>Option 2</th>
                            <th>Option 3</th>
                            <th>Option 4</th>
                            <th>Ans</th>
                            <!-- <th>Section</th> -->
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                            <tr v-for="question in filteredQuestions" v-bind:key="question.id">
                            
                            <!-- <td v-for="(c,i) in cols" :key="i" >
                                {{ question[c] }}
                            </td> -->
                                <td class="question">{{question.subject.subject_name}}</td>
                                <td class="question">{{question.classed.class_name}}</td>
                                <td class="question">{{question.term}}</td>
                                <td class="question">{{question.questions}}</td>
                                <td class="option1">{{question.option1}}</td>
                                <td class="option2">{{question.option2}}</td>
                                <td class="option3">{{question.option3}}</td>
                                <td class="option4">{{question.option4}}</td>
                                <td class="answer">{{question.answer}}</td>
                                <!-- <td>
                                    <span v-if="question.section_id === 1"> Section 1 </span>
                                    <span v-else-if="question.section_id === 2"> Section 2</span>
                                    <span v-else-if="question.section_id === 3"> Section 3 </span>
                                    <span v-else-if="question.section_id === 4"> Section 4 </span>
                                </td>                           -->

                                <td>
                                    <a class="" data-toggle="modal" data-target="#addQuestionModal" @click="editQuestion(question)">
                                        <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #318CE7"></span>
                                    </a>
                                    <a class="" @click="deleteQuestion(question.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span>
                                    </a>
                                </td>

                                
                            </tr>
                        </tbody>
                    </table>
                

                    <nav aria-label="Page navigation example pull-right" style="margin-top: -20px">
                        <ul class="pagination pagination-sm">
                          <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchQuestions(pagination.prev_page_url)">Prev</a></li>
                          <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                          <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchQuestions(pagination.next_page_url)">Next</a></li>
                        </ul>
                    </nav>

                </div>



            <!-- Modal -->
            <form @submit.prevent="addQuestion">
                    <div class="modal fade modal-just-me" id="addQuestionModal">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">X</span>  </button>
                        <h4 class="modal-title">New Question</h4>
                      </div>

                      <div class="modal-body">



                             <div class="example-wrap">
                                  <div class="example">

                                    <div class="form-group row">
                                        <div class="col-md-4">
                                        <label class="col-md-4 control-label" style="paddind-left: 0px"> Subject </label>
                                            <select class="form-control round" v-model="question.subject_id" required>
                                                <option value=""></option>
                                                <option v-for="subject in subjects" v-bind:value="subject.id"> {{ subject.subject_name }} </option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-4">
                                        <label class="col-md-4 control-label" style="paddind-left: 0px"> Class </label>
                                            <select class="form-control round" v-model="question.class_id" required>
                                                <option value=""></option>
                                                <option v-for="clas in classed" v-bind:value="clas.id"> {{ clas.class_name }} </option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-4">
                                        <label class="col-md-4 control-label" style="padding-left:0px"> Term </label>
                                            <select class="form-control round" v-model="question.term" required>
                                                <option value=""></option>
                                                <option value="first">First Term</option>
                                                <option value="second">Second Term</option>
                                                <option value="third">Third Term</option>
                                                <option value="others">Others</option>
                                            </select>
                                        </div>
                                    </div>

                                      <div class="form-group row">
                                        <label class="col-md-3 control-label">Question </label>
                                        <div class="col-md-9">
                                          <textarea rows="3" class="form-control round" autocomplete="off" v-model="question.questions" required/></textarea>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label class="col-md-3 control-label"> Multiple Answer </label>
                                        <div class="col-md-9">
                                          <div class="radio-custom radio-default radio-inline">
                                            <input type="radio" id="multi_yes" name="" v-model="question.exam_type" v-bind:value="y" />     <label for="multi_yes">Yes</label>
                                          </div>
                                          <div class="radio-custom radio-default radio-inline">
                                            <input type="radio" id="multi_no" name="" v-model="question.exam_type" v-bind:value="n" />   <label for="multi_no">No</label>
                                          </div>
                                        </div>
                                      </div>
                                        

                                    <div id="multi-answer" style="display: none;">
                                      <div class="form-group row">
                                        <div class="col-md-6">
                                        <label class="col-md-6 control-label" style="padding-left:0px">Group 1 </label>
                                          <input type="text" class="form-control round" autocomplete="off" v-model="question.group1"/>
                                        </div>
                                        
                                        <div class="col-md-6">
                                        <label class="col-md-6 control-label" style="padding-left:0px">Group 2 </label>
                                          <input type="text" class="form-control round" autocomplete="off" v-model="question.group2"/>
                                        </div>
                                      </div>
                                        

                                      <div class="form-group row">
                                        <div class="col-md-6">
                                        <label class="col-md-6 control-label" style="padding-left:0px">Group 3 </label>
                                          <input type="text" class="form-control round" autocomplete="off" v-model="question.group3"/>
                                        </div>
                                        
                                        <div class="col-md-6">
                                        <label class="col-md-6 control-label" style="padding-left:0px">Group 4 </label>
                                          <input type="text" class="form-control round" autocomplete="off" v-model="question.group4"/>
                                        </div>
                                      </div>
                                    </div>  

                                        
                                      <div class="form-group row">
                                        <div class="col-md-6">
                                        <label class="col-md-6 control-label" style="padding-left:0px">Option 1 </label>
                                          <input type="text" class="form-control round" autocomplete="off" v-model="question.option1" required/>
                                        </div>
                                        
                                        <div class="col-md-6">
                                        <label class="col-md-6 control-label" style="padding-left:0px">Option 2 </label>
                                          <input type="text" class="form-control round" autocomplete="off" v-model="question.option2" required>
                                        </div>
                                      </div>
                                        

                                      <div class="form-group row">
                                        <div class="col-md-6">
                                        <label class="col-md-6 control-label" style="padding-left:0px">Option 3 </label>
                                          <input type="text" class="form-control round" autocomplete="off" v-model="question.option3" required/>
                                        </div>
                                        
                                        <div class="col-md-6">
                                        <label class="col-md-6 control-label" style="padding-left:0px">Option 4 </label>
                                          <input type="text" class="form-control round" autocomplete="off" v-model="question.option4" required/>
                                        </div>
                                      </div>
                                        

                                      <div class="form-group row">
                                        <div class="col-md-6">
                                        <label class="col-md-6 control-label" style="padding-left:0px"> Answer </label>
                                          <select class="form-control round" v-model="question.answer" required>
                                            <option value=""></option>
                                            <option value="A">Option A</option>
                                            <option value="B">Option B</option>
                                            <option value="C">Option C</option>
                                            <option value="D">Option D</option>
                                        </select>
                                        </div>
                                        
                                        <div class="col-md-6">
                                        <label class="col-md-6 control-label" style="padding-left:0px">Section </label>
                                          <select class="form-control round" v-model="question.section_id" required>
                                            <option value=""></option>
                                            <option value="1">Section 1</option>
                                            <option value="2">Section 2</option>
                                            <option value="3">Section 3</option>
                                            <option value="4">Section 4</option>
                                        </select>
                                        </div>
                                      </div>
                                        

                                      <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-0" style="text-align:left">
                                          <button type="reset" class="btn btn-outline btn-warning btn-round">Reset</button>
                                        </div>
                                        
                                        <div class="col-md-6 offset-md-0" style="text-align:right">
                                          <button type="submit" class="btn btn-dark btn-round">Save Question </button>
                                        </div>
                                      </div>




                                  </div>
                                </div>








                            

                        </div>
                        
                    </div>
                </div>
              </div>
            </form>
            <!-- End Modal -->

          </div>
        </div>
      </div>
    </div>




             

           
        </div>
    </div>
</template>












<script>

    //AJAX SCRIPT TO GET DETAILS FOR 
    $(function()
    {

        $("#multi_yes").change(function() 
        {
            $('#multi-answer').slideDown(); 
        });

        $("#multi_no").change(function() 
        {
            $('#multi-answer').slideUp();
        });
       
    });




    export default
    {
        data(){
            return{
                allQuestions: [],
                search: '',
                subjects: [], 
                classed: [],
                questions: [], 
                question: {
                    id: '',
                    subject_id: '',
                    class_id: '',
                    term: '',
                    section_id: '',
                    questions: '',
                    group1: '',
                    group2: '',
                    group3: '',
                    group4: '',
                    option1: '',
                    option2: '',
                    option3: '',
                    option4: '',
                    answer: ''
                },
                question_id: '',
                y: 1,
                n: 0,
                pagination: {},
                edit: false
            }
        },

        created()
        {
            this.fetchQuestions();
            // this.fetchSessions();
            this.fetchSubjects();
            this.fetchClasses();
        },

        computed: {
            filteredQuestions: function()
            {
                return this.questions.filter((question) => {
                    return question.subject.subject_name.toLowerCase().match(this.search.toLowerCase()) ||
                           question.classed.class_name.toLowerCase().match(this.search.toLowerCase()) ||
                           question.term.toLowerCase().match(this.search.toLowerCase()) ||
                           question.questions.toLowerCase().match(this.search.toLowerCase()) ||
                           question.option1.toLowerCase().match(this.search.toLowerCase()) || 
                           question.option2.toLowerCase().match(this.search.toLowerCase()) || 
                           question.option3.toLowerCase().match(this.search.toLowerCase()) || 
                           question.option4.toLowerCase().match(this.search.toLowerCase()) || 
                           question.answer.toLowerCase().match(this.search.toLowerCase()) 
                });
            }
        },

        methods: 
        {
            fetchAllQuestions(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/questions?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allquestions = res.data;
                })
                .catch(err => console.log(err));
            },

            fetchQuestions(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/questions'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.questions = res.data;
                    vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
            },

            makePagination(meta, links) 
            {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: links.next,
                    prev_page_url: links.prev
                };

                this.pagination = pagination;
            },

            deleteQuestion(id)
            {
                if(confirm('Are You Sure You Want To Delete This Question?'))
                {
                    fetch(`api/question/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success('The Question Has Been Deleted');
                        this.fetchQuestions();
                    })
                    .catch(err => console.log(err));
                }
            },

            addQuestion()
            {
                if(this.edit === false)
                {

                $('#exam_type').val('0');
                    fetch('api/question', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.question),
                        headers: 
                        {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm()
                        toastr.success('Question Has Been created Successfully');
                        this.fetchQuestions();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addQuestionModal').trigger('click');

                }
                else
                {
                    fetch('api/question', 
                    {
                        method: 'put',
                        body: JSON.stringify(this.question),
                        headers: 
                        {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        toastr.success('Question Has Been Updated');
                        this.fetchQuestions();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                    $('#addQuestionModal').trigger('click');
                }
            },

            editQuestion(question)
            {
                this.edit = true;
                this.question.id = question.id;
                this.question.question_id = question.id;
                this.question.subject_id = question.subject_id;
                this.question.class_id = question.class_id;
                this.question.term = question.term;
                this.question.section_id = question.section_id;
                this.question.questions = question.questions;
                this.question.group1 = question.group1;
                this.question.group2 = question.group2;
                this.question.group3 = question.group3;
                this.question.group4 = question.group4;
                this.question.option1 = question.option1;
                this.question.option2 = question.option2;
                this.question.option3 = question.option3;
                this.question.option4 = question.option4;
                this.question.answer = question.answer;
            },



            clearForm()
            {
                this.question.subject_id = '';
                this.question.class_id = '';
                this.question.term = '';
                this.question.section_id = '';
                this.question.questions = '';
                this.question.group1 = '';
                this.question.group2 = '';
                this.question.group3 = '';
                this.question.group4 = '';
                this.question.option1 = '';
                this.question.option2 = '';
                this.question.option3 = '';
                this.question.option4 = '';
                this.question.answer = '';
            },
            


            fetchSubjects()
            {
                let subjects = '/api/subjects'
                fetch(subjects)
                .then(res => res.json())
                .then(res => {
                    this.subjects = res.data;
                })
                .catch(err => console.log(err));            
            },            

            fetchClasses()
            {
                let classed = '/api/classed'
                fetch(classed)
                .then(res => res.json())
                .then(res => {
                    this.classed = res;
                })
                .catch(err => console.log(err));            
            },
        }
    };

</script>


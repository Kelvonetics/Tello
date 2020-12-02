<template>

    <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

    <div class="row">
          <div class="col-xl-2 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px">Setup Exam 

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
              <!-- <file-upload @done-uploading="fetchQuestions" :api_url="'http://localhost:8000/batch-excel-create'" id="id1"></file-upload>             -->

              <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-toggle="modal" 
                    data-original-title="Add Exam Pin" @click="clearForm()">  <i class="icon wb-plus" aria-hidden="true"></i>
              </button>              
          </div>
      </div>

    

      <div class="panel" style="margin-top: -10; padding: 2px 5px;">
        <div class="row page-content">
          <div class="col-md-12">


            <!-- Example Basic -->
              <div class="row">               

                <div class="col-md-4 pull-left" style="border-right:#ddd thin solid; ">
                    <h4 class="modal-title">Exam Pins</h4>
                    <form @submit.prevent="addExamPin">
                        <div class="example">

                            <div class="form-group row">
                                <label class="col-md-3 control-label"> Subject </label>
                                <div class="col-md-9">
                                    <select class="form-control round" v-model="exam_pin.subject_id" required>
                                        <option value=""></option>
                                        <option v-for="subject in subjects" v-bind:value="subject.id">  {{ subject.subject_name }}  </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 control-label"> Class </label>
                                <div class="col-md-9">
                                    <select class="form-control round" v-model="exam_pin.class_id" required>
                                        <option value=""></option>
                                        <option v-for="clas in classed" v-bind:value="clas.id">  {{ clas.class_name }}  </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-3 control-label"> Term </label>
                                <div class="col-md-9">
                                    <select class="form-control round" v-model="exam_pin.term" required>
                                        <option value=""></option>
                                        <option value="first">First Term</option>
                                        <option value="second">Second Term</option>
                                        <option value="third">Third Term</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 control-label"> Session </label>
                                <div class="col-md-9">
                                    <select class="form-control round" v-model="exam_pin.session_id" required>
                                        <option value=""></option>
                                        <option v-for="session in sessions" v-bind:value="session.id">  {{ session.session_name }}  </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-3 control-label"> Date </label>
                                <div class="col-md-9">
                                     <input type="date" class="form-control round" autocomplete="off" v-model="exam_pin.date"/>
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label class="col-md-3 control-label"> No of Questions </label>
                                <div class="col-md-9">
                                     <input type="number" class="form-control round" autocomplete="off" min="0" v-model="exam_pin.no_of_questions"/>
                                </div>
                            </div> 
                            
                            <div class="form-group row">
                                <label class="col-md-3 control-label"> Duration </label>
                                <div class="col-md-9">
                                     <input type="number" class="form-control round" autocomplete="off" min="0" v-model="exam_pin.duration"/>
                                </div>
                            </div>   
                                         
                            <div class="form-group row">
                            <div class="col-md-6 offset-md-0" style="text-align:left">
                                <button type="reset" class="btn btn-outline btn-warning btn-round">Reset</button>
                            </div>
                            
                            <div class="col-md-6 offset-md-0" style="text-align:right">
                                <button type="submit" class="btn btn-dark pull-right btn-round">Generate PIN </button>
                            </div>
                            </div>                              
                        </div>
                    </form>

                </div>             

                <div class="col-md-8 pull-left">
                    <div class="example table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead class="thead-dark">
                            <tr>
                                <th>Registration NO</th>
                                <th>Subject</th>
                                <th>Class </th>
                                <th>Term</th>
                                <th>Session </th>
                                <th>Date</th>
                                <th>Pin</th>
                                <th>No Quest</th>
                                <th>Duration</th>
                                <th style="text-align: right">Action</th>
                            </tr>
                            </thead>
                            <tbody v-for="exam_pin in filteredExamPins" v-bind:key="exam_pin.id">
                            <tr style="background: #fff">
                                <td>{{exam_pin.registration_no}}</td>
                                <td>{{exam_pin.subject.subject_name}}</td>
                                <td>{{exam_pin.classed.class_name}}</td>
                                <td>{{exam_pin.term}}</td>
                                <td>{{exam_pin.session.session_name}}</td>
                                <td>{{exam_pin.date}}</td>
                                <td>{{exam_pin.pin}}</td>
                                <td>{{exam_pin.no_of_questions}}</td>
                                <td>{{exam_pin.duration}}</td>
                                <td style="text-align: right">
                                    <a class="pull-right" @click="editExamPin(exam_pin)">
                                        <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                                    </a>
                                    <a class="pull-right" @click="deleteExamPin(exam_pin.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>


                        <nav aria-label="Page navigation example pull-right">
                            <ul class="pagination pagination-sm">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchFees(pagination.prev_page_url)">Prev</a></li>
                            <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchFees(pagination.next_page_url)">Next</a></li>
                            </ul>
                        </nav>

                    </div>
                </div>

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
                allExamPins: [],
                search: '',
                subjects: [], 
                classed: [],  
                sessions: [], 
                exam_pins: [], 
                exam_pin: {
                    id: '',
                    subject_id: '',
                    pin: '',
                    class_id: '',
                    term: '',
                    session_id: '',
                    registration_no: '',
                    date: '',
                    no_of_questions: '',
                    duration: '',
                    status_id: ''
                },
                exam_pin_id: '',
                pagination: {},
                edit: false
            }
        },

        computed: {
            filteredExamPins: function()
            {
                return this.exam_pins.filter((exam_pin) => {
                    return exam_pin.registration_no.toLowerCase().match(this.search.toLowerCase())||
                           exam_pin.subject.subject_name.toLowerCase().match(this.search.toLowerCase()) ||
                           exam_pin.classed.class_name.toLowerCase().match(this.search.toLowerCase()) ||
                           exam_pin.term.toLowerCase().match(this.search.toLowerCase()) || 
                           exam_pin.session.session_name.toLowerCase().match(this.search.toLowerCase()) ||
                           exam_pin.date.toLowerCase().match(this.search.toLowerCase()) || 
                           exam_pin.no_of_questions.toString().match(this.search.toString()) || 
                           exam_pin.duration.toString().match(this.search.toString()) || 
                           exam_pin.pin.toLowerCase().match(this.search.toLowerCase())
                });
            }
        },

        created()
        {
            this.fetchAllExamPins();
            this.fetchExamPins();
            this.fetchSubjects();
            this.fetchClasses();
            this.fetchSessiones();
        },


        methods: 
        {
            fetchAllExamPins(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/exam_pins?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allexam_pins = res.data;
                })
                .catch(err => console.log(err));
            },

            fetchExamPins(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/exam_pins'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.exam_pins = res.data;
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

            deleteExamPin(id)
            {
                if(confirm('Are You Sure You Want To Delete This Exam Pin?'))
                {
                    fetch(`api/exam_pin/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success('The ExamPin Has Been Deleted');
                    })
                    .catch(err => console.log(err));
                }
            },

            addExamPin()
            {
                if(this.edit === false)
                {
                    fetch('api/exam_pin', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.exam_pin),
                        headers: 
                        {
                            'content-type': 'application/json'
                        }
                        
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        this.fetchExamPins();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                }
                else
                {
                    fetch('api/exam_pin', 
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
                        toastr.success('Exam Pin Has Been Updated');
                        this.fetchExamPins();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                }
            },

            editExamPin(exam_pin)
            {
                this.edit = true;
                this.exam_pin.id = exam_pin.id;
                this.exam_pin.exam_pin_id = exam_pin.id;
                this.exam_pin.subject_id = exam_pin.subject_id;
                this.exam_pin.pin = exam_pin.pin;
                this.exam_pin.class_id = exam_pin.class_id;
                this.exam_pin.term = exam_pin.term;
                this.exam_pin.session_id = exam_pin.session_id;
                this.exam_pin.registration_no = exam_pin.registration_no;
                this.exam_pin.date = exam_pin.date;
                this.exam_pin.no_of_questions = exam_pin.no_of_questions;
                this.exam_pin.duration = exam_pin.duration;
                this.exam_pin.status_id = exam_pin.status_id;
            },



            clearForm()
            {
                this.question.subject_id = '';
                this.question.pin = '';
                this.question.class_id = '';
                this.question.term = '';
                this.question.session_id = '';
                this.question.registration_no = '';
                this.question.date = '';
                this.question.no_of_questions = '';
                this.question.duration = '';
                this.question.status_id = '';
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

            fetchSessiones()
            {
                let sessions = '/api/sessions'
                fetch(sessions)
                .then(res => res.json())
                .then(res => {
                    this.sessions = res.data;
                })
                .catch(err => console.log(err));            
            },
        }
    };

</script>


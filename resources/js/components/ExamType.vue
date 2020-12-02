<style>
  .nav-link
  {
    padding: 5px 35px;
    font-size: 15px;
  }




      /*******************************
      * MODAL AS LEFT/RIGHT SIDEBAR
      * Add "left" or "right" in modal parent div, after class="modal".
      * Get free snippets on bootpen.com
      *******************************/
       
        .modal .right .modal-dialog 
        {
          position: fixed;
          width: 545px;          
          margin-top: 0px !important;
          margin-bottom: 0px !important;
          top: 0px;
          /*height: 98%;*/
          -webkit-transform: translate3d(0%, 0, 0);
              -ms-transform: translate3d(0%, 0, 0);
               -o-transform: translate3d(0%, 0, 0);
                  transform: translate3d(0%, 0, 0);
        }


        .modal.right .modal-content 
        {
          height: 100%;
          overflow-y: auto;
        }
        

        .modal.right .modal-body 
        {
          /*padding: 15px 15px 80px;*/
          padding-top: 0px;
          padding-bottom: 0px;
        }


              
      /*Right*/
        .modal.right.fade .modal-dialog 
        {
          right: -545px;
          margin-top: 0px !important;
          margin-bottom: 0px !important;
          top: 0px;
          /*height: 98%;*/
          -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
             -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
               -o-transition: opacity 0.3s linear, right 0.3s ease-out;
                  transition: opacity 0.3s linear, right 0.3s ease-out;
        }
        
        .modal.right.fade.in .modal-dialog 
        {
          right: 0;
        }


      /* ----- MODAL STYLE ----- */
        .modal-content 
        {
          border-radius: 0;
          border: none;
        }

        .modal-header 
        {
          border-bottom-color: #EEEEEE;
          background-color: #FAFAFA;
        }


        .col-form-label
        {
          padding-left: 0px;
        }

        .radio
        {
          height: 20px; width: 20px;
          color: #396;
          margin-bottom: 5px;
        }

</style>

<template>
  <div class="row" style="">
    <div class="col-md-12">

      <div class="">
      <!-- Nav pills -->
      <ul class="nav nav-pills" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#test_">Set Up Test</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#grading_">Grading</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#access_">Access</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#t">Good</a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div id="test_" class="tab-pane active"><br> 

            <div class="row">
              <div class="col-md-11">
                <h2 style="padding: ">Test Configuration</h2>
              </div>
              <div class="col-md-1">
                <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addTestTypeModal" @click="clearForm()"> <i class="fa fa-plus"> </i> New Test</button>
              </div>
            </div>

            <table class="table table-striped table-hover table-sm">
              <thead class="thead-dark">
                <tr>
                  <th>Test Name</th>
                  <th>Test Type</th>
                  <th>Category</th>
                  <th>No of Question</th>
                  <th>Marks Per Question</th>
                  <th>Answering Type</th>
                  <th>Timing</th>
                  <th>Duration</th>
                  <th>Test Co-ordinator</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="exam_type in exam_types" v-bind:key="exam_type.id">
                  <td>{{exam_type.test_name}}</td>
                  <td>{{exam_type.test_type}}</td>
                  <td>
                      <span v-if="exam_type.category_id === 1"> Begineer </span>
                      <span v-else-if="exam_type.category_id === 2"> Intermidiate</span>
                      <span v-else-if="exam_type.category_id === 3"> Advance </span>
                      <span v-else-if="exam_type.category_id === 4"> Expert </span>
                  </td>
                  <td>{{exam_type.no_of_questions}}</td>
                  <td>{{exam_type.mark_per_question}}</td>
                  <td>{{exam_type.answering_type}}</td>
                  <td>{{exam_type.timing}}</td>
                  <td>{{exam_type.duration}} mins</td>
                  <td>{{exam_type.user_id}}</td>
                  <td>
                    <a class="pull-right" data-toggle="modal" data-target="#addTestTypeModal" @click="editExamType(exam_type)">
                      <span class="fa fa-pen text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                    </a>
                    <a class="pull-right" @click="deleteExam(exam_type.id)">
                      <span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>

            <form @submit.prevent="addExamType">
              <div class="modal right fade" id="addTestTypeModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Add / Edit Exam </h4>
                      <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <label for="test_name" class="col-sm-12 col-form-label">Test Name</label>
                          <input type="text" class="form-control" placeholder="Test Name" v-model="exam_type.test_name" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-12">
                          <label for="test_type" class="col-sm-12 col-form-label">Test Type</label>
                          <select class="form-control" v-model="exam_type.test_type" required>
                              <option value=""></option>
                              <option value="Intenship Exam">Intenship Exam</option>
                              <option value="Junior Staff Exam">Junior Staff Exam</option>
                              <option value="Senior Staff Exam">Senior Staff Exam</option>
                              <option value="Managerial Position Exam">Managerial Position Exam</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-12">
                          <label for="category_id" class="col-sm-12 col-form-label">Category</label>
                          <select class="form-control" v-model="exam_type.category_id" required>
                              <option value=""></option>
                              <option value="1">Begineer</option>
                              <option value="2">Intermidiate</option>
                              <option value="3">Advance</option>
                              <option value="4">Expert</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-12">
                          <label for="no_of_questions" class="col-sm-12 col-form-label">No of Questions</label>
                          <input type="number" class="form-control" placeholder="" v-model="exam_type.no_of_questions" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-12">
                          <label for="answering_type" class="col-sm-12 col-form-label">Answering Type</label>
                          <select class="form-control" v-model="exam_type.answering_type" required>
                              <option value=""></option>
                              <option value="1">User Can Change Answer and Skip Question (Default)</option>
                              <option value="2">User Can Change Answer</option>
                              <option value="3">User Can Skip Question</option>
                              <option value="4">User Cannot Change Answer</option>
                              <option value="5">User Cannot Skip Question</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-12">
                          <label for="timing" class="col-sm-12 col-form-label">Timing</label>
                          <div class="row">
                              <div class="col-md-1"><input type="radio" name="timing" class="radio" v-model="exam_type.timing" v-bind:value="1"></div> 
                              <div class="col-md-11">Exam Time Limit</div>

                              <div class="col-md-1"><input type="radio" name="timing" class="radio" value="2" v-model="exam_type.timing"></div> 
                              <div class="col-md-11">Question Time Limit</div>

                              <div class="col-md-1"><input type="radio" name="timing" class="radio" value="3" v-model="exam_type.timing"></div> 
                              <div class="col-md-11">No Time Limit</div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-12">
                          <label for="duration" class="col-sm-12 col-form-label">Duration in Minutes</label>
                          <input type="text" class="form-control" placeholder="Duration" v-model="exam_type.duration" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="user_id" class="col-md-3 control-label">Test Coordinator</label>
                        <div class="col-md-12">
                          <select class="form-control" v-model="exam_type.user_id" required>
                            <option v-for="user in users" v-bind:key="user.id" v-bind:value="user.id">{{ user.firstname }}</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success btn-sm">Save</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>

        </div>
        <div id="grading_" class="tab-pane fade"><br>
          
            <div class="row">
              <div class="col-md-11">
                <h2 style="padding: ">Test Grading</h2>
              </div>
              <div class="col-md-1">
                <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addGradingModal" @click="clearGradeForm()"> <i class="fa fa-plus"> </i> New Grading </button>
              </div>
            </div>

            <table class="table table-striped table-hover table-sm">
              <thead class="thead-dark">
                <tr>
                  <th>Test Name</th>
                  <th>Grading Category</th>
                  <th>Percentage %</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="grading in gradings" v-bind:key="grading.id">
                  <td>{{grading.exam_id}}</td>
                  <td>{{grading.grade_name}}</td>
                  <td>{{grading.from}}  - {{grading.to}}</td>
                  <td>{{grading.description}}</td>
                  <td>
                    <a class="pull-right" data-toggle="modal" data-target="#addGradingModal" @click="editGrading(grading)">
                      <span class="fa fa-pen text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                    </a>
                    <a class="pull-right" @click="deleteGrading(grading.id)">
                      <span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>

            <form @submit.prevent="addGrading">
              <div class="modal right fade" id="addGradingModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Add / Edit Grading </h4>
                      <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                      <div class="form-group row">
                        <label for="exam_id" class="col-md-3 control-label">Exam Name</label>
                        <div class="col-md-12">
                          <select class="form-control" v-model="grading.exam_id" required>
                            <option v-for="exam in exams" v-bind:key="exam.id" v-bind:value="exam.id">{{ exam.test_name }}</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-12">
                          <label for="grade_name" class="col-sm-12 col-form-label">Grade Name</label>
                          <input type="text" class="form-control" placeholder="" v-model="grading.grade_name" required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-12">
                          <label for="timing" class="col-sm-12 col-form-label">Percentage</label>
                          <div class="row"> 
                              <div class="col-md-1">From</div>
                              <div class="col-md-5"><input type="text" class="form-control" v-model="grading.from" required></div>

                              <div class="col-md-1">To</div>
                              <div class="col-md-5"><input type="text" class="form-control" v-model="grading.to" required></div> 
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-sm-12">
                          <label for="description" class="col-sm-12 col-form-label">Grade Description</label>
                          <textarea rows="3" class="form-control" placeholder="" v-model="grading.description" required></textarea>
                        </div>
                      </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success">Save</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>

        </div>
        <div id="access_" class="tab-pane fade"><br>
          

        </div>
        <div id="t" class="tab-pane fade"><br>
          

        </div>
      </div>

    </div>




      
    </div>



      

  </div>
</template>

<script>
export default 
{
  data() 
  {
    return {
      exam_types: [],
      users: [],
      exam_type: {
        id: "",
        test_name: "",
        test_type: "",
        category_id: "",
        no_of_questions: "",
        answering_type: "",
        timing: "",
        duration: "",
        user_id: "",
        session_id: ""
      },
      gradings: [],
      exams: [],
      grading: {
        id: "",
        exam_id: "",
        grade_name: "",
        from: "",
        to: "",
        description: ""
      },
      examtype_id: "",
      grading_id: "",
      pagination: {},
      edit: false
    }
  },
  created() 
  {
    this.fetchExams();
    this.fetchUsers();
    this.fetchGradings();
    this.fetchExam();
  },
  methods: {
    fetchExams(page_url) 
    {
      let vm = this;
      page_url = page_url || "/api/exam_types";
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.exam_types = res.data;
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

    deleteExam(id) 
    {
      if (confirm("Are You Sure You Want To Delete Record?")) 
      {
        fetch(`api/exam_type/${id}`, {
          method: "delete"
        })
          .then(res => res.json())
          .then(data => {
            alert("Exam Type Deleted");
            this.fetchExams();
          })
          .catch(err => console.log(err));
      }
    },

    addExamType() 
    {
      if (this.edit === false) 
      {
        fetch("api/exam_type", {
          method: "post",
          body: JSON.stringify(this.exam_type),
          headers: {
            "content-type": "application/json"
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert("ExamType Has Been Added");
            this.fetchExams();
            this.edit = false;
          })
          .catch(err => console.log(err));
          $('#addTestTypeModal').trigger('click');
      } 
      else 
      {
        fetch("api/exam_type", {
          method: "put",
          body: JSON.stringify(this.exam_type),
          headers: {
            "content-type": "application/json"
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert("Exam Type Has Been Updated");
            this.fetchExams();
            this.edit = false;
          })
          .catch(err => console.log(err));
          $('#addTestTypeModal').trigger('click');
      }
    },

    editExamType(exam_type) 
    {
      this.edit = true;
      this.exam_type.id = exam_type.id;
      this.exam_type.examtype_id = exam_type.id;
      this.exam_type.test_name = exam_type.test_name;
      this.exam_type.test_type = exam_type.test_type;
      this.exam_type.category_id = exam_type.category_id;
      this.exam_type.no_of_questions = exam_type.no_of_questions;
      this.exam_type.answering_type = exam_type.answering_type;
      this.exam_type.timing = exam_type.timing;
      this.exam_type.duration = exam_type.duration;
      this.exam_type.user_id = exam_type.user_id;
      this.exam_type.session_id = exam_type.session_id;
    },

    clearForm() 
    {
      this.exam_type.test_name = "";
      this.exam_type.test_type = "";
      this.exam_type.category_id = "";
      this.exam_type.no_of_questions = "";
      this.exam_type.answering_type = "";
      this.exam_type.timing = "";
      this.exam_type.duration = "";
      this.exam_type.user_id = "";
      this.exam_type.session_id = '';
    },

    fetchUsers() 
    {
      let users = "/api/users";
      fetch(users)
        .then(res => res.json())
        .then(res => {
          // console.log(res.data);
          this.users = res.data;
        })
        .catch(err => console.log(err));
    },
    



    fetchGradings(page_url) 
    {
      let vm = this;
      page_url = page_url || "/api/gradings";
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.gradings = res.data;
          vm.makeGradingPagination(res.meta, res.links);
        })
        .catch(err => console.log(err));
    },
    makeGradingPagination(meta, links) 
    {
      let pagination = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      };

      this.pagination = pagination;
    },

    deleteGrading(id) 
    {
      if (confirm("Are You Sure You Want To Delete This Grading Category?")) 
      {
        fetch(`api/grading/${id}`, {
          method: "delete"
        })
          .then(res => res.json())
          .then(data => {
            alert("Grading Category Deleted");
            this.fetchGradings();
          })
          .catch(err => console.log(err));
      }
    },

    addGrading() 
    {
      if (this.edit === false) 
      {
        fetch("api/grading", {
          method: "post",
          body: JSON.stringify(this.grading),
          headers: {
            "content-type": "application/json"
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearGradeForm();
            alert("Grading Category Has Been Added");
            this.fetchGradings();
          })
          .catch(err => console.log(err));
          $('#addGradingModal').trigger('click');
      } 
      else 
      {
        fetch("api/grading", {
          method: "put",
          body: JSON.stringify(this.grading),
          headers: {
            "content-type": "application/json"
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearGradeForm();
            alert("Grading Category Has Been Updated");
            this.fetchGradings();
          })
          .catch(err => console.log(err));
          $('#addGradingModal').trigger('click');
      }
    },

    editGrading(grading) 
    {
      this.edit = true;
      this.grading.id = grading.id;
      this.grading.grading_id = grading.id;
      this.grading.exam_id = grading.exam_id;
      this.grading.grade_name = grading.grade_name;
      this.grading.from = grading.from;
      this.grading.to = grading.to;
      this.grading.description = grading.description;
    },

    clearGradeForm() 
    {
      this.grading.test_name = "";
      this.grading.grade_name = "";
      this.grading.from = "";
      this.grading.to = "";
      this.grading.description = "";
    },

    fetchExam() 
    {
      let exams = "/api/exam_types";
      fetch(exams)
        .then(res => res.json())
        .then(res => {
          // console.log(res.data);
          this.exams = res.data;
        })
        .catch(err => console.log(err));
    }
  }
};
</script>


<style>
    .modal-sidebar
    {        
        height: 100%;
        right: 2px;
        position: fixed;
        width: 545px;          
        margin-top: 55px !important;
        margin-bottom: 0px !important;
        top: 0px;
        /*height: 98%;*/
        -webkit-transform: translate3d(0%, 0, 0);
              -ms-transform: translate3d(0%, 0, 0);
               -o-transform: translate3d(0%, 0, 0);
                  transform: translate3d(0%, 0, 0);
    }

    .modal-footer
    {
        padding-bottom: 2rem;
    }

    .btn-round 
    {
        border-radius: 1000px;
        /*margin-left: 65%;*/
    }
    table 
    {
    display: table;
    border-collapse: separate;
    border-spacing: 1px;
    border-color: #eee !important;
}
</style>


<template>
    <div class="row" style="">

        <div class="col-md-12" style="padding: 0px">

    		      <div class="row">

                <div class="col-xl-9 col-md-7 col-sm-6" style=""><h2 style="">Exams
                    <!-- <sessionExcelExport :data="allSessions" :file_name="'All Session'"></sessionExcelExport> -->
                  </h2> 
                </div>
                <div class="col-xl-2 col-md-3 col-sm-3" style=""> 
                    <div class="form-group">
                        <div class="input-search">
                          <button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
                          <input type="text" class="form-control pull-right" placeholder="Search" v-model="search" />
                        </div>
                      </div>
                </div>              
                <div class="col-xl-1 col-md-2 col-sm-3" style=""> 

                    <button type="button" class="btn btn-success  btn-sm btn-iconbtn-outline btn-round" data-target="#addTestTypeModal" data-toggle="modal" 
                    data-original-title="Add New Exam" @click="clearForm()">    <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>              
                </div>

				      <div class="col-md-12">
		          <table class="table table-striped table-hover table-sm">
		            <thead class="thead-dark">
		              <tr>
		                <th>Test Name</th>
		                <th>Session</th>
                    <th>Class</th>
                    <th>Subject</th>
		                <th>No of Question</th>
		                <th>Marks Per Question</th>
		                <th>Duration</th>
                    <th>Exam Coodibator</th>
		                <th style="text-align: right;">Action</th>
		              </tr>  
		            </thead>
		            <tbody>
		              <tr v-for="exam_type in filteredExams" v-bind:key="exam_type.id">
		                <td>{{exam_type.test_name}}</td>
		                <td>{{exam_type.session_id}}</td>
                    <td>{{exam_type.class_id}}</td>
                    <td>{{exam_type.subject_id}}</td>
		                <td>{{exam_type.no_of_questions}}</td>
		                <td>{{exam_type.mark_per_question}}</td>
		                <td>{{exam_type.duration}} mins</td>
                    <td>{{exam_type.user.firstname}} {{exam_type.user.lastname}}</td>
		                <td style="text-align: right;">
		                  <a class="pull-right" data-toggle="modal" data-target="#addTestTypeModal" title="Edit Exam" 
		                  @click="editExamType(exam_type)">
		                    <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #007FFF; cursor: pointer;"></span>
		                  </a>
		                  <a class="pull-right" title="Setup Access For This Test">
                        <router-link class="" v-bind:to="'/access/' + exam_type.id" style="">
		                  		<span class="fa fa-universal-access text-inverse m-r-10" style="margin :1px 2px; color: green; cursor: pointer;"></span> 
                        </router-link>                   
		                  </a>
		                  <a class="pull-right" title="Delete  Details" @click="deleteExam(exam_type.id)">
		                    <span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red; cursor: pointer;"></span>
		                  </a>
		                </td>
		              </tr>
		            </tbody>
		          </table>
		      	  </div>








		          <form @submit.prevent="addExamType" class="form-horizontal">
                    <div class="modal modal-lg fade" id="addTestTypeModal" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1" style="margin-top: 36px">
                      <div class="modal-dialog modal-sidebar modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">&times;</span>  </button>
                            <h4 class="modal-title">New Exam</h4>
                          </div>

                          <div class="modal-body">

                                 <div class="example-wrap">
                                      <div class="example">

                                      <div class="form-group row">
                                          <label for="test_name" class="col-md-3 form-control-label">Test Name</label>
                                        <div class="col-md-9">
                                          <input type="text" class="form-control round" v-model="exam_type.test_name" required>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="test_type" class="col-md-3 form-control-label">Session</label>
                                        <div class="col-md-9">
                                          <select class="form-control round" v-model="exam_type.session_id" required>
                                            <option value=""></option>
                                            <option value="1">Session 2018 - 2019</option>
                                            <option value="2">Session 2019 - 2020</option>
                                            <option value="3">Session 2020 - 2021</option>
                                          </select>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="category_id" class="col-md-3 form-control-label">Class</label>
                                        <div class="col-md-9">
                                          <select class="form-control round" v-model="exam_type.class_id" required>
                                              <option value=""></option>
                                              <option value="1">Class One</option>
                                              <option value="2">Class Two</option>
                                              <option value="3">Class Three</option>
                                          </select>
                                        </div>
                                      </div>
                                              
                                      <div class="form-group row">
                                        <label for="subject_id" class="col-md-3 form-control-label">Subject</label>
                                        <div class="col-md-9">
                                          <select class="form-control round" v-model="exam_type.subject_id" required>
                                            <option value=""></option>
                                            <option value="1">Mathematics</option>
                                            <option value="2">English</option>
                                            <option value="3">Economics</option>
                                        </select>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="no_of_questions" class="col-md-3 form-control-label">No of Questions</label>
                                        <div class="col-md-9">
                                          <input type="number" class="form-control round" v-model="exam_type.no_of_questions" required>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="duration" class="col-md-3 form-control-label">Duration in Minutes</label>
                                        <div class="col-md-9">
                                          <input type="text" class="form-control round" v-model="exam_type.duration" required>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label for="user_id" class="col-md-3 form-control-label">Test Coordinator</label>
                                        <div class="col-md-9">
                                          <select class="form-control round" v-model="exam_type.user_id" required>
                                            <option v-for="user in users" v-bind:key="user.id" v-bind:value="user.id">{{ user.firstname }} {{ user.lastname }}</option>
                                          </select>
                                        </div>
                                      </div>

                                        
                                     
                                      <div class="form-group row">
                                        <div class="col-md-3 offset-md-0">
                                          <button type="reset" class="btn btn-default btn-outline">Reset</button>
                                        </div>
                                        <div class="col-md-5 offset-md-0">

                                        </div>
                                        <div class="col-md-4 offset-md-0">
                                          <button type="submit" class="btn btn-primary pull-right">Create New Exam </button>
                                        </div>
                                      </div>




                                  </div>
                                </div>


                        </div>

		                </div>
		              </div>
		            </div>
		          </form>


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
      allExams: [],
      search: '',
      exam_types: [],
      users: [],
      exam_type: {
        id: "",
        test_name: "",
        session_id: "",
        class_id: "",
        subject_id: "",
        no_of_questions: "",
        duration: "",
        user_id: ""
      },
      examtype_id: "",
      pagination: {},
      edit: false
    }
  },

  created() 
  {
    this.fetchExams();
    this.fetchUsers();
    this.fetchAllExams();
  },


  computed: {

      filteredExams: function()
      {
          return this.exam_types.filter((exam_type) => {
              return exam_type.test_name.toLowerCase().match(this.search.toLowerCase())|| 
                     exam_type.duration.toLowerCase().match(this.search.toLowerCase())|| 
                     exam_type.user.firstname.toLowerCase().match(this.search.toLowerCase())|| 
                     exam_type.user.lastname.toLowerCase().match(this.search.toLowerCase())
          });
      }
  },


  methods: {

    fetchAllExams(page_url)
    {
        let vm = this;
        page_url = page_url || '/api/exam_types?all=1'
        fetch(page_url)
        .then(res => res.json())
        .then(res => {
            this.allExams = res.data;
        })
        .catch(err => console.log(err));
    },

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
            toastr.success("Exam Type Deleted");
            this.fetchExams();
            this.edit = false;
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
            toastr.success("ExamType Has Been Added");
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
            toastr.success("Exam Type Has Been Updated");
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
      this.exam_type.session_id = exam_type.session_id;
      this.exam_type.class_id = exam_type.class_id;
      this.exam_type.subject_id = exam_type.subject_id;
      this.exam_type.no_of_questions = exam_type.no_of_questions;
      this.exam_type.duration = exam_type.duration;
      this.exam_type.user_id = exam_type.user_id;
    },

    clearForm() 
    {
      this.exam_type.test_name = "";
      this.exam_type.session_id = "";
      this.exam_type.class_id = "";
      this.exam_type.subject_id = "";
      this.exam_type.no_of_questions = "";
      this.exam_type.duration = "";
      this.exam_type.user_id = "";
    },

    fetchUsers() 
    {
      let users = "/api/users";
      fetch(users)
        .then(res => res.json())
        .then(res => {
          this.users = res.data;
        })
    },

  }
};
</script>

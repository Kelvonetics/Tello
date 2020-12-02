<style>
  .control-label
  {
    font-weight: bolder;
  }
</style>

<template>

    <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

    <div class="row">
          <div class="col-xl-2 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px">Grading 

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
              <!-- <classExcelExport :data="allClasses" :file_name="'All Classes'"></classExcelExport>             -->

              <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-toggle="modal" data-target="#addGradingModal" 
              @click="clearGradeForm()"> <i class="icon wb-plus"> </i>
              </button>              
          </div>
      </div>

    

      <div class="panel" style="margin-top: -10px">
        <div class="row page-content">
          <div class="col-md-12">


            <!-- Example Basic -->
              <div class="example-wrap">
                <div class="page-header" style="padding: 0px 0px 1px 0px; margin-top: -20px">

                  <div class="example table-responsive">
                    <table class="table table-striped table-hover table-sm">
                      <thead class="thead-dark">
                        <tr>
                          <th>Test Name</th>
                          <th>Accademic Session</th>
                          <th>Grading Category</th>
                          <th>Percentage %</th>
                          <th>Description</th>
                          <th style="text-align:right">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="grading in filteredGradings" v-bind:key="grading.id">
                          <td>{{grading.exam.test_name}}</td>
                          <td>{{grading.session.session_name}}</td>
                          <td>{{grading.grade_name}}</td>
                          <td>{{grading.from}}  - {{grading.to}}</td>
                          <td>{{grading.description}}</td>
                          <td style="text-align:right">
                            <a class="pull-right" data-toggle="modal" data-target="#addGradingModal" @click="editGrading(grading)">
                              <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                            </a>
                            <a class="pull-right" @click="deleteGrading(grading.id)">
                              <span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span>
                            </a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    

                    <nav aria-label="Page navigation example pull-right">
                        <ul class="pagination pagination-sm">
                          <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchGrading(pagination.prev_page_url)">Prev</a></li>
                          <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                          <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchGrading(pagination.next_page_url)">Next</a></li>
                        </ul>
                    </nav>
                </div>



              <form @submit.prevent="addGrading">
                <div class="modal fade modal-just-me" id="addGradingModal">
                  <div class="modal-dialog">
                    <div class="modal-content" style="">
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">Add / Edit Grading </h4>
                        <button type="button" class="close" data-dismiss="modal">X</button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">
                        <div class="form-group row">
                          <label for="exam_id" class="col-md-3 control-label">Exam Name</label>
                          <div class="col-md-9">
                            <select class="form-control round" v-model="grading.exam_id" required>
                              <option value=""></option>
                              <option v-for="exam in tests" v-bind:key="exam.id" v-bind:value="exam.id">{{ exam.test_name }}</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="test_type" class="col-md-3 control-label">Session</label>
                            <div class="col-md-9">
                              <select class="form-control round" v-model="grading.session_id" required>
                                <option value=""></option>
                                <option v-for="session in sessiones" v-bind:key="session.id" v-bind:value="session.id">{{ session.session_name }}</option>
                              </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="grade_name" class="col-md-3 control-label">Grade Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control round" placeholder="" v-model="grading.grade_name" required>
                          </div>
                        </div>

                        <div class="form-group row">
                            <label for="timing" class="col-md-3 control-label">Percentage</label>
                            <div class="col-sm-9">
                              <div class="row"> 
                                  <div class="col-md-1">From</div>
                                  <div class="col-md-5"><input type="text" class="form-control round" v-model="grading.from" required></div>

                                  <div class="col-md-1">To</div>
                                  <div class="col-md-5"><input type="text" class="form-control round" v-model="grading.to" required></div> 
                              </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-3 control-label">Grade Description</label>
                            <div class="col-sm-9">
                              <textarea rows="3" class="form-control round" placeholder="" v-model="grading.description" required></textarea>
                            </div>
                        </div>
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="reset" class="btn btn-outline btn-warning btn-round" data-dismiss="modal">Reset</button>
                        <button type="submit" class="btn btn-dark btn-round">Create Grading </button>
                      </div>
                    </div>
                  </div>
                </div>
              </form> 

            </div>
          </div>
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
      allGradings: [],
      search: '',
      tests: [],
      sessiones: [], 
      gradings: [],
      grading: {
        id: "",
        exam_id: "",
        session_id: "",
        grade_name: "",
        from: "",
        to: "",
        description: ""
      },
      grading_id: "",
      pagination: {},
      edit: false
    }
  },


  created() 
  {
    this.fetchAllGradings();
    this.fetchGradings();
    this.fetchTest();
    this.fetchSessions();
  },

  computed: {
      filteredGradings: function()
      {
          return this.gradings.filter((grading) => {
              return grading.grade_name.toLowerCase().match(this.search.toLowerCase()) ||
                     grading.exam.test_name.toLowerCase().match(this.search.toLowerCase()) ||
                     grading.description.toLowerCase().match(this.search.toLowerCase()) ||
                     // grading.from.match(this.search) ||
                     // grading.to.match(this.search) ||
                     grading.session.session_name.toLowerCase().match(this.search.toLowerCase())
          });
      }

  },


  methods: {
    fetchAllGradings(page_url) 
    {
      let vm = this;
      page_url = page_url || "/api/gradings?all=1";
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.gradings = res.data;
          vm.makePagination(res.meta, res.links);
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

    deleteGrading(id) 
    {
      if (confirm("Are You Sure You Want To Delete This Grading Category?")) 
      {
        fetch(`api/grading/${id}`, {
          method: "delete"
        })
          .then(res => res.json())
          .then(data => {
            toastr.success('Grading Category Has Been Deleted Successfully');
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
            toastr.success('Grading Category Has Been Created Successfully');
            this.fetchGradings();
            this.edit = false;
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
            toastr.success('Grading Category Has Been Updated Successfully');
            this.fetchGradings();
            this.edit = false;
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
      this.grading.session_id = grading.session_id;
      this.grading.grade_name = grading.grade_name;
      this.grading.from = grading.from;
      this.grading.to = grading.to;
      this.grading.description = grading.description;
    },

    clearGradeForm() 
    {
      this.grading.test_name = "";
      this.grading.session_id = "";
      this.grading.grade_name = "";
      this.grading.from = "";
      this.grading.to = "";
      this.grading.description = "";
    },




    fetchTest() 
    {
      let tests = "/api/exam_types";
      fetch(tests)
        .then(res => res.json())
        .then(res => {
          this.tests = res.data;
        })
        .catch(err => console.log(err));
    },


    fetchSessions()
    {
        let sessiones = '/api/sessiones'
        fetch(sessiones)
        .then(res => res.json())
        .then(res => {
            this.sessiones = res;
        })
        .catch(err => console.log(err));            
    }
  }
};
</script>

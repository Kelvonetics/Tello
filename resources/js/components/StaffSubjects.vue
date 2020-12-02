

<template>
 <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

    <div class="row">
          <div class="col-xl-3 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px">Staff Subjects 

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
          <div class="col-xl-6 col-md-2 col-sm-3" style="text-align: right; padding-bottom: 0px"> 
              <classExcelExport :data="allClasses" :file_name="'All Classes'"></classExcelExport>            

              <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addStaffSubjectModal" data-toggle="modal" 
                      data-original-title="Add New Staff Subject" @click="clearForm()">  <i class="icon wb-plus" aria-hidden="true"></i>
              </button>              
          </div>
      </div>

    

      <div class="panel" style="margin-top: -10px">
        <div class="row page-content">
          <div class="col-md-12">


            <!-- Example Basic -->
              <div class="example-wrap">
                <div class="page-header" style="padding: 0px 0px 1px 0px; margin-top: -20px">




                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead class="thead-dark">
                              <tr>
                                <th>Staff ID</th>
                                <th>Subject</th>
                                <th>Class</th>
                                <th>Session</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody v-for="staff_subject in filteredStaffSubjects" v-bind:key="staff_subject.id">
                              <tr style="background: #fff">
                                <td>{{staff_subject.staff_no}}</td>
                                <td>{{staff_subject.subject_id}}</td>
                                <td>{{staff_subject.class_id}}</td>
                                <td>{{staff_subject.session_id}}</td>
                                <td>
                                    <a class="pull-right" @click="editStaffSubject(staff_subject)" data-toggle="modal" data-target="#addStaffSubjectModal"> 
                                        <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                                    </a>
                                    <a class="pull-right" @click="deleteStaffSubject(staff_subject.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span>
                                    </a>
                                </td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                    

                    <nav aria-label="Page navigation example pull-right">
                        <ul class="pagination pagination-sm">
                          <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchStaffSubjects(pagination.prev_page_url)">Prev</a></li>
                          <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                          <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchStaffSubjects(pagination.next_page_url)">Next</a></li>
                        </ul>
                    </nav>
                  </div>
              </div>




            <!-- Modal -->
            <div class="modal fade" id="addStaffSubjectModal" aria-hidden="true" aria-labelledby="examplePositionSidebar"
              role="dialog" tabindex="-1">
              <div class="modal-dialog modal-simple modal-sidebar" style="margin-top: -60px !important; height:100% !important">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Modal Title</h4>
                  </div>
                  <div class="modal-body">
                    <p>One fine body…</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-block">Save changes</button>
                    <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Modal -->


            <!-- STAFF SUBJECT MODAL  -->
            <form @submit.prevent="addStaffSubject" class="form-horizontal">
                <div class="modal modal-lg fade" id="" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1" style="margin-top: 36px">
                  <div class="modal-dialog modal-sidebar modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">&times;</span>  </button>
                        <h4 class="modal-title">New Subject</h4>
                      </div>

                      <div class="modal-body">



                             <div class="example-wrap">
                                  <div class="example">

                                <div class="form-group row">
                                  <label class="col-md-3 form-control-label">Subject </label>
                                  <div class="col-md-9">
                                    <!-- <input type="text" class="form-control round" autocomplete="off" v-model="staff_subject.staff_no"/> -->
                                    <select class="form-control round" v-model="staff_subject.subject_id" required>
                                      <option value=""></option>
                                      <option value="1">Mathematics</option>
                                      <option value="2">English</option>
                                      <option value="3">Economics</option>
                                    </select>
                                  </div>
                                </div>          
                                  
                                <div class="form-group row">
                                  <label class="col-md-3 form-control-label">Class </label>
                                  <div class="col-md-9">
                                    <select class="form-control round" v-model="staff_subject.class_id" required>
                                      <option value=""></option>
                                      <option value="1">Class One</option>
                                      <option value="2">Class Two</option>
                                      <option value="3">Class Three</option>
                                    </select>
                                  </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="test_type" class="col-md-3 form-control-label">Session</label>
                                  <div class="col-md-9">
                                    <select class="form-control round" v-model="staff_subject.session_id" required>
                                      <option value=""></option>
                                      <option value="1">Session 2018 - 2019</option>
                                      <option value="2">Session 2019 - 2020</option>
                                      <option value="3">Session 2020 - 2021</option>
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
                                    <button type="submit" class="btn btn-primary pull-right">Create Staff Subject </button>
                                  </div>
                                </div>




                                  </div>
                                </div>








                            

                        </div>

                      <div class="modal-footer">
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
</template>











<script>


    export default
    {

        data()
        {
            return{
                allStaffSubjects: [],
                search: '',
                staff_subjects: [], 
                staff_subject: {
                    id: '',
                    staff_no: '',
                    subject_id: '',
                    class_id: '',
                    session_id: ''
                },               
                staff_subject_id: '',
                pagination: {},
                avatar: null,
                edit: false,
                dataNull:false
            }
        },


        created()
        {
            this.staff_no = this.$route.params.id;
            this.fetchSubjectObject();
            this.fetchStaffSubjects();
            this.fetchAllStaffSubjects();
            this.fetchStaffDetails();
        },

        computed: {
            filteredStaffSubjects: function()
            {
                return this.staff_subjects.filter((staff_subject) => {
                    return staff_subject.staff_no.toLowerCase().match(this.search.toLowerCase())
                });
            }
        },

        methods: 
        {
            getImage(e)
            {
                let image = e.target.files[0];
                let reader = new FileReader();    
                reader.readAsDataURL(image);
                reader.onload = e =>{
                    // console.log(e);
                    this.avatar = e.target.result;
                    this.user.photo = e.target.result;
                }

            },


            fetchAllStaffSubjects(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/staff_subjects?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allStaffSubjects = res.data;
                    // vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
            },


            fetchStaffSubjects(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/staff_subjects/' + this.$route.params.id
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.staff_subjects = res.data;
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

            deleteStaffSubject(id)
            {
                if(confirm('Are You Sure You Want To Delete This Staff Subject ?'))
                {
                    fetch(`api/staff_subject/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert('The Staff Subject Has Been Deleted');
                        this.fetchStaffSubjects();
                        this.edit = false;
                    })
                    .catch(err => console.log(err));
                }
            },

            fetchSubjectObject()
            {
                //'Subject-exam-id/{id}',
                
                fetch('/api/staff-subject-by-id/' + this.$route.params.id,{
                    method:'GET'
                }).then(res=>res.json())
                .then(res=>{
                    if (res.data){
                      this.staff_subject = res.data;
                    }else{
                       this.dataNull = true;
                    }
                    // alert('fetched... ');
                });
            },


            addStaffSubject()
            {
                if(this.edit === false)
                {
                  this.staff_subject.staff_no = this.$route.params.id;
                    fetch('api/staff_subject', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.staff_subject),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm()
                        alert('Staff Subject Has Been created Successfully');
                        this.fetchStaffSubjects();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addStaffSubjectModal').trigger('click');

                }
                else
                {
                    fetch('/api/staff_subject/' + this.staff_subject.id, 
                    {
                        method: 'put',
                        body: JSON.stringify(this.staff_subject),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        alert('Staff subject Has Been Updated');
                        this.fetchStaffSubjects();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                    $('#addStaffSubjectModal').trigger('click');
                    // location.reload();
                }
            },

            editStaffSubject(staff_subject)
            {
                this.edit = true;
                this.staff_subject.id = staff_subject.id;
                this.staff_subject.staff_subject_id = staff_subject.id;
                this.staff_subject.staff_no = staff_subject.staff_no;
                this.staff_subject.subject_id = staff_subject.subject_id;
                this.staff_subject.class_id = staff_subject.class_id;
                this.staff_subject,session_id = staff_subject.session_id;
            },



            clearForm()
            {
                this.staff_subject.staff_no = '';
                this.staff_subject.subject_id = '';
                this.staff_subject.class_id = '';
                this.staff_subject.session_id = '';
            },

            fetchStaffDetails()
            {
                // let staff_detail = '/api/staff-details-by-id/' + this.$route.params.id
                fetch('/api/staff-details-by-id/' + this.$route.params.id)
                .then(res => res.json())
                .then(res => {
                    this.staff_detail = JSON.stringify(res);
                    console.log(JSON.stringify(res));                    
                })
                .catch(err => console.log(err)); 
            }


        }
    };
</script>

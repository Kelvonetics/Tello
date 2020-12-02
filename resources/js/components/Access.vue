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

        .span
        {
          margin-right: 20px;
          margin-bottom: 15px !important;
        }

</style>

<template>
  <div class="row" style="margin-top: -15px">
    <div class="col-md-12">

        <div class="">
            <div class="row">
                <div class="col-md-11">
                  <h3 style="padding: ">Setup Access For Test  {{ $route.params.id }} </h3>
                </div>
                <div class="col-md-1">
                  
                </div>
            </div>

            <div class="row" style="padding: 10px 15px">

                <div class="col-md-5" style="border: thin dotted #e1e1e1">
              
              <form @submit.prevent="addAccess">

                  <br>      <h4>Accessibility</h4>      <hr>

                  <div class="row">
                      <div class="col-md-6" style="padding: 5px 0px">
                        <label for="answer" class="col-md-12 control-label">Who Can Access Test</label>
                        <div class="col-md-12">
                            <select class="form-control" v-model="access.who_can_access" required>>
                                <option value="1">A Predefined Group of Users</option>
                                <option value="2">Any One With The Link</option>
                            </select>
                        </div>                
                      </div>
   
                      <div class="col-md-6" style="padding: 5px 0px">
                        <label for="answer" class="col-md-12 control-label">Date For Test</label>
                          <div class="col-md-12">
                              <input type="date" class="form-control" v-model="access.exam_date">
                          </div>                 
                      </div>
                  </div>

                  <br>    <h4>Exam Code</h4>     <hr>


                  <div class="row">
                    <label for="answer" class="col-md-12 control-label">Use Test Code</label>
                    <div class="col-md-6">
                      <label>
                        <input type="radio" class="radio" name="test_code" id="yes" value="Yes" v-model="access.exam_code"> 
                        <div class="span"> Yes </div>
                        <input type="radio" class="radio" name="test_code" id="no" value="No" v-model="access.exam_code"> 
                        <div class="span"> No </div>
                      </label>
                    </div>
                    <div class="col-md-6">  
                    </div>
                  </div>


                  <h4>Notification</h4>    <hr>


                  <div class="row">
                    <div class="col-md-6" style="padding: 5px 0px">
                    <label for="answer" class="col-md-12 control-label">Who To Send Notification</label>
                      <div class="col-md-12" style="">
                        <label>
                          <input type="checkbox" class="radio" name="" id="candidate" value="1" v-model="access.notify_who"> 
                          <span class="span"> Candidates </span>
                          <input type="checkbox" class="radio" name="" id="admin" value="2" v-model="access.notify_who"> 
                          <span class="span">Admin/Test Coodinator </span>
                        </label>  
                          <input type="hidden" class="form-control" name="notify_who" id="n_who">               
                      </div>
                    </div>

                    <div class="col-md-6" style="padding: 5px 0px">
                    <label for="answer" class="col-md-12 control-label">When To Send Notification</label>
                      <div class="col-md-12" style="">
                        <label>
                          <input type="checkbox" class="radio" name="" id="before" value="1" v-model="access.when_to_notify"> 
                          <span class="span"> Before Exam </span>
                          <input type="checkbox" class="radio" name="" id="after" value="2" v-model="access.when_to_notify"> 
                          <span class="span"> After Exam </span>
                        </label>
                          <input type="hidden" class="form-control" name="when_to_notify" id="n_when"> 
                      </div>                
                    </div>
                  </div>

                    <button type="reset" class="btn btn-default btn-sm" data-dismiss="modal">Clear</button>
                    <button type="submit" class="btn btn-success btn-sm">Save</button>

                  </form>


                </div>


                <div class="col-md-7" style="border: thin dotted #e1e1e1">
                  <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-10"><h2 style="">Users</h2></div>
                        <div class="col-md-2">                            
                            <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addUserModal" @click="clearForm()">Add</button>

                            <user_exam_upload @done-uploading="fetchUsersByExamId" :api_url="'http://localhost:8000/user-exam-upload'" id="id1"></user_exam_upload>
                        </div>
                    </div>


                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-sm">
                          <thead class="thead-dark">
                            <tr>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Gender</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody v-for="exam_user in exam_users" v-bind:key="exam_user.id">
                            <tr style="background: #fff">
                              <td>{{exam_user.firstname}}</td>
                              <td>{{exam_user.lastname}}</td>
                              <td>{{exam_user.email}}</td>
                              <td>{{exam_user.phone}}</td>
                              <td>{{exam_user.gender}}</td>
                              <td>  
                                <a class="pull-right" data-toggle="modal" data-target="#addUserModal" 
                                    @click="editUser(exam_user)"><span class="fa fa-pen text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                                </a>
                                  <a class="pull-right" data-toggle="modal" data-target="#"> <span class="fa fa-ban text-inverse m-r-10" style="margin :1px 2px; color: red; cursor: pointer;"></span>
                                  </a>
                                <a class="pull-right" @click="deleteUser(exam_user.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span>
                                </a>
                              </td>
                            </tr>
                          </tbody>
                      </table>  
                    </div>          

                    <nav aria-label="Page navigation example pull-right">
                        <ul class="pagination pagination-sm">
                          <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchUsersByExamId(pagination.prev_page_url)">Prev</a></li>
                          <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                          <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchUsersByExamId(pagination.next_page_url)">Next</a></li>
                        </ul>
                    </nav>





                    

                    <!-- Modal -->
                    <form @submit.prevent="addUser">
                        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" style="">
                            <div class="modal-dialog" role="document" style="">
                                    <div class="modal-content" style="">

                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Add User   </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-md-3 control-label">FirstName</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="firstname" v-model="exam_user.firstname" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 control-label">LastName</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="lastname" v-model="exam_user.lastname" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 control-label">Email</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="email" v-model="exam_user.email" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 control-label">Password</label>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" placeholder="password" v-model="exam_user.password" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 control-label">Phone</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="phone" v-model="exam_user.phone" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 control-label">Address</label>
                                            <div class="col-md-9">
                                                <textarea type="text" class="form-control" placeholder="address" v-model="exam_user.address" required></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 control-label">Date Of Birth</label>
                                            <div class="col-md-9">
                                                <input type="date" class="form-control" placeholder="dob" v-model="exam_user.dob" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 control-label">Gender</label>
                                            <div class="col-md-9">
                                                <select class="form-control" v-model="exam_user.gender"  required>
                                                    <option value=""></option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 control-label">M - Status</label>
                                            <div class="col-md-9">
                                                <select class="form-control" v-model="exam_user.marital_status"  required>
                                                    <option value=""></option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 control-label">State of Origin</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="State" v-model="exam_user.state_id" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 control-label">Nationality</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" placeholder="Nationality" v-model="exam_user.nationality" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 control-label">Photo</label>
                                            <div class="col-md-9">
                                                <input type="file" class="form-control" placeholder="Photo">
                                            </div>
                                        </div>
                        
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success btn-sm">Save</button>
                                        </div>

                                    </div>
                                </div><!-- modal-content -->
                            </div><!-- modal-dialog -->
                        </div><!-- modal -->
                    </form>
                    

                  </div>
                </div>
                    
            </div>
        </div>
    </div>
  </div>
</template>











<script>
  $(function()
  {
    console.log($("#exam_ids").val());

      $("#candidate").change(function() 
        {
            $('#n_who').val('1'); 
        });

        $("#admin").change(function() 
        {
            $('#n_who').val('2');
        });


      $("#before").change(function() 
        {
            $('#n_when').val('1'); 
        });

        $("#after").change(function() 
        {
            $('#n_when').val('2');
        });
  });



    export default
    {

        data()
        {
            return{
                accessObj:null,
                accesses: [], 
                access: {
                    id: '',
                    exam_id: '',
                    who_can_access: '',
                    exam_date: '',
                    exam_code: '',
                    notify_who: '',
                    when_to_notify: ''
                },
                exam_users: [], 
                exam_user: {
                    id: '',
                    exam_id: '',
                    firstname: '',
                    lastname: '',
                    email: '',
                    password: '',
                    phone: '',
                    address: '',
                    dob: '',
                    gender: '',
                    marital_status: '',
                    state_id: '',
                    nationality: '',
                    photo: '',
                    code: ''
                },
                access_id: '',
                exam_user_id: '',
                pagination: {},
                edit: false
            }
        },


        created()
        {
            this.exam_id = this.$route.params.id;
            this.fetchAccesses();
            // this.fetchUsers();
            this.fetchUsersByExamId();
            // this.loadExam();
            this.fetchAccessObject();

        },

        methods: 
        {

            fetchAccessObject()
            {
                //'access-exam-id/{id}',
                
                fetch('/api/access-exam-id/' + this.$route.params.id,{
                    method:'GET'
                }).then(res=>res.json())
                .then(res=>{
                    this.access = res.data;
                    // alert('fetched... ');
                });
            },

            fetchUsersByExamId(page_url)
            {
                //http://localhost:8000/api/exam-users-by-id/11
                let vm = this;
                page_url = page_url || 'api/exam-users-by-id/' + this.$route.params.id;
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.exam_users = res.data;
                    console.log(this.exam_users);
                    vm.makePagination(res.meta, res.links);
                    // alert('called.');
                })
                .catch(err => console.log(err));
            },


            fetchAccesses(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/accesses'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.accesses = res.data;
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

            deleteAccess(id)
            {
                if(confirm('Are You Sure You Want To Delete This Exam Access Details?'))
                {
                    fetch(`api/access/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert('The Access Record Has Been Deleted');
                        this.fetchAccesses();
                    })
                    .catch(err => console.log(err));
                }
            },

            addAccess()
            {

              this.edit = false;
              if (this.access){
                this.edit = true;
              }
              console.log(this.edit,this.access);
                if(this.edit === false)
                {
                  this.access.exam_id = this.$route.params.id;
                    fetch('api/access', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.access),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm()
                        alert('Access Has Been created Successfully');
                        this.fetchAccesses();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 

                }
                else
                {
                  this.access.exam_id = this.$route.params.id;
                    fetch('/api/access/' + this.access.id, 
                    {
                        method: 'put',
                        body: JSON.stringify(this.access),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        alert('Access Has Been Updated');
                        this.fetchUsersByExamId();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                }
            },

            editAccess(access)
            {
                this.edit = true;
                this.access.id = access.id;
                this.access.access_id = access.id;
                this.access.exam_id = access.exam_id;
                this.access.who_can_access = access.who_can_access;
                this.access.exam_date = access.exam_date;
                this.access.exam_code = access.exam_code;
                this.access.notify_who = access.notify_who;
                this.access.when_to_notify = access.when_to_notify;
            },



            clearForm()
            {
                this.access.exam_id = '';
                this.access.who_can_access = '';
                this.access.exam_date = '';
                this.access.exam_code = '';
                this.access.notify_who = '';
                this.access.when_to_notify = '';
            },




            deleteUser(id)
            {
                if(confirm('Are You Sure You Want To Delete This User Details?'))
                {
                    fetch(`api/exam_user/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        alert('The User Record Has Been Deleted');
                        this.fetchUsersByExamId();
                    })
                    .catch(err => console.log(err));
                }
            },

            addUser()
            {
                if(this.edit === false)
                {

                  this.exam_user.exam_id = this.$route.params.id;
                    fetch('api/exam_user', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.exam_user),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm()
                        alert('User Has Been created Successfully');
                        this.fetchUsersByExamId();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addUserModal').trigger('click');

                }
                else
                {

                  this.exam_user.exam_id = this.$route.params.id;
                    fetch('api/exam_user', 
                    {
                        method: 'put',
                        body: JSON.stringify(this.exam_user),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        alert('User Has Been Updated');
                        this.fetchUsersByExamId();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                    $('#addUserModal').trigger('click');
                }
            },

            editUser(exam_user)
            {
                this.edit = true;
                this.exam_user.id = exam_user.id;
                this.exam_user.exam_user_id = exam_user.id;
                this.exam_user.exam_id = exam_user.exam_id;
                this.exam_user.firstname = exam_user.firstname;
                this.exam_user.lastname = exam_user.lastname;
                this.exam_user.email = exam_user.email;
                this.exam_user.password = exam_user.password;
                this.exam_user.phone = exam_user.phone;
                this.exam_user.address = exam_user.address;
                this.exam_user.dob = exam_user.dob;
                this.exam_user.gender = exam_user.gender;
                this.exam_user.marital_status = exam_user.marital_status;
                this.exam_user.state_id = exam_user.state_id;
                this.exam_user.nationality = exam_user.nationality;
                this.exam_user.photo = exam_user.photo;
            },



            clearForm()
            {
                this.exam_user.firstname = '';
                this.exam_user.lastname = '';
                this.exam_user.email = '';
                this.exam_user.password = '';
                this.exam_user.phone = '';
                this.exam_user.address = '';
                this.exam_user.dob = '';
                this.exam_user.gender = '';
                this.exam_user.marital_status = '';
                this.exam_user.state_id = '';
                this.exam_user.nationality = '';
                this.exam_user.photo = '';
            }

        }
    };
</script>

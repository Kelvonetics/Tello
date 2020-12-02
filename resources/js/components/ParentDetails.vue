
<template>
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

      <div class="" style="margin-top: -10px; padding: 0px 15px">

            <div class="row">
              <div class="col-md-7 panel" style="border-radius:5px; border:thin dotted #eee">
                  <h3 style="padding: "> Parent / Guardian  </h3>

                  <div class="table-responsive">
                      <table class="table table-striped table-hover table-sm">
                          <thead class="thead-dark">
                            <tr>
                              <th>Title</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Relationship</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <!-- <tbody v-for="student in filteredStudents" v-bind:key="student.id">
                            <tr style="background: #fff">
                              <td>{{student.registration_no}}</td>
                              <td>{{student.firstname}}</td>
                              <td>{{student.lastname}}</td>
                              <td>{{student.email}}</td>
                              <td>{{student.phone}}</td>
                              <td>{{student.gender}}</td>
                              <td>
                                  <a class="pull-right" data-toggle="modal" data-target="#addStudentModal" @click="editStudent(student)"> 
                                      <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                                  </a>
                                  <a class="pull-right" data-toggle="tooltip" title="Add Parent Details"> 
                                    <router-link class="" v-bind:to="'/parentDetails/' + student.registration_no" style="">
                                      <span class="fa fa-female text-inverse m-r-10" style="margin :1px 2px; color: ##3490dc; cursor: pointer;"></span>
                                    </router-link>
                                  </a>
                                  <a class="pull-right" @click="deleteStudent(student.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span>
                                  </a>
                              </td>
                            </tr>
                          </tbody> -->
                      </table>

                    <!-- <nav aria-label="Page navigation example pull-right">
                        <ul class="pagination pagination-sm">
                          <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchStudents(pagination.prev_page_url)">Prev</a></li>
                          <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                          <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchStudents(pagination.next_page_url)">Next</a></li>
                        </ul>
                    </nav> -->
                  </div>
              </div>


                
              <div class="col-md-5 panel" style="border-radius:5px; border:thin dotted #eee">                
                  <h3 style="padding: "> Parent Details</h3>

                  <form @submit.prevent="addStudentParent" class="form-horizontal">

                      <div class="example-wrap">
                            <div class="example">  
                                  
                                <div class="form-group row">
                                  <label class="col-md-3 form-control-label">Title </label>
                                  <div class="col-md-9">
                                    <!-- <input type="text" class="form-control round" autocomplete="off" v-model="parent_detail.registration_no"/> -->
                                    <select class="form-control round" v-model="parent_detail.title" required>
                                      <option value=""></option>
                                      <option value="Mr">Mr</option>
                                      <option value="Mrs">Mrs</option>
                                      <option value="Dr">Dr</option>
                                    </select>
                                  </div>
                                </div>                                          

                                <div class="form-group row">
                                  <label class="col-md-3 form-control-label">Firstname </label>
                                  <div class="col-md-9">
                                    <input type="text" class="form-control round" autocomplete="off" v-model="parent_detail.firstname" required/>
                                  </div>
                                </div>
                                  
                                <div class="form-group row">
                                  <label class="col-md-3 form-control-label">Lastname </label>
                                  <div class="col-md-9">
                                    <input type="text" class="form-control round" autocomplete="off" v-model="parent_detail.lastname" required/>
                                  </div>
                                </div>
                                  
                                <div class="form-group row">
                                  <label class="col-md-3 form-control-label">Email </label>
                                  <div class="col-md-9">
                                    <input type="email" class="form-control round" autocomplete="off" v-model="parent_detail.email" required/>
                                  </div>
                                </div>
                                  
                                <div class="form-group row">
                                  <label class="col-md-3 form-control-label">Phone </label>
                                  <div class="col-md-9">
                                    <input type="text" class="form-control round" autocomplete="off" v-model="parent_detail.phone" required/>
                                  </div>
                                </div>
                                  
                                <div class="form-group row">
                                  <label class="col-md-3 form-control-label">Relationship </label>
                                  <div class="col-md-9">
                                    <select class="form-control round" v-model="parent_detail.relationship" required>
                                      <option value=""></option>
                                      <option value="1">Father</option>
                                      <option value="2">Mother</option>
                                      <option value="3">Guardian</option>
                                    </select>
                                  </div>
                                </div> 

                                <div class="form-group row">
                                  <div class="col-md-6 offset-md-0" style="text-align:left">
                                    <button type="reset" class="btn btn-default btn-outline">Clear</button>
                                  </div>
                                  
                                  <div class="col-md-6 offset-md-0" style="text-align:right">
                                    <button type="submit" class="btn btn-dark btn-round">Create Parent Details </button>
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
                parent_details: [], 
                parent_detail: {
                    id: '',
                    registration_no: '',
                    title: '',
                    firstname: '',
                    lastname: '',
                    email: '',
                    phone: '',
                    relationship: ''
                },                
                parent_detail_id: '',
                pagination: {},
                edit: false,
                dataNull:false
            }
        },


        created()
        {
            this.registration_no = this.$route.params.id;
            this.fetchParentObject();
        },

        methods: 
        {

            fetchParentObject()
            {
                //'Parent-exam-id/{id}',
                
                fetch('/api/student-parent-by-id/' + this.$route.params.id,{
                    method:'GET'
                }).then(res=>res.json())
                .then(res=>{
                    // console.log(res);
                    if (res.data)
                    {
                      this.parent_detail = res.data;
                    }else{
                       this.dataNull = true;
                    }
                    // alert('fetched... ');
                });
            },


            addStudentParent()
            {
              this.edit = false;
             
              if (this.parent_detail)
              {
                this.edit = true;
              }

                if(this.edit === false || this.dataNull)
                {
                  this.parent_detail.registration_no = this.$route.params.id;
                    fetch('api/parent_detail', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.parent_detail),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm()
                        alert('Student Parent Has Been created Successfully');
                        this.dataNull = false;
                    })
                    .catch(err => console.log(err)); 

                }
                else
                {
                  this.parent_detail.registration_no = this.$route.params.id;
                    fetch('/api/parent_detail/' + this.parent_detail.id, 
                    {
                        method: 'put',
                        body: JSON.stringify(this.parent_detail),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        // this.clearForm();
                        alert('Student Parent Has Been Updated');
                        fetchParentObject();
                        // this.fetchParentByStudentId();
                    }) 
                    .catch(err => console.log(err));
                }
            },

            editStudentParent(parent_detail)
            {
                this.edit = true;
                this.parent_detail.id = parent_detail.id;
                this.parent_detail.parent_detail_id = parent_detail.id;
                this.parent_detail.registration_no = parent_detail.registration_no;
                this.parent_detail.title = parent_detail.title;
                this.parent_detail.firstname = parent_detail.firstname;
                this.parent_detail.lastname = parent_detail.lastname;
                this.parent_detail.email = parent_detail.email;
                this.parent_detail.phone = parent_detail.phone;
                this.parent_detail.relationship = parent_detail.relationship;
            },



            clearForm()
            {
                this.parent_detail.registration_no = '';
                this.parent_detail.title = '';
                this.parent_detail.firstname = '';
                this.parent_detail.lastname = '';
                this.parent_detail.email = '';
                this.parent_detail.phone = '';
                this.parent_detail.relationship = '';
            },



        }
    };
</script>

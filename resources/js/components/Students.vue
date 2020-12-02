
<template>

  <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

    <div class="row">
            <div class="col-xl-2 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px"> Students 

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
                <studentExcelExport :data="allStudents" :file_name="'All Students'"></studentExcelExport> 

                <student_upload @done-uploading="fetchStudents" :api_url="'http://localhost:8000/student-upload'" id="id1"></student_upload>           

                <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addStudentModal" data-toggle="modal" 
                        data-original-title="Add New Student" @click="clearStudentForm()">    <i class="icon wb-plus" aria-hidden="true"></i>
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
                              <th>Reg No</th>
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Gender</th>
                              <th>Class</th>
                              <th>Dtae Of Birth</th>
                              <th>Session</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody v-for="student in filteredStudents" v-bind:key="student.id">
                            <tr style="background: #fff">
                              <td>{{student.registration_no}}</td>
                              <td>{{student.firstname}}</td>
                              <td>{{student.lastname}}</td>
                              <td>{{student.email}}</td>
                              <td>{{student.phone}}</td>
                              <td>{{student.gender}}</td>
                              <td>{{student.classed.class_name}}</td>
                              <td>{{student.dob}}</td>
                              <td>{{student.session.session_name}}</td>
                              <td>
                                  <a class="pull-right" data-toggle="modal" data-target="#addStudentModal" @click="editStudent(student)"> 
                                      <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                                  </a>
                                  <a class="pull-right" data-toggle="tooltip" title="Add Parent Details"> 
                                    <router-link class="" v-bind:to="'/parentDetails/' + student.registration_no" style="">
                                      <span class="fa fa-female text-inverse m-r-10" style="margin :1px 2px; color: #3490dc; cursor: pointer;"></span>
                                    </router-link>
                                  </a>
                                  <a class="pull-right" @click="deleteStudent(student.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span>
                                  </a>
                              </td>
                            </tr>
                          </tbody>
                      </table>

                    <nav aria-label="Page navigation example pull-right">
                        <ul class="pagination pagination-sm">
                          <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchStudents(pagination.prev_page_url)">Prev</a></li>
                          <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                          <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchStudents(pagination.next_page_url)">Next</a></li>
                        </ul>
                    </nav>
                  </div>
                  






                <!-- Modal -->
                <form @submit.prevent="addStudent" class="form-horizontal">
                    <div class="modal fade modal-just-me" id="addStudentModal" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" style="">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"close_x>X</span>
                      </button>
                                <h4 class="modal-title">New Student</h4>
                              </div>

                              <div class="modal-body">



                                     <div class="example-wrap">
                                          <div class="example">                                            

                                              <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Firstname </label>
                                                <div class="col-md-9">
                                                  <input type="text" class="form-control round" autocomplete="off" v-model="student.firstname" required/>
                                                </div>
                                              </div>
                                                
                                              <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Midname </label>
                                                <div class="col-md-9">
                                                  <input type="text" class="form-control round" autocomplete="off" v-model="student.midname"/>
                                                </div>
                                              </div>
                                                
                                              <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Lastname </label>
                                                <div class="col-md-9">
                                                  <input type="text" class="form-control round" autocomplete="off" v-model="student.lastname" required/>
                                                </div>
                                              </div>
                                                
                                              <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Email </label>
                                                <div class="col-md-9">
                                                  <input type="email" class="form-control round" autocomplete="off" v-model="student.email" required/>
                                                </div>
                                              </div>
                                                
                                              <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Password </label>
                                                <div class="col-md-9">
                                                  <input type="password" class="form-control round" autocomplete="off" v-model="student.password" required/>
                                                </div>
                                              </div>
                                                
                                              <div class="form-group row">
                                                  <label for="class_id" class="col-md-3 control-label">Class</label>
                                                <div class="col-md-9">
                                                  <select class="form-control round" v-model="student.class_id" required>
                                                    <option value=""></option>
                                                    <option v-for="classs in classed" v-bind:value="classs.id" v-bind:key="classs.id"> {{ classs.class_name }} </option>
                                                  </select>
                                                </div>
                                              </div>
                                                
                                              <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Phone </label>
                                                <div class="col-md-9">
                                                  <input type="text" class="form-control round" autocomplete="off" v-model="student.phone" required/>
                                                </div>
                                              </div>

                                              <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Address </label>
                                                <div class="col-md-9">
                                                  <textarea class="form-control round" autocomplete="off" v-model="student.address" required></textarea>
                                                </div>
                                              </div>
                                                
                                              <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Date Of Birth </label>
                                                <div class="col-md-9">
                                                  <input type="date" class="form-control round" autocomplete="off" v-model="student.dob" required/>
                                                </div>
                                              </div>

                                              <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Your Gender </label>
                                                <div class="col-md-9">
                                                  <div class="radio-custom radio-default radio-inline">
                                                    <input type="radio" id="inputHorizontalMale" name="" v-model="student.gender" v-bind:value="m" />     <label for="inputHorizontalMale">Male</label>
                                                  </div>
                                                  <div class="radio-custom radio-default radio-inline">
                                                    <input type="radio" id="inputHorizontalFemale" name="" v-model="student.gender" v-bind:value="f" />   <label for="inputHorizontalFemale">Female</label>
                                                  </div>
                                                </div>
                                              </div>
                                                
                                              <div class="form-group row">
                                                <label class="col-md-3 form-control-label">State </label>
                                                <div class="col-md-9">
                                                  <select class="form-control round" v-model="student.state_id" required>
                                                    <option value=""></option>
                                                    <option v-for="state in states" v-bind:value="state.id" v-bind:key="state.id">   {{ state.state_name }} </option>
                                                </select>
                                                </div>
                                              </div>
                                                
                                              <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Nationality </label>
                                                <div class="col-md-9">
                                                  <input type="text" class="form-control round" autocomplete="off" v-model="student.nationality" required/>
                                                </div>
                                              </div>
                                                
                                              <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Category </label>
                                                <div class="col-md-9">
                                                  <select class="form-control round" v-model="student.category_id" required>
                                                    <option value=""></option>
                                                    <option value="1">Day Student</option>
                                                    <option value="2">Boarding Student</option>
                                                </select>
                                                </div>
                                              </div>
                                                
                                              <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Session </label>
                                                <div class="col-md-9">
                                                  <select class="form-control round" v-model="student.session_id" required>
                                                    <option v-for="session in sessiones" v-bind:key="session.id" v-bind:value="session.id">{{ session.session_name }} </option>
                                                  </select>
                                                </div>
                                              </div>
                                                
                                              <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Photo </label>
                                                <div class="col-md-9">
                                                  <input type="file" class="form-control round" name="photo" placeholder="Photo" autocomplete="off" multiple="" @change="getImage" />
                                                </div>
                                              </div>
                                                
                                              <div class="form-group row">
                                                <label class="col-md-3 form-control-label">Preview </label>
                                                <div class="col-md-9">
                                                  <img :src="avatar" alt="Preview" style="max-width: 200px; max-height: 100px">
                                                </div>
                                              </div>

                                              <div class="form-group row">
                                                <div class="col-md-6 offset-md-0" style="text-align:left">
                                                  <button type="reset" class="btn btn-outline btn-warning btn-round">Clear</button>
                                                </div>

                                                <div class="col-md-6 offset-md-0" style="text-align:right">
                                                  <button type="submit" class="btn btn-dark pull-right">Create New Student </button>
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
                    <!-- End Modal -->
                  </div>
                </div>
                
                </div>  
       </div>

     </div>
   </div>
 </div>


</template>












<script>

   import jsPDF from 'jspdf';
   // eslint-disable-next-line
   import autoTable from 'jspdf-autotable';


    export default
    {
        data()
        {
            return{
                allStudents: [],
                search: '',
                states: [],
                classed: [],
                sessions: [],
                students: [], 
                student: {
                    id: '',
                    registration_no: 'STUD-2019-1234',
                    firstname: '',
                    midname: '',
                    lastname: '',
                    email: '',
                    password: '',
                    class_id: '',
                    phone: '',
                    address: '',
                    gender: '',
                    dob: '',
                    state_id: '',
                    nationality: '',
                    category_id: '',
                    session_id: '',
                    status_id: '1',
                    photo: ''
                },
                student_id: '',
                m: 'Male',
                f: 'Female',
                pagination: {},
                avatar: null,
                edit: false
            }
        },


        created()
        {
            this.fetchStudents();
            this.fetchAllStudents()
            this.fetchStates();
            this.fetchClasses();
            this.fetchSessions();
        },

        computed: {
            filteredStudents: function()
            {
                return this.students.filter((student) => {
                    return student.registration_no.toLowerCase().match(this.search.toLowerCase()) ||
                           student.firstname.toLowerCase().match(this.search.toLowerCase()) || 
                           student.lastname.toLowerCase().match(this.search.toLowerCase()) || 
                           student.email.toLowerCase().match(this.search.toLowerCase()) || 
                           student.phone.toLowerCase().match(this.search.toLowerCase()) || 
                           student.gender.toLowerCase().match(this.search.toLowerCase()) || 
                           student.classed.class_name.toLowerCase().match(this.search.toLowerCase()) || 
                           student.dob.toLowerCase().match(this.search.toLowerCase()) ||
                           student.session.session_name.toLowerCase().match(this.search.toLowerCase())
                });
            }
        },

        methods:{
            getImage(e)
            {
                let photo = e.target.files[0];
                let reader = new FileReader();    
                reader.readAsDataURL(photo);
                reader.onload = e =>{
                    this.avatar = e.target.result;
                    this.student.photo = e.target.result;
                }

            },


            fetchAllStudents(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/students?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allStudents = res.data;
                })
                .catch(err => console.log(err));
            },


            fetchStudents(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/students'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.students = res.data;
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

            deleteStudent(id)
            {
                if(confirm('Are You Sure You Want To Delete This Student ?'))
                {
                    fetch(`api/student/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success('The Student Record Has Been Deleted');
                        this.fetchStudents();
                    })
                    .catch(err => console.log(err));
                }
            },

            addStudent()
            {
                if(this.edit === false)
                {
                    fetch('api/student', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.student),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm()
                        toastr.success('Student Has Been created Successfully');
                        this.fetchStudents();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addStudentModal').trigger('click');

                }
                else
                {
                    fetch('api/student', 
                    {
                        method: 'put',
                        body: JSON.stringify(this.student),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        toastr.success('Student Was Updated Successfully');
                        this.fetchStudents();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                    $('#addStudentModal').trigger('click');
                }
            },

            editStudent(student)
            {
                this.edit = true;
                this.student.id = student.id;
                this.student.student_id = student.id;
                this.student.registration_no = student.registration_no;
                this.student.firstname = student.firstname;
                this.student.midname = student.midname;
                this.student.lastname = student.lastname;
                this.student.email = student.email;
                this.student.password = student.password;
                this.student.class_id = student.class_id;
                this.student.phone = student.phone;
                this.student.address = student.address;
                this.student.gender = student.gender;
                this.student.dob = student.dob;
                this.student.state_id = student.state_id;
                this.student.nationality = student.nationality;
                this.student.category_id = student.category_id;
                this.student.session_id = student.session_id;
                this.student.photo = student.photo;
            },



            clearForm()
            {
                this.student.firstname = '';
                this.student.midname = '';
                this.student.lastname = '';
                this.student.email = '';
                this.student.password = '';
                this.student.class_id = '';
                this.student.phone = '';
                this.student.address = '';
                this.student.gender = '';
                this.student.dob = '';
                this.student.state_id = '';
                this.student.nationality = '';
                this.student.category_id = '';
                this.student.session_id = '';
                this.student.photo = '';
            },

            exportStudentPDF()
            {
                var vm = this
                var columns = [
                    {id: "registration_no", dataKey: "registration_no"},
                    {firstname: "firstname", dataKey: "firstname"},
                    {midname: "midname", dataKey: "midname"},
                    {lastname: "lastname", dataKey: "lastname"},
                    {email: "email", dataKey: "email"},
                    {password: "password", dataKey: "password"},
                    {class_id: "class_id", dataKey: "class_id"},
                    {phone: "phone", dataKey: "phone"},
                    {address: "address", dataKey: "address"},
                    {gender: "gender", dataKeygender: "gender"},
                    {dob: "dob", dataKey: "dob"},
                    {state_id: "state_id", dataKey: "state_id"},
                    {nationality: "nationality", dataKey: "nationality"},
                    {category_id: "category_id", dataKey: "category_id"},
                    {session_id: "session_id", dataKey: "session_id"}
                ];

                var doc = new jsPDF('p', 'pt');
                doc.autoTable(columns, vm.allStudents );
                doc.save('All Students.pdf');
            },



            fetchStates()
            {
                let states = '/api/states'
                fetch(states)
                .then(res => res.json())
                .then(res => {
                    this.states = res;
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

            fetchSessions()
            {
                let sessiones = '/api/sessiones'
                fetch(sessiones)
                .then(res => res.json())
                .then(res => {
                    this.sessiones = res;
                })
                .catch(err => console.log(err));            
            },
        }
        
    };


</script>


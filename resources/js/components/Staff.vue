
<template>

    <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

    <div class="row">
          <div class="col-xl-2 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px"> Staff 

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
              <staffExcelExport :data="allStaffs" :file_name="'All Staff'"></staffExcelExport>
              <staff_upload @done-uploading="fetchStaffs" :api_url="'http://localhost:8000/staff-upload'" id="id1"></staff_upload>             

              <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addStaffModal" data-toggle="modal" 
              data-original-title="Add New Staff" @click="clearForm()">    <i class="fa fa-plus" aria-hidden="true"></i>
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
                              <th>Firstname</th>
                              <th>Lastname</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Gender</th>
                              <th>Designation</th>
                              <th>Date Of Join</th>
                              <th style="text-align: right;">Action</th>
                            </tr>
                          </thead>
                          <tbody v-for="staff in filteredStaffs" v-bind:key="staff.id">
                            <tr style="background: #fff">
                              <td>{{staff.staff_no}}</td>
                              <td>{{staff.firstname}}</td>
                              <td>{{staff.lastname}}</td>
                              <td>{{staff.email}}</td>
                              <td>{{staff.phone}}</td>
                              <td>{{staff.gender}}</td>
                              <td>{{staff.designation.designation_name}}</td>
                              <td>{{staff.doj}}</td>
                              <td style="text-align: right;">

                                  <a class="pull-right" data-toggle="modal" data-target="#addStaffModal" @click="editStaff(staff)"> 
                                      <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                                  </a>
                                  
                                  <a class="pull-right" data-toggle="tooltip" title="Add Staff Subjects"> 
                                    <router-link class="" v-bind:to="'/staffSubjects/' + staff.staff_no" style="">
                                      <span class="fa fa-tags text-inverse m-r-10" style="margin :1px 2px; color: ##3490dc; cursor: pointer;"></span>
                                    </router-link>
                                  </a>

                                  <a class="pull-right" data-toggle="tooltip" title="Add Staff Qualifications"> 
                                    <router-link class="" v-bind:to="'/staffQualifications/' + staff.staff_no" style="">
                                      <span class="fa fa-file text-inverse m-r-10" style="margin :1px 2px; color: #98777B; cursor: pointer;"></span>
                                    </router-link>
                                  </a>

                                  <a class="pull-right" @click="deleteStaff(staff.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span> </a>
                              </td>
                            </tr>
                          </tbody>
                      </table>
                  

                      <nav aria-label="Page navigation example pull-right">
                          <ul class="pagination pagination-sm">
                            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchStaffs(pagination.prev_page_url)">Prev</a></li>
                            <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchStaffs(pagination.next_page_url)">Next</a></li>
                          </ul>
                      </nav>
                  </div>


                <!-- Modal -->
                <form @submit.prevent="addStaff" class="form-horizontal">
                    <div class="modal fade modal-just-me" id="addStaffModal" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1" style="">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">X</span>  </button>
                            <h4 class="modal-title">New Staff</h4>
                          </div>

                          <div class="modal-body">

                                 <div class="example-wrap">
                                      <div class="example">

                                          <div class="form-group row">
                                            <div class="col-md-6">
                                            <label class="col-md-6 control-label" style="padding:0px">Firstname </label>
                                              <input type="text" class="form-control round" autocomplete="off" v-model="staff.firstname" required/>
                                            </div>
                                            
                                            <div class="col-md-6">
                                            <label class="col-md-6 control-label" style="padding:0px">Midname </label>
                                              <input type="text" class="form-control round" autocomplete="off" v-model="staff.midname"/>
                                            </div>
                                          </div>

                                            
                                          <div class="form-group row">
                                            <div class="col-md-6">
                                            <label class="col-md-6 control-label" style="padding:0px">Lastname </label>
                                              <input type="text" class="form-control round" autocomplete="off" v-model="staff.lastname" required/>
                                            </div>
                                            
                                            <div class="col-md-6">
                                            <label class="col-md-6 control-label" style="padding:0px">Email </label>
                                              <input type="email" class="form-control round" autocomplete="off" v-model="staff.email" required/>
                                            </div>
                                          </div>
                                            

                                          <div class="form-group row">
                                            <div class="col-md-6">
                                            <label class="col-md-6 control-label" style="padding:0px">Password </label>
                                              <input type="password" class="form-control round" autocomplete="off" v-model="staff.password" required/>
                                            </div>
                                            
                                            <div class="col-md-6">
                                            <label class="col-md-6 control-label" style="padding:0px">Phone </label>
                                              <input type="text" class="form-control round" autocomplete="off" v-model="staff.phone" required/>
                                            </div>
                                          </div>


                                          <div class="form-group row">
                                            <label class="col-md-2 control-label">Address </label>
                                            <div class="col-md-10">
                                              <textarea class="form-control" autocomplete="off" v-model="staff.address" required></textarea>
                                            </div>
                                          </div>
                                            

                                          <div class="form-group row">
                                            <div class="col-md-6">
                                            <label class="col-md-6 control-label" style="padding:0px">Date Of Join </label>
                                              <input type="date" class="form-control round" autocomplete="off" v-model="staff.doj" required/>
                                            </div>
                                            
                                            <div class="col-md-6">
                                            <label class="col-md-6 control-label" style="padding:0px">Your Gender </label>
                                              <div class="radio-custom radio-default radio-inline">
                                                <input type="radio" id="inputHorizontalMale" name="" v-model="staff.gender" v-bind:value="m" />     <label for="inputHorizontalMale">Male</label>
                                              </div>
                                              <div class="radio-custom radio-default radio-inline">
                                                <input type="radio" id="inputHorizontalFemale" name="" v-model="staff.gender" v-bind:value="f" />   <label for="inputHorizontalFemale">Female</label>
                                              </div>
                                            </div>
                                          </div>
                                            

                                          <div class="form-group row">
                                            <div class="col-md-6">
                                            <label class="col-md-6 control-label" style="padding:0px">Marital Status </label>
                                              <select class="form-control round" v-model="staff.marital_status" required>
                                                <option value=""></option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Divoirce">Divoirce</option>
                                            </select>
                                            </div>
                                            
                                            <div class="col-md-6">
                                            <label class="col-md-6 control-label" style="padding:0px"> Designation </label>
                                              <select class="form-control round" v-model="staff.designation_id" required>
                                                <option value=""></option>
                                                <option v-for="designation in designations" v-bind:value="designation.id">  {{ designation.designation_name }}  </option>
                                              </select>
                                            </div>
                                          </div>
                                            

                                          <div class="form-group row">
                                            <div class="col-md-6">
                                            <label class="col-md-6 control-label" style="padding:0px">State </label>
                                              <select class="form-control round" v-model="staff.state_id" required>
                                                <option value=""></option>
                                                <option v-for="state in states" v-bind:value="state.id">  {{ state.state_name }}  </option>
                                              </select>
                                            </div>
                                            
                                            <div class="col-md-6">
                                            <label class="col-md-6 control-label" style="padding:0px">Nationality </label>
                                              <input type="text" class="form-control round" autocomplete="off" v-model="staff.nationality" required/>
                                            </div>
                                          </div>


                                          <div class="form-group row">
                                            <div class="col-md-6">
                                              <label for="test_type" class="col-md-6 control-label">Session</label>
                                              <select class="form-control round" v-model="staff.session_id" required>
                                                <option value=""></option>
                                                <option v-for="session in sessiones" v-bind:value="session.id"> {{ session.session_name }} </option>
                                              </select>
                                            </div>
                                            
                                            <div class="col-md-6">
                                            <label class="col-md-6 control-label">Photo </label>
                                              <input type="file" class="form-control round" name="photo" placeholder="Photo" autocomplete="off" multiple="" @change="getImage"/>
                                            </div>
                                          </div>

                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Preview </label>
                                            <div class="col-md-9">
                                              <img :src="avatar" alt="Preview" style="max-width: 200px; max-height: 100px">
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <div class="col-md-6 offset-md-0" style="text-align:left">
                                              <button type="reset" class="btn btn-outline btn-warning btn-round">Clear</button>
                                            </div>
                                            
                                            <div class="col-md-6 offset-md-0" style="text-align:right">
                                              <button type="submit" class="btn btn-dark btn-round">Create New Staff </button>
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
                allStaffs: [],
                search: '',
                states: [],
                designations: [],
                sessiones: [],
                staffs: [], 
                staff: {
                    id: '',
                    staff_no: '',
                    firstname: '',
                    midname: '',
                    lastname: '',
                    email: '',
                    password: '',
                    phone: '',
                    address: '',
                    gender: '',
                    dob: '',
                    marital_status: '',
                    designation_id: '',
                    state_id: '',
                    nationality: '',
                    session_id: '',
                    status_id: '1'
                },
                staff_id: '',
                m: 'Male',
                f: 'Female',
                pagination: {},
                avatar: null,
                edit: false
            }
        },


        created()
        {
            this.fetchStaffs();
            this.fetchAllStaffs();
            this.fetchState();
            this.fetchDesignations();
            this.fetchSessions();
        },

        computed: {
            filteredStaffs: function()
            {
                return this.staffs.filter((staff) => {
                    return staff.staff_no.toLowerCase().match(this.search.toLowerCase()) ||
                           staff.firstname.toLowerCase().match(this.search.toLowerCase()) || 
                           staff.lastname.toLowerCase().match(this.search.toLowerCase()) || 
                           staff.email.toLowerCase().match(this.search.toLowerCase()) || 
                           staff.phone.toLowerCase().match(this.search.toLowerCase()) || 
                           staff.gender.toLowerCase().match(this.search.toLowerCase()) || 
                           staff.doj.toLowerCase().match(this.search.toLowerCase()) ||
                           staff.designation.designation_name.toLowerCase().match(this.search.toLowerCase()) ||
                           staff.session.session_name.toLowerCase().match(this.search.toLowerCase())
                });
            }
        },

        methods:{
            getImage(e)
            {
                let image = e.target.files[0];
                let reader = new FileReader();    
                reader.readAsDataURL(image);
                reader.onload = e =>{
                    this.avatar = e.target.result;
                    this.staff.photo = e.target.result;
                }

            },


            fetchAllStaffs(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/staffs?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allStaffs = res.data;
                    // vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
            },


            fetchStaffs(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/staffs'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.staffs = res.data;
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

            deleteStaff(id)
            {
                if(confirm('Are You Sure You Want To Delete This Staff ?'))
                {
                    fetch(`api/staff/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success('Staff Record Has Been Deleted Successfully');
                        this.fetchStaffs();
                        this.edit = false;
                    })
                    .catch(err => console.log(err));
                }
            },

            addStaff()
            {
                if(this.edit === false)
                {
                    fetch('api/staff', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.staff),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm()
                        toastr.success('Staff Record Has Been Created Successfully');
                        this.fetchStaffs();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addStaffModal').trigger('click');

                }
                else
                {
                    fetch('api/staff', 
                    {
                        method: 'put',
                        body: JSON.stringify(this.staff),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        toastr.success('Staff Record Has Been Updated Successfully');
                        this.fetchStaffs();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                    $('#addStaffModal').trigger('click');
                }
            },

            editStaff(staff)
            {
                this.edit = true;
                this.staff.id = staff.id;
                this.staff.staff_id = staff.id;
                this.staff.staff_no = staff.staff_no;
                this.staff.firstname = staff.firstname;
                this.staff.midname = staff.midname;
                this.staff.lastname = staff.lastname;
                this.staff.email = staff.email;
                this.staff.password = staff.password;
                this.staff.phone = staff.phone;
                this.staff.address = staff.address;
                this.staff.gender = staff.gender;
                this.staff.doj = staff.doj;
                this.staff.marital_status = staff.marital_status;
                this.staff.designation_id = staff.designation_id;
                this.staff.state_id = staff.state_id;
                this.staff.nationality = staff.nationality;
                this.staff.session_id = staff.session_id;
                this.staff.photo = staff.photo;
            },



            clearForm()
            {
                this.staff.firstname = '';
                this.staff.midname = '';
                this.staff.lastname = '';
                this.staff.email = '';
                this.staff.password = '';
                this.staff.marital_status = '';
                this.staff.phone = '';
                this.staff.address = '';
                this.staff.gender = '';
                this.staff.doj = '';
                this.staff.state_id = '';
                this.staff.nationality = '';
                this.staff.designation_id = '';
                this.staff.session_id = '';
                this.staff.photo = '';
            },

            exportPDF()
            {
                var vm = this
                var columns = [
                    {id: "staff_no", dataKey: "staff_no"},
                    {firstname: "firstname", dataKey: "firstname"},
                    {midname: "midname", dataKey: "midname"},
                    {lastname: "lastname", dataKey: "lastname"},
                    {email: "email", dataKey: "email"},
                    {password: "password", dataKey: "password"},
                    {phone: "phone", dataKey: "phone"},
                    {address: "address", dataKey: "address"},
                    {gender: "gender", dataKeygender: "dob"},
                    {marital_status: "marital_status", dataKey: "marital_status"},
                    {designation_id: "designation_id", dataKey: "designation_id"},
                    {doj: "doj", dataKey: "doj"},
                    {state_id: "state_id", dataKey: "state_id"},
                    {nationality: "nationality", dataKey: "nationality"}
                ];

                var doc = new jsPDF('p', 'pt');
                doc.autoTable(columns, vm.allStaffs );
                doc.save('All Staffs.pdf');
            },





            fetchState()
            {
                let states = '/api/states'
                fetch(states)
                .then(res => res.json())
                .then(res => {
                    this.states = res;
                })
                .catch(err => console.log(err));            
            },

            fetchDesignations()
            {
                let designations = '/api/designations'
                fetch(designations)
                .then(res => res.json())
                .then(res => {
                    this.designations = res;
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


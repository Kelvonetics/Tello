
<style>
    .modal-sidebar
    {        
        height: 100%;
        right: 2px;
        position: fixed;
        width: 545px;          
        /* margin-top: -55px !important; */
        margin-bottom: 0px !important;
        top: 0px;
        height: 102%;
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
 <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

    <div class="row">
          <div class="col-xl-4 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px">Staff Qualification / Certification 

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
          <div class="col-xl-5 col-md-2 col-sm-3" style="text-align: right; padding-bottom: 0px"> 
              <classExcelExport :data="allClasses" :file_name="'All Classes'"></classExcelExport>            

              <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addStaffQualificationModal" data-toggle="modal" 
                          data-original-title="Add New Staff Qualification" @click="clearForm()">  <i class="icon wb-plus" aria-hidden="true"></i>
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
                              <th>Institute</th>
                              <th>Course</th>
                              <th>Grade</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Certificate</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody v-for="staff_qualification in filteredStaffQualifications" v-bind:key="staff_qualification.id">
                            <tr style="background: #fff">
                              <td>{{staff_qualification.staff_no}}</td>
                              <td>{{staff_qualification.instituite}}</td>
                              <td>{{staff_qualification.course}}</td>
                              <td>{{staff_qualification.grade}}</td>
                              <td>{{staff_qualification.start_date}}</td>
                              <td>{{staff_qualification.end_date}}</td>
                              <td>{{staff_qualification.certificate}}</td>
                              <td>
                                  <a class="pull-right" @click="editStaffQualification(staff_subject)" data-toggle="modal" data-target="#addStaffQualificationModal"> 
                                      <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                                  </a>
                                  <a class="pull-right" @click="deleteStaffQualification(staff_qualification.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span>
                                  </a>
                              </td>
                            </tr>
                          </tbody>
                      </table>
                  </div>
                  

                  <nav aria-label="Page navigation example pull-right">
                      <ul class="pagination pagination-sm">
                        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchStaffQualifications(pagination.prev_page_url)">Prev</a></li>
                        <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchStaffQualifications(pagination.next_page_url)">Next</a></li>
                      </ul>
                  </nav>
                </div>

              </div>




            <!-- STAFF QUALIFICATION MODAL -->
            <form @submit.prevent="addStaffQualification" class="form-horizontal">
                <div class="modal modal-lg fade" id="addStaffQualificationModal" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1" style="margin-top: 36px">
                  <div class="modal-dialog modal-sidebar modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">&times;</span>  </button>
                        <h4 class="modal-title">New Qualification</h4>
                      </div>

                      <div class="modal-body">

                             <div class="example-wrap">
                                <div class="example">

                                <div class="form-group row">
                                  <label class="col-md-3 form-control-label">Institute </label>
                                  <div class="col-md-9">
                                    <input type="text" class="form-control round" autocomplete="off" v-model="staff_qualification.instituite"/>
                                  </div>
                                </div>   

                                <div class="form-group row">
                                  <label class="col-md-3 form-control-label">Course </label>
                                  <div class="col-md-9">
                                    <input type="text" class="form-control round" autocomplete="off" v-model="staff_qualification.course"/>
                                  </div>
                                </div>   

                                <div class="form-group row">
                                  <label class="col-md-3 form-control-label">Grade </label>
                                  <div class="col-md-9">
                                    <input type="text" class="form-control round" autocomplete="off" v-model="staff_qualification.grade"/>
                                  </div>
                                </div>   

                                <div class="form-group row">
                                  <label class="col-md-3 form-control-label">Start Date </label>
                                  <div class="col-md-9">
                                    <input type="date" class="form-control round" autocomplete="off" v-model="staff_qualification.start_date"/>
                                  </div>
                                </div>  

                                <div class="form-group row">
                                  <label class="col-md-3 form-control-label">End Date </label>
                                  <div class="col-md-9">
                                    <input type="date" class="form-control round" autocomplete="off" v-model="staff_qualification.end_date"/>
                                  </div>
                                </div>  

                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Certificate</label>
                                    <div class="col-md-9">
                                        <input type="file" name="certificate" class="form-control" placeholder="Certificate" @change="getImage">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Preview</label>
                                    <div class="col-md-9">
                                        <img :src="avatar" alt="Preview" style="max-width: 150px; max-height: 100px">
                                    </div>
                                </div>

                                <div class="form-group row">
                                  <div class="col-md-6 offset-md-0" style="text-aligh:left">
                                    <button type="reset" class="btn btn-outline btn-warning btn-round">Reset</button>
                                  </div>
                                  
                                  <div class="col-md-6 offset-md-0" style="text-aligh:right">
                                    <button type="submit" class="btn btn-dark btn-round">Create Staff Qualification </button>
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
    </div>
    
    </div>
</template>











<script>


    export default
    {

        data()
        {
            return{ 
                allStaffQualifications: [],
                search: '',
                staff_qualifications: [], 
                staff_qualification: {
                    id: '',
                    staff_no: '',
                    instituite: '',
                    course: '',
                    grade: '',
                    start_date: '',
                    end_date: '',
                    certificate: ''
                },               
                staff_qualification_id: '',
                pagination: {},
                avatar: null,
                edit: false,
                dataNull:false
            }
        },


        created()
        {
            this.staff_no = this.$route.params.id;

            this.fetchQualificationObject();
            this.fetchStaffQualifications();
            this.fetchAllStaffQualifications();
            this.fetchStaffDetails();
        },

        computed: {
            filteredStaffQualifications: function()
            {
                return this.staff_qualifications.filter((staff_qualification) => {
                    return staff_qualification.staff_no.toLowerCase().match(this.search.toLowerCase())  || 
                           staff_qualification.instituite.toLowerCase().match(this.search.toLowerCase()) || 
                           staff_qualification.course.toLowerCase().match(this.search.toLowerCase()) || 
                           staff_qualification.grade.toLowerCase().match(this.search.toLowerCase()) || 
                           staff_qualification.start_date.toLowerCase().match(this.search.toLowerCase()) || 
                           staff_qualification.end_date.toLowerCase().match(this.search.toLowerCase())
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

            //QUALIFICATION
            fetchAllStaffQualifications(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/staff_qualifications?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allStaffQualifications = res.data;
                    // vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
            },


            fetchStaffQualifications(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/staff_qualifications/' + this.$route.params.id
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.staff_qualifications = res.data;
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

            deleteStaffQualification(id)
            {
                if(confirm('Are You Sure You Want To Delete This Staff Qualification ?'))
                {
                    fetch(`api/staff_qualification/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success('The Staff Qualification Has Been Deleted');
                        this.fetchStaffQualifications();
                    })
                    .catch(err => console.log(err));
                }
            },

            fetchQualificationObject()
            {
                //'Subject-exam-id/{id}',
                
                fetch('/api/staff-qualification-by-id/' + this.$route.params.id,{
                    method:'GET'
                }).then(res=>res.json())
                .then(res=>{
                    if (res.data){
                      this.staff_qualification = res.data;
                    }else{
                       this.dataNull = true;
                    }
                    // toastr.success('fetched... ');
                });
            },


            addStaffQualification()
            {
                if(this.edit === false)
                {
                  this.staff_qualification.staff_no = this.$route.params.id;
                    fetch('api/staff_qualification', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.staff_qualification),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm()
                        toastr.success('Staff Qualification Has Been created Successfully');
                        this.fetchStaffQualifications();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addStaffQualificationModal').trigger('click');

                }
                else
                {
                    fetch('/api/staff_qualification/' + this.staff_qualification.id, 
                    {
                        method: 'put',
                        body: JSON.stringify(this.staff_qualification),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        toastr.success('Staff Qualification Has Been Updated');
                        this.fetchStaffQualifications();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                    $('#addStaffQualificationModal').trigger('click');
                    // location.reload();
                }
            },

            editStaffQualification(staff_qualification)
            {
                this.edit = true;
                this.staff_qualification.id = staff_qualification.id;
                this.staff_qualification.staff_qualification_id = staff_qualification.id;
                this.staff_qualification.staff_no = staff_qualification.staff_no;
                this.staff_qualification.instituite = staff_qualification.instituite;
                this.staff_qualification.course = staff_qualification.course;
                this.staff_qualification.grade = staff_qualification.grade;
                this.staff_qualification.start_date = staff_qualification.start_date;
                this.staff_qualification.end_date = staff_qualification.end_date;
                this.staff_qualification.certificate = staff_qualification.certificate;
            },



            clearForm()
            {
                this.staff_qualification.staff_no = '';
                this.staff_qualification.instituite = '';
                this.staff_qualification.course = '';
                this.staff_qualification.grade = '';
                this.staff_qualification.start_date = '';
                this.staff_qualification.end_date = '';
                this.staff_qualification.certificate = '';
                this.staff_qualification.status_id = '';
            },



        }
    };
</script>

<style>
    .tab-pane
    {
        padding: 10px 0px;
    }

    .tab-pane
    {
        border: thin dotted #ddd;
        border-radius: 5px;
    }

    .form-control-label
    {
        padding-left: 15px;
    }

    .close_x
    {
        font-size: 20px;
        color: red;
    }

    .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link
    {
        background-color: #3e8ef7 !important;       /*263238*/
        color: #fff;
    }

    .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link:focus
    {
        color: #fff;
    }
</style>



<template>
  <div class="page" style="padding: -25px 0px 0px 0px;">
    <div class="page-content">    

      <div class="panel" style="margin-top: -15px; padding: 5px 20px">



    <div class="row" style="">
        <div class="col-md-12">

            
        
            <div class="row">
                <div class="col-xl-9 col-md-7 col-sm-6" style=""><h3 style="">Setup  Academic Session For {{ session_detail.session_name }} </h3> </div>                
            </div>



            <!-- Tab Animation -->
            <div class="row">

              <div class="col-xl-12 col-lg-12">
                <div class="example-wrap">
                      <div class="nav-tabs-horizontal" data-plugin="tabs">
                        <ul class="nav nav-tabs nav-tabs-line tabs-line-top" role="tablist">
                          <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-toggle="tab" href="#classes" aria-controls="classes" role="tab" aria-expanded="true">
                              <i class="icon fa-cubes" aria-hidden="true"></i>   Classes
                            </a>
                          </li>

                          <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#subjects" aria-controls="subjects" role="tab" aria-expanded="false">
                              <i class="icon wb-library" aria-hidden="true"></i> Subjects
                            </a>
                          </li>

                          <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#students" aria-controls="students" role="tab" aria-expanded="true">
                              <i class="icon wb-users" aria-hidden="true"></i> students
                            </a>
                          </li>

                          <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#staff" aria-controls="staff" role="tab" aria-expanded="true">
                              <i class="icon wb-user-circle" aria-hidden="true"></i> Staff
                            </a>
                          </li>

                          <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#titmetables" aria-controls="titmetables" role="tab" aria-expanded="true">
                              <i class="icon wb-table" aria-hidden="true"></i> Timetables
                            </a>
                          </li>

                          <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#fees" aria-controls="fees" role="tab" aria-expanded="true">
                              <i class="icon wb-payment" aria-hidden="true"></i> Fees
                            </a>
                          </li>

                          <li class="nav-item" role="presentation">
                            <a class="nav-link" data-toggle="tab" href="#curriculeums" aria-controls="curriculeums" role="tab" aria-expanded="true">
                              <i class="icon wb-copy" aria-hidden="true"></i> Curriculeum
                            </a>
                          </li>
                        </ul>


                        <div class="tab-content">
                          <div class="tab-pane active animation-fade" id="classes" role="tabpanel">

                                <div class="row">
                                    <div class="col-xl-9 col-md-7 col-sm-6" style=""><h2 style="margin-top: -1px"> Classes     </h2> </div>
                                    <div class="col-xl-2 col-md-3 col-sm-3" style=""> 
                                        <div class="form-group">
                                            <div class="input-search">
                                              <button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
                                              <input type="text" class="form-control pull-right" placeholder="Search" v-model="search" />
                                            </div>
                                          </div>
                                    </div>              
                                    <div class="col-xl-1 col-md-2 col-sm-3" style="">              
                                        <classExcelExport :data="allClasses" :file_name="'All Classes'"></classExcelExport>

                                        <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addClassModal" data-toggle="modal" 
                                        data-original-title="Add New Class" @click="clearClassForm()">    <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button> 
                                    </div>
                                </div>



                                <div class="example table-responsive" style="margin-top: -20px">
                                  <table class="table table-hover table-striped table-sm">
                                      <thead class="thead-dark">
                                        <tr>
                                          <th>Class Name</th>
                                          <th>Class Type</th>
                                          <th>Accademic Session</th>
                                          <th>Status</th>
                                          <th style="text-align: right;">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody v-for="classe in filteredClasses" v-bind:key="classe.id">
                                        <tr style="background: #fff">
                                          <td>{{classe.class_name}}</td>
                                          <td>
                                            <span v-if="classe.class_type === 1"> Primary </span>
                                            <span v-else-if="classe.class_type === 2"> Junior Secondary</span>
                                            <span v-else-if="classe.class_type === 3"> Senior Secondary </span>
                                          </td>
                                          <td>{{classe.session.session_name}}</td>
                                          <td>
                                            <span v-if="classe.status_id === 0"> In active </span>
                                            <span v-else-if="classe.status_id === 1"> Active</span>
                                          </td>
                                          <td style="text-align: right;">
                                              <a class="pull-right" data-toggle="modal" data-target="#addClassModal" 
                                                  @click="editClass(classe)"><span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                                              </a>
                                              <a class="pull-right" @click="deleteClass(classe.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span>
                                              </a>
                                          </td>
                                        </tr>
                                      </tbody>
                                  </table>
                                  

                                  <nav aria-label="Page navigation example pull-right">
                                      <ul class="pagination pagination-sm">
                                        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchClasses(pagination.prev_page_url)">Prev</a></li>
                                        <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                                        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchClasses(pagination.next_page_url)">Next</a></li>
                                      </ul>
                                  </nav>
                              </div>

                          </div>

                          <div class="tab-pane animation-fade" id="subjects" role="tabpanel">
                            
                                <div class="row">
                                    <div class="col-xl-9 col-md-7 col-sm-6" style=""><h2 style="margin-top: -1px"> Subjects     </h2> </div>
                                    <div class="col-xl-2 col-md-3 col-sm-3" style=""> 
                                        <div class="form-group">
                                            <div class="input-search">
                                              <button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
                                              <input type="text" class="form-control pull-right" placeholder="Search" v-model="search" />
                                            </div>
                                          </div>
                                    </div>              
                                    <div class="col-xl-1 col-md-2 col-sm-3" style="">              
                                        <subjectExcelExport :data="allSubjects" :file_name="'All Subject'"></subjectExcelExport>

                                        <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addSubjectModal" data-toggle="modal" 
                                        data-original-title="Add New Subject" @click="clearSubjectForm()">    <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button> 
                                    </div>
                                </div>


                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-sm">
                                        <thead class="thead-dark">
                                          <tr>
                                            <th>Subject Name</th>
                                            <th>Subject Type</th>
                                            <th>Class </th>
                                            <th>Session </th>
                                            <th>Status</th>
                                            <th style="text-align: right">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody v-for="subject in filteredSubjects" v-bind:key="subject.id">
                                          <tr style="background: #fff">
                                            <td>{{subject.subject_name}}</td>
                                            <td>
                                              <span v-if="subject.subject_type === 1"> Primary </span>
                                              <span v-else-if="subject.subject_type === 2"> Junior Secondary</span>
                                              <span v-else-if="subject.subject_type === 3"> Senior Secondary </span>
                                            </td>
                                            <td>{{subject.classed.class_name}}</td>
                                            <td>{{subject.session.session_name}}</td>
                                            <td>
                                              <span v-if="subject.status_id === 0"> In active </span>
                                              <span v-else-if="subject.status_id === 1"> Active</span>
                                            </td>
                                            <td style="text-align: right">
                                                <a class="pull-right" data-toggle="modal" data-target="#addSubjectModal" 
                                                    @click="editSubject(subject)"><span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                                                </a>
                                                <a class="pull-right" @click="deleteSubject(subject.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span>
                                                </a>
                                            </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <nav aria-label="Page navigation example pull-right">
                                    <ul class="pagination pagination-sm">
                                      <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchSubjects(pagination.prev_page_url)">Prev</a></li>
                                      <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                                      <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchSubjects(pagination.next_page_url)">Next</a></li>
                                    </ul>
                                </nav>

                          </div>

                          <div class="tab-pane animation-fade" id="students" role="tabpanel">

                                <div class="row">
                                    <div class="col-xl-9 col-md-7 col-sm-6" style=""><h2 style="margin-top: -1px"> Students 
                                        <studentExcelExport :data="allStudents" :file_name="'All Students'"></studentExcelExport>

                                        <!-- <button class="btn btn-sm btn-icon btn-round pull-right" style="border:thin line black; background:#202020; color:#fff;" @click="exportStudentPDF"><i class="fa fa-file-pdf-o"> </i>  </button> -->
                                    </h2> </div>
                                    <div class="col-xl-2 col-md-3 col-sm-3" style=""> 
                                        <div class="form-group">
                                            <div class="input-search">
                                              <button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
                                              <input type="text" class="form-control pull-right" placeholder="Search" v-model="search" />
                                            </div>
                                          </div>
                                    </div>              
                                    <div class="col-xl-1 col-md-2 col-sm-3" style=""> 
                                        <student_upload @done-uploading="fetchStudents" :api_url="'http://localhost:8000/student-upload'" id="id1"></student_upload>             

                                        <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addStudentModal" data-toggle="modal" 
                                        data-original-title="Add New Student" @click="clearStudentForm()">    <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>              
                                    </div>
                                </div>

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
                                            <th>State</th>
                                            <th style="text-align: right">Action</th>
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
                                            <td>{{student.state.state_name}}</td>
                                            <td style="text-align: right">
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
                                        </tbody>
                                    </table>
                                </div>
                                

                                <nav aria-label="Page navigation example pull-right">
                                    <ul class="pagination pagination-sm">
                                      <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchStudents(pagination.prev_page_url)">Prev</a></li>
                                      <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                                      <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchStudents(pagination.next_page_url)">Next</a></li>
                                    </ul>
                                </nav>

                          </div>

                          <div class="tab-pane animation-fade" id="staff" role="tabpanel">
                            
                                <div class="row">
                                    <div class="col-xl-9 col-md-7 col-sm-6" style=""><h2 style="margin-top: -1px"> Staff 
                                        <staffExcelExport :data="allStaffs" :file_name="'All Staff'"></staffExcelExport>

                                        <!-- <button class="btn btn-sm btn-icon btn-round pull-right" style="border:thin line black; background:#202020; color:#fff;" @click="exportStaffPDF"><i class="fa fa-file-excel-o"> </i>  </button> -->
                                    </h2> </div>
                                    <div class="col-xl-2 col-md-3 col-sm-3" style=""> 
                                        <div class="form-group">
                                            <div class="input-search">
                                              <button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
                                              <input type="text" class="form-control pull-right" placeholder="Search" v-model="search" />
                                            </div>
                                          </div>
                                    </div>              
                                    <div class="col-xl-1 col-md-2 col-sm-3" style=""> 
                                        <staff_upload @done-uploading="fetchStaffs" :api_url="'http://localhost:8000/staff-upload'" id="id1"></staff_upload>             

                                        <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addStaffModal" data-toggle="modal" 
                                        data-original-title="Add New Staff" @click="clearStaffForm()">    <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>              
                                    </div>
                                </div>

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
                                            <th style="text-align: right">Action</th>
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
                                            <td style="text-align: right">                                                
                                                <a class="pull-right" data-toggle="tooltip" title="Add Staff Subjects"> 
                                                  <router-link class="" v-bind:to="'/staffSubjects/' + staff.staff_no" style="">
                                                    <span class="fa fa-briefcase text-inverse m-r-10" style="margin :1px 2px; color: ##3490dc; cursor: pointer;"></span>
                                                  </router-link>
                                                </a>
                                                <a class="pull-right" data-toggle="modal" data-target="#addStaffModal" @click="editStaff(staff)"> 
                                                    <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                                                </a>
                                                <a class="pull-right" @click="deleteStaff(staff.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span> </a>
                                            </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                                

                                <nav aria-label="Page navigation example pull-right">
                                    <ul class="pagination pagination-sm">
                                      <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchStaffs(pagination.prev_page_url)">Prev</a></li>
                                      <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                                      <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchStaffs(pagination.next_page_url)">Next</a></li>
                                    </ul>
                                </nav>

                          </div>

                          <div class="tab-pane animation-fade" id="titmetables" role="tabpanel">
                            
                                <div class="row">
                                    <div class="col-xl-9 col-md-7 col-sm-6" style=""><h2 style="margin-top: -1px"> Academic Time Table
                                        <timeTableExcelExport :data="allTimeTables" :file_name="'All TimeTables'"></timeTableExcelExport>

                                    </h2> </div>
                                    <div class="col-xl-2 col-md-3 col-sm-3" style=""> 
                                        <div class="form-group">
                                            <div class="input-search">
                                              <button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
                                              <input type="text" class="form-control pull-right" placeholder="Search" v-model="search" />
                                            </div>
                                          </div>
                                    </div>              
                                    <div class="col-xl-1 col-md-2 col-sm-3" style=""> 
                                        <timetable_upload @done-uploading="fetchTimeTables" :api_url="'http://localhost:8000/timetable-upload'" id="id1"></timetable_upload>             

                                        <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addTimeTableModal" data-toggle="modal" 
                                        data-original-title="Add New Academic Time Table" @click="clearTimeTableForm()">    <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>              
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-sm">
                                        <thead class="thead-dark">
                                          <tr>
                                            <th>Session</th>
                                            <th>Class</th>
                                            <th>Term</th>
                                            <th>Week</th>
                                            <th>Time Slot</th>
                                            <th>Monday</th>
                                            <th>Tuesday</th>
                                            <th>Wednesday</th>
                                            <th>Thursday</th>
                                            <th>Friday</th>
                                            <th style="text-align: right">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody v-for="time_table in filteredTimeTables" v-bind:key="time_table.id">
                                          <tr style="background: #fff">
                                            <td>{{time_table.session.session_name}}</td>
                                            <td>{{time_table.classed.class_name}}</td>
                                            <td>
                                              <span v-if="time_table.term_id === 1"> First Term </span>
                                              <span v-else-if="time_table.term_id === 2"> Second Term </span>
                                              <span v-else-if="time_table.term_id === 3"> Third </span>
                                            </td>
                                            <td>{{time_table.week}}</td>
                                            <td>{{time_table.time_slot}}</td>
                                            <td>{{time_table.Monday.subject_name}}</td>
                                            <td>{{time_table.Tuesday.subject_name}}</td>
                                            <td>{{time_table.Wednesday.subject_name}}</td>
                                            <td>{{time_table.Thursday.subject_name}}</td>
                                            <td>{{time_table.Friday.subject_name}}</td>
                                            <td style="text-align: right">
                                                <a class="pull-right" data-toggle="modal" data-target="#addTimeTableModal" @click="editTimeTable(time_table)"> 
                                                    <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                                                </a>
                                                <a class="pull-right" @click="deleteTimeTable(time_table.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span>
                                                </a>
                                            </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                                

                                <nav aria-label="Page navigation example pull-right">
                                    <ul class="pagination pagination-sm">
                                      <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchTimeTables(pagination.prev_page_url)">Prev</a></li>
                                      <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                                      <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchTimeTables(pagination.next_page_url)">Next</a></li>
                                    </ul>
                                </nav>

                          </div>

                          <div class="tab-pane animation-fade" id="fees" role="tabpanel">
                            
                                <div class="row">
                                    <div class="col-xl-9 col-md-7 col-sm-6" style=""><h2 style="margin-top: -1px"> Fees 
                                        <!-- <subjectExcelExport :data="allFees" :file_name="'All Fees'"></subjectExcelExport> -->

                                    </h2> </div>
                                    <div class="col-xl-2 col-md-3 col-sm-3" style=""> 
                                        <div class="form-group">
                                            <div class="input-search">
                                              <button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
                                              <input type="text" class="form-control pull-right" placeholder="Search" v-model="search" />
                                            </div>
                                          </div>
                                    </div>              
                                    <div class="col-xl-1 col-md-2 col-sm-3" style=""> 

                                        <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addFeeModal" data-toggle="modal" 
                                        data-original-title="Add New Fees" @click="clearFeeForm()">    <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>              
                                    </div>
                                </div>


                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-sm">
                                        <thead class="thead-dark">
                                          <tr>
                                            <th>Fee</th>
                                            <th>Type</th>
                                            <th>Currency </th>
                                            <th>Amount</th>
                                            <th>Class</th>
                                            <th>Session </th>
                                            <th>Frequency</th>
                                            <th>Status</th>
                                            <th style="text-align: right">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody v-for="fee in filteredFees" v-bind:key="fee.id">
                                          <tr style="background: #fff">
                                            <td>{{fee.fee_name}}</td>
                                            <td>
                                              <span v-if="fee.fee_type_id === 1"> Primary </span>
                                              <span v-else-if="fee.fee_type_id === 2"> Junior Secondary</span>
                                              <span v-else-if="fee.fee_type_id === 3"> Senior Secondary </span>
                                            </td>
                                            <td>
                                              <span v-if="fee.currency === 1"> Naira </span>
                                              <span v-else-if="fee.currency === 2"> Dollar</span>
                                              <span v-else-if="fee.currency === 3"> Euro </span>
                                              <span v-else-if="fee.currency === 4"> Others </span>
                                            </td>
                                            <td>{{fee.amount}}</td>
                                            <td>{{fee.classed.class_name}}</td>
                                            <td>{{fee.session.session_name}}</td>
                                            <td>{{fee.frequency}}</td>
                                            <td>
                                              <span v-if="fee.status_id === 0"> Non Active </span>
                                              <span v-else-if="fee.status_id === 1"> Active</span>
                                            </td>
                                                            <td style="text-align: right">
                                                <a class="pull-right" data-toggle="modal" data-target="#addFeeModal" 
                                                    @click="editFee(fee)"><span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                                                </a>
                                                <a class="pull-right" @click="deleteFee(fee.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span>
                                                </a>
                                            </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <nav aria-label="Page navigation example pull-right">
                                    <ul class="pagination pagination-sm">
                                      <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchFees(pagination.prev_page_url)">Prev</a></li>
                                      <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                                      <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchFees(pagination.next_page_url)">Next</a></li>
                                    </ul>
                                </nav>

                          </div>

                          <div class="tab-pane animation-fade" id="curriculeums" role="tabpanel">



                          </div>
                        </div>
                      </div>
                </div>
              </div>
            </div>


        </div>
        <!-- End Tab Animation -->








        <!-- CLASS Modal -->
        <form @submit.prevent="addClass" class="form-horizontal">
          <div class="modal fade modal-just-me" id="addClassModal" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" style="margin-top: 36px">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="close_x">X</span>
                  </button>
                  <h4 class="modal-title"> <i class="icon wb-grid-4" aria-hidden="true"> </i> New Class</h4>
                </div>
                <div class="modal-body">
                    <p>
                      <div class="example-wrap">
                          <div class="example">

                              <div class="form-group row">
                                <label class="col-md-3">Class Name </label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control round" autocomplete="on" v-model="classe.class_name" required/>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3">Type </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="classe.class_type" required>
                                    <option value=""></option>
                                    <option value="1">Primary</option>
                                    <option value="2">Junior Secondary</option>
                                    <option value="3">Senior Secondary</option>
                                </select>
                                </div>
                              </div>

                          </div>
                    </div>
                  </p>
                </div>
                <div class="modal-footer">
                      <button type="reset" class="btn btn-default btn-outline">Reset</button>
                      <button type="submit" class="btn btn-primary pull-right">Create New Class </button>
                </div>
              </div>
            </div>
          </div>
        </form>
         <!-- End Modal -->



        <!-- SUBJECT Modal -->
        <form @submit.prevent="addSubject" class="form-horizontal">
          <div class="modal fade modal-just-me" id="addSubjectModal" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" style="margin-top: 36px">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="close_x">X</span>
                  </button>
                  <h4 class="modal-title"> <i class="icon wb-library" aria-hidden="true"> </i> New Subject</h4>
                </div>
                <div class="modal-body">
                    <p>
                      <div class="example-wrap">
                          <div class="example">

                              <div class="form-group row">
                                <label class="col-md-3">Subject Name </label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control round" autocomplete="off" v-model="subject.subject_name" required/>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3">Type </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="subject.subject_type" required>
                                    <option value=""></option>
                                    <option value="1">Primary</option>
                                    <option value="2">Junior Secondary</option>
                                    <option value="3">Senior Secondary</option>
                                </select>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3"> Class </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="subject.class_id" required>
                                    <option value=""></option>
                                    <option v-for="classs in classed" v-bind:value="classs.id" v-bind:key="classs.id"> {{ classs.class_name }} </option>
                                </select>
                                </div>
                              </div>

                          </div>
                    </div>
                  </p>
                </div>
                <div class="modal-footer">
                      <button type="reset" class="btn btn-default btn-outline">Reset</button>
                      <button type="submit" class="btn btn-primary pull-right">Create New Subject </button>
                </div>
              </div>
            </div>
          </div>
        </form>
         <!-- End Modal -->



        <!-- STUDENT Modal -->
        <form @submit.prevent="addStudent" class="form-horizontal">
          <div class="modal fade modal-just-me" id="addStudentModal" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" style="margin-top: 36px">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="close_x">X</span>
                  </button>
                  <h4 class="modal-title"> <i class="icon wb-user" aria-hidden="true"> </i> New Student</h4>
                </div>
                <div class="modal-body">
                    <p>
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
                                <label class="col-md-3 form-control-label">Class </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="student.class_id" required>
                                    <option value=""></option>
                                    <option v-for="classs in classed" v-bind:key="classs.id" v-bind:value="classs.id"> {{ classs.class_name }} </option>
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
                                    <option v-for="state in states" v-bind:key="state.id" v-bind:value="state.id"> {{ state.state_name }} </option>
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
                                <label class="col-md-3 form-control-label">Photo </label>
                                <div class="col-md-9">
                                  <input type="file" class="form-control round" name="photo" placeholder="Photo" autocomplete="off" multiple="" @change="getImage" required/>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Preview </label>
                                <div class="col-md-9">
                                  <img :src="avatar" alt="Preview" style="max-width: 200px; max-height: 100px">
                                </div>
                              </div>

                          </div>
                    </div>
                  </p>
                </div>
                <div class="modal-footer">
                      <button type="reset" class="btn btn-default btn-outline">Reset</button>
                      <button type="submit" class="btn btn-primary pull-right">Create New Student </button>
                </div>
              </div>
            </div>
          </div>
        </form>
         <!-- End Modal -->



        <!-- STUDENT Modal -->
        <form @submit.prevent="addStaff" class="form-horizontal">
          <div class="modal fade modal-just-me" id="addStaffModal" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" style="margin-top: 36px">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="close_x">X</span>
                  </button>
                  <h4 class="modal-title"> <i class="icon wb-user" aria-hidden="true"> </i> New Staff</h4>
                </div>
                <div class="modal-body">
                    <p>
                      <div class="example-wrap">
                          <div class="example">

                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Firstname </label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control round" autocomplete="off" v-model="staff.firstname" required/>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Midname </label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control round" autocomplete="off" v-model="staff.midname"/>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Lastname </label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control round" autocomplete="off" v-model="staff.lastname" required/>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Email </label>
                                <div class="col-md-9">
                                  <input type="email" class="form-control round" autocomplete="off" v-model="staff.email" required/>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Password </label>
                                <div class="col-md-9">
                                  <input type="password" class="form-control round" autocomplete="off" v-model="staff.password" required/>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Phone </label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control round" autocomplete="off" v-model="staff.phone" required/>
                                </div>
                              </div>

                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Address </label>
                                <div class="col-md-9">
                                  <textarea class="form-control round" autocomplete="off" v-model="staff.address" required></textarea>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Date Of Join </label>
                                <div class="col-md-9">
                                  <input type="date" class="form-control round" autocomplete="off" v-model="staff.doj" required/>
                                </div>
                              </div>

                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Your Gender </label>
                                <div class="col-md-9">
                                  <div class="radio-custom radio-default radio-inline">
                                    <input type="radio" id="inputHorizontalMale" name="" v-model="staff.gender" v-bind:value="m" />     <label for="inputHorizontalMale">Male</label>
                                  </div>
                                  <div class="radio-custom radio-default radio-inline">
                                    <input type="radio" id="inputHorizontalFemale" name="" v-model="staff.gender" v-bind:value="f" />   <label for="inputHorizontalFemale">Female</label>
                                  </div>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Marital Status </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="staff.marital_status" required>
                                    <option value=""></option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divoirce">Divoirce</option>
                                </select>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label"> Designation </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="staff.designation_id" required>
                                    <option value=""></option>
                                    <option v-for="designation in designations" v-bind:key="designation.id" v-bind:value="designation.id"> {{ designation.designation_name }} </option>
                                </select>
                                </div>
                              </div>
                                
                              <!-- <div class="form-group row">
                                <label class="col-md-3 form-control-label">Role </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="staff.role_id" required>
                                    <option value=""></option>
                                    <option value="1">Admin</option>
                                    <option value="2">Teacher</option>
                                    <option value="3">Driver</option>
                                    <option value="4">Accountant</option>
                                    <option value="5">Principal</option>
                                    <option value="6">Proprietor</option>
                                </select>
                                </div>
                              </div> -->
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">State </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="staff.state_id" required>
                                    <option value=""></option>
                                    <option v-for="state in states" v-bind:key="state.id" v-bind:value="state.id">  {{ state.state_name }} </option>
                                </select>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Nationality </label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control round" autocomplete="off" v-model="staff.nationality" required/>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Photo </label>
                                <div class="col-md-9">
                                  <input type="file" class="form-control round" name="photo" placeholder="Photo" autocomplete="off" multiple="" @change="getStaffImage" required/>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Preview </label>
                                <div class="col-md-9">
                                  <img :src="avatar" alt="Preview" style="max-width: 200px; max-height: 100px">
                                </div>
                              </div>


                          </div>
                    </div>
                  </p>
                </div>
                <div class="modal-footer">
                      <button type="reset" class="btn btn-default btn-outline">Reset</button>
                      <button type="submit" class="btn btn-primary pull-right">Create New Staff </button>
                </div>
              </div>
            </div>
          </div>
        </form>
         <!-- End Modal -->



        <!-- TIMETABLE Modal -->
        <form @submit.prevent="addTimeTable" class="form-horizontal">
          <div class="modal fade modal-just-me" id="addTimeTableModal" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" style="margin-top: 36px">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="close_x">X</span>
                  </button>
                  <h4 class="modal-title"> <i class="icon wb-library" aria-hidden="true"> </i> New TimeTable</h4>
                </div>
                <div class="modal-body">
                    <p>
                      <div class="example-wrap">
                          <div class="example">
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Class </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="time_table.class_id" required>
                                    <option value=""></option>
                                    <option v-for="classs in classed" v-bind:key="classs.id" v-bind:value="classs.id"> {{ classs.class_name }} </option>
                                </select>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Term </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="time_table.term_id" required>
                                    <option value=""></option>
                                    <option value="1">First Term</option>
                                    <option value="2">Second Term</option>
                                    <option value="3">Third Term</option>
                                </select>
                                </div>
                              </div>                                           

                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Week </label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control round" autocomplete="off" v-model="time_table.week" required/>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Time Slot </label>
                                <div class="col-md-9">
                                  <input type="time" class="form-control round" autocomplete="off" v-model="time_table.time_slot"/>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Monday </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="time_table.monday" required>
                                    <option value=""></option>
                                    <option v-for="monday in mondays" v-bind:key="monday.id" v-bind:value="monday.id"> {{ monday.subject_name }} </option>
                                </select>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Thuesday </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="time_table.tuesday" required>
                                    <option value=""></option>
                                    <option v-for="tuesday in tuesdays" v-bind:key="tuesday.id" v-bind:value="tuesday.id"> {{ tuesday.subject_name }} </option>
                                </select>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Wednesday </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="time_table.wednesday" required>
                                    <option value=""></option>
                                    <option v-for="wednesday in wednesdays" v-bind:key="wednesday.id" v-bind:value="wednesday.id"> {{ wednesday.subject_name }} </option>
                                </select>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Thursday </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="time_table.thursday" required>
                                    <option value=""></option>
                                    <option v-for="thursday in thursdays" v-bind:key="thursday.id" v-bind:value="thursday.id"> {{ thursday.subject_name }} </option>
                                </select>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Friday </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="time_table.friday" required>
                                    <option value=""></option>
                                    <option v-for="friday in fridays" v-bind:key="friday.id" v-bind:value="friday.id"> {{ friday.subject_name }} </option>
                                </select>
                                </div>
                              </div>

                          </div>
                    </div>
                  </p>
                </div>
                <div class="modal-footer">
                      <button type="reset" class="btn btn-default btn-outline">Reset</button>
                      <button type="submit" class="btn btn-primary pull-right">Create New TimeTable </button>
                </div>
              </div>
            </div>
          </div>
        </form>
         <!-- End Modal -->



        <!-- TIMETABLE Modal -->
        <form @submit.prevent="addFee" class="form-horizontal">
          <div class="modal fade modal-just-me" id="addFeeModal" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1" style="margin-top: 36px">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="close_x">X</span>
                  </button>
                  <h4 class="modal-title"> <i class="icon wb-library" aria-hidden="true"> </i> New Fee</h4>
                </div>
                <div class="modal-body">
                    <p>
                      <div class="example-wrap">
                          <div class="example">

                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Fee Name </label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control round" autocomplete="off" v-model="fee.fee_name" required/>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Type </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="fee.fee_type_id" required>
                                    <option value=""></option>
                                    <option value="1">Primary</option>
                                    <option value="2">Junior Secondary</option>
                                    <option value="3">Senior Secondary</option>
                                </select>
                                </div>
                              </div>
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Currency </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="fee.currency" required>
                                    <option value=""></option>
                                    <option value="1">Naira</option>
                                    <option value="2">Dollar</option>
                                    <option value="3">Euro</option>
                                    <option value="4">Others</option>
                                </select>
                                </div>
                              </div>

                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Amount </label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control round" autocomplete="off" v-model="fee.amount" required/>
                                </div>
                              </div>
                                
                                
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label"> Class </label>
                                <div class="col-md-9">
                                  <select class="form-control round" v-model="fee.class_id" required>
                                    <option value=""></option>
                                    <option v-for="classs in classed" v-bind:key="classs.id" v-bind:value="classs.id"> {{ classs.class_name }} </option>
                                </select>
                                </div>
                              </div>

                              <div class="form-group row">
                                <label class="col-md-3 form-control-label">Frequency </label>
                                <div class="col-md-9">
                                  <input type="text" class="form-control round" autocomplete="off" v-model="fee.frequency" required/>
                                </div>
                              </div>

                          </div>
                    </div>
                  </p>
                </div>
                <div class="modal-footer">
                      <button type="reset" class="btn btn-default btn-outline">Reset</button>
                      <button type="submit" class="btn btn-primary pull-right">Create New Fee </button>
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
                allClasses: [],
                search: '',
                classes: [], 
                classe: {
                    id: '',
                    class_name: '',
                    class_type: '',
                    session_id: '',
                    status_id: ''
                },

                allSubjects: [],
                search: '',
                classed: [],
                subjects: [], 
                subject: {
                    id: '',
                    subject_name: '',
                    subject_type: '',
                    class_id: '',
                    session_id: ''
                },

                allStudents: [],
                search: '',
                classed: [],
                states: [],
                students: [], 
                student: {
                    id: '',
                    registration_no: '',
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
                    status_id: '1'
                },

                allStaffs: [],
                search: '',
                states: [],
                designation: [],
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
                    role_id: '',
                    state_id: '',
                    nationality: '',
                    session_id: '',
                    status_id: '1'
                },

                allTimeTables: [],
                search: '',
                sessions: [],
                classed: [],
                mondays: [],
                tuesdays: [],
                wednesdays: [],
                thursdays: [],
                fridays: [],
                time_tables: [], 
                time_table: {
                    id: '',
                    session_id: '',
                    class_id: '',
                    term_id: '',
                    week: '',
                    time_slot: '',
                    monday: '',
                    tuesday: '',
                    wednesday: '',
                    thursday: '',
                    friday: '',
                    status_id: '1'
                },

                allfees: [],
                search: '',
                classed: [],
                fees: [], 
                fee: {
                    id: '',
                    fee_name: '',
                    fee_type_id: '',
                    currency: '',
                    amount: '',
                    class_id: '',
                    session_id: '',
                    frequency: ''
                },


                classe_id: '',
                subject_id: '',
                student_id: '',
                m: 'Male',
                f: 'Female',
                avatar: null,
                staff_id: '',
                time_table_id: '',
                fee_id: '',
                pagination: {},
                edit: false,
                dataNull:false,
                session_detail: ''
            }
        },



        created()
        {

            this.session_id = this.$route.params.id;

            this.fetchClasses();
            this.fetchAllClasses();

            this.fetchSubjects();
            this.fetchAllSubjects();

            this.fetchState();
            this.fetchStudents();
            this.fetchAllStudents()

            this.fetchStaffs();
            this.fetchAllStaffs();
            this.fetchDesignation();

            this.fetchTimeTables();
            this.fetchAllTimeTables()

            this.fetchFees();



            this.id = this.$route.params.id;
            this.fetchSessionObject();


            this.fetchClassed();
            this.fetchSessiones();

            this.fetchMonday();
            this.fetchTuesday();
            this.fetchWednesday();
            this.fetchThursday();
            this.fetchFriday();
        },


        computed: {
            filteredClasses: function()
            {
                return this.classes.filter((classe) => {
                    return classe.class_name.toLowerCase().match(this.search.toLowerCase()) ||
                           classe.session.session_name.toLowerCase().match(this.search.toLowerCase())
                });
            },

            filteredSubjects: function()
            {
                return this.subjects.filter((subject) => {
                    return subject.subject_name.toLowerCase().match(this.search.toLowerCase())
                });
            },

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
                           student.state.state_name.toLowerCase().match(this.search.toLowerCase())
                });
            },

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
                           staff.designation.designation_name.toLowerCase().match(this.search.toLowerCase())
                });
            },

            filteredTimeTables: function()
            {
                return this.time_tables.filter((time_table) => {
                     return time_table.week.toLowerCase().match(this.search.toLowerCase()) ||
                            time_table.classed.class_name.toLowerCase().match(this.search.toLowerCase()) ||
                            time_table.time_slot.toLowerCase().match(this.search.toLowerCase()) ||
                            time_table.monday.subject_name.toLowerCase().match(this.search.toLowerCase()) ||
                            time_table.tuesday.subject_name.toLowerCase().match(this.search.toLowerCase()) ||
                            time_table.wednesday.subject_name.toLowerCase().match(this.search.toLowerCase()) ||
                            time_table.thursday.subject_name.toLowerCase().match(this.search.toLowerCase()) ||
                            time_table.friday.subject_name.toLowerCase().match(this.search.toLowerCase())
                });
            },

            filteredFees: function()
            {
                return this.fees.filter((fee) => {
                    return fee.fee_name.toLowerCase().match(this.search.toLowerCase())||
                           fee.amount.toLowerCase().match(this.search.toLowerCase()) || 
                           fee.frequency.toLowerCase().match(this.search.toLowerCase()) || 
                           fee.classed.class_name.toLowerCase().match(this.search.toLowerCase()) || 
                           fee.session.session_name.toLowerCase().match(this.search.toLowerCase())
                });
            }
        },


        methods:{

            fetchSessionObject()
            {                
                fetch('/api/session-by-id/' + this.$route.params.id,{
                    method:'GET'
                }).then(res=>res.json())
                .then(res=>{
                    console.log(res);
                    if (res.data)
                    {
                      this.session_detail = res.data;
                    }else{
                       this.dataNull = true;
                    }
                    // toastr.success('fetched... ');
                });
            },



            // CLASSES
            fetchAllClasses(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/classes?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allClasses = res.data;
                    // vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
            },

            fetchClasses(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/classes'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.classes = res.data;
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

            deleteClass(id)
            {
                if(confirm('Are You Sure You Want To Delete This Class ?'))
                {
                    fetch(`api/classe/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success('The Class Record Has Been Deleted');
                        this.fetchClasses();
                    })
                    .catch(err => console.log(err));
                }
            },

            addClass()
            {
                this.classe.session_id = this.$route.params.id;
                if(this.edit === false)
                {
                    fetch('api/classe', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.classe),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearClassForm()
                        toastr.success('Class Has Been created Successfully');
                        this.fetchClasses();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addClassModal').trigger('click');

                }
                else
                { 
                    this.classe.session_id = this.$route.params.id;               
                    fetch('api/classe', 
                    {
                        method: 'put',
                        body: JSON.stringify(this.classe),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearClassForm();
                        toastr.success('Class Was Updated Successfully');
                        this.fetchClasses();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                    $('#addClassModal').trigger('click');
                }
            },

            editClass(classe)
            {
                this.edit = true;
                this.classe.id = classe.id;
                this.class.classe_id = classe.id;
                this.classe.class_name = classe.class_name;
                this.classe.class_type = classe.class_type;
            },

            clearClassForm()
            {
                this.classe.class_name = '';
                this.classe.class_type = '';
            },




            // ######## SUBJECT ###########
            fetchAllSubjects(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/subjects?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allSubjects = res.data;
                    // vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
            },


            fetchSubjects(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/subjects'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.subjects = res.data;
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

            deleteSubject(id)
            {
                if(confirm('Are You Sure You Want To Delete This Subject ?'))
                {
                    fetch(`api/subject/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success('The Subject Has Been Deleted');
                        this.fetchSubjects();
                    })
                    .catch(err => console.log(err));
                }
            },

            addSubject()
            {
                this.subject.session_id = this.$route.params.id;
                if(this.edit === false)
                {
                    fetch('api/subject', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.subject),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearSubjectForm()
                        toastr.success('Subject Has Been created Successfully');
                        this.fetchSubjects();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addSubjectModal').trigger('click');

                }
                else
                {
                    this.subject.session_id = this.$route.params.id;
                    fetch('api/subject', 
                    {
                        method: 'put',
                        body: JSON.stringify(this.subject),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearSubjectForm();
                        toastr.success('Subject Was Updated Successfully');
                        this.fetchSubjects();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                    $('#addSubjectModal').trigger('click');
                }
            },

            editSubject(subject)
            {
                this.edit = true;
                this.subject.id = subject.id;
                this.subject.subject_id = subject.id;
                this.subject.subject_name = subject.subject_name;
                this.subject.subject_type = subject.subject_type;
                this.subject.class_id = subject.class_id;
            },



            clearSubjectForm()
            {
                this.subject.subject_name = '';
                this.subject.subject_type = '';
                this.subject.class_id = '';
            },






            // ####### STUDENTS ######
            getImage(e)
            {
                let image = e.target.files[0];
                let reader = new FileReader();    
                reader.readAsDataURL(image);
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
                    // vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
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
                this.student.session_id = this.$route.params.id;
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
                        this.clearStudentForm()
                        toastr.success('Student Has Been created Successfully');
                        this.fetchStudents();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addStudentModal').trigger('click');

                }
                else
                {
                    this.student.session_id = this.$route.params.id;
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
                        this.clearStudentForm();
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



            clearStudentForm()
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










            //#############   STAFF ############
            getStaffImage(e)
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
                        toastr.success('The Staff Record Has Been Deleted');
                        this.fetchStaffs();
                    })
                    .catch(err => console.log(err));
                }
            },

            addStaff()
            {
                this.staff.session_id = this.$route.params.id;
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
                        this.clearStaffForm()
                        toastr.success('Staff Has Been created Successfully');
                        this.fetchStaffs();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addStaffModal').trigger('click');

                }
                else
                {
                    this.staff.session_id = this.$route.params.id;
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
                        this.clearStaffForm();
                        toastr.success('Staff Was Updated Successfully');
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
                this.staff.registration_no = staff.registration_no;
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
                this.staff.role_id = staff.role_id;
                this.staff.state_id = staff.state_id;
                this.staff.nationality = staff.nationality;
                this.staff.photo = staff.photo;
            },



            clearStaffForm()
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
                this.staff.role_id = '';
                this.staff.photo = '';
            },

            exportStaffPDF()
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
                    {role_id: "role_id", dataKey: "role_id"},
                    {doj: "doj", dataKey: "doj"},
                    {state_id: "state_id", dataKey: "state_id"},
                    {nationality: "nationality", dataKey: "nationality"}
                ];

                var doc = new jsPDF('p', 'pt');
                doc.autoTable(columns, vm.allStaffs );
                doc.save('All Staffs.pdf');
            },









            //####### TIMETABLE ########
            fetchAllTimeTables(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/time_tables?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allTimeTables = res.data;
                })
                .catch(err => console.log(err));
            },


            fetchTimeTables(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/time_tables'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.time_tables = res.data;
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

            deleteTimeTable(id)
            {
                if(confirm('Are You Sure You Want To Delete Academic TimeTable ?'))
                {
                    fetch(`api/time_table/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success('The TimeTable Record Has Been Deleted');
                        this.fetchTimeTables();
                    })
                    .catch(err => console.log(err));
                }
            },

            addTimeTable()
            {
                this.time_table.session_id = this.$route.params.id;
                if(this.edit === false)
                {
                    fetch('api/time_table', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.time_table),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearTimeTableForm()
                        toastr.success('TimeTable Has Been created Successfully');
                        this.fetchTimeTables();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addTimeTableModal').trigger('click');

                }
                else
                {
                    this.time_table.session_id = this.$route.params.id;
                    fetch('api/time_table', 
                    {
                        method: 'put',
                        body: JSON.stringify(this.time_table),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearTimeTableForm();
                        toastr.success('TimeTable Was Updated Successfully');
                        this.fetchTimeTables();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                    $('#addTimeTableModal').trigger('click');
                }
            },

            editTimeTable(time_table)
            {
                this.edit = true;
                this.time_table.id = time_table.id;
                this.time_table.time_table_id = time_table.id;
                this.time_table.session_id = time_table.session_id;
                this.time_table.class_id = time_table.class_id;
                this.time_table.term_id = time_table.term_id;
                this.time_table.week = time_table.week;
                this.time_table.time_slot = time_table.time_slot;
                this.time_table.monday = time_table.monday;
                this.time_table.tuesday = time_table.tuesday;
                this.time_table.wednesday = time_table.wednesday;
                this.time_table.thursday = time_table.thursday;
                this.time_table.friday = time_table.friday;
                this.time_table.status_id = time_table.status_id;
            },



            clearTimeTableForm()
            {
                this.time_table.session_id = '';
                this.time_table.class_id = '';
                this.time_table.term_id = '';
                this.time_table.week = '';
                this.time_table.time_slot = '';
                this.time_table.monday = '';
                this.time_table.tuesday = '';
                this.time_table.wednesday = '';
                this.time_table.thursday = '';
                this.time_table.friday = '';
                this.time_table.status_id = '';
            },

            exportTimePDF()
            {
                var vm = this
                var columns = [
                    {session_id: "session_id", dataKey: "session_id"},
                    {class_id: "class_id", dataKey: "class_id"},
                    {term_id: "term_id", dataKey: "term_id"},
                    {week: "week", dataKey: "week"},
                    {time_slot: "time_slot", dataKey: "time_slot"},
                    {monday: "monday", dataKey: "monday"},
                    {tuesday: "tuesday", dataKey: "tuesday"},
                    {wednesday: "wednesday", dataKey: "wednesday"},
                    {thursday: "thursday", dataKey: "thursday"},
                    {friday: "friday", dataKeygender: "friday"},
                    {status_id: "status_id", dataKey: "status_id"}
                ];

                var doc = new jsPDF('p', 'pt');
                doc.autoTable(columns, vm.allTimeTables );
                doc.save('All TimeTable.pdf');
            },







            //####### FEES #########
            fetchAllFees(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/fees?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allFees = res.data;
                    // vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
            },


            fetchFees(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/fees'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.fees = res.data;
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

            deleteFee(id)
            {
                if(confirm('Are You Sure You Want To Delete This Fee ?'))
                {
                    fetch(`api/fees/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success('The Fee Has Been Deleted');
                        this.fetchFees();
                    })
                    .catch(err => console.log(err));
                }
            },

            addFee()
            {
                this.fee.session_id = this.$route.params.id;
                if(this.edit === false)
                {
                    fetch('api/fee', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.fee),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearFeeForm()
                        toastr.success('Fee Has Been created Successfully');
                        this.fetchFees();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addFeeModal').trigger('click');

                }
                else
                {
                    this.fee.session_id = this.$route.params.id;
                    fetch('api/fee', 
                    {
                        method: 'put',
                        body: JSON.stringify(this.fee),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearFeeForm();
                        toastr.success('Fee Was Updated Successfully');
                        this.fetchFees();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                    $('#addFeeModal').trigger('click');
                }
            },

            editFee(fee)
            {
                this.edit = true;
                this.fee.id = fee.id;
                this.fee.fee_id = fee.id;
                this.fee.fee_name = fee.fee_name;
                this.fee.fee_type_id = fee.fee_type_id;
                this.fee.currency = fee.currency;
                this.fee.amount = fee.amount;
                this.fee.class_id = fee.class_id;
                this.fee.session_id = fee.session_id;
                this.fee.frequency = fee.frequency;
            },



            clearFeeForm()
            {
                this.fee.fee_name = '';
                this.fee.fee_type_id = '';
                this.fee.currency = '';
                this.fee.amount = '';
                this.fee.class_id = '';
                this.fee.session_id = '';
                this.fee.frequency = '';
            },

















            fetchClassed()
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
                let sessiones = '/api/sessions'
                fetch(sessiones)
                .then(res => res.json())
                .then(res => {
                    this.sessiones = res;
                })
                .catch(err => console.log(err));            
            },



            fetchMonday()
            {
                let mondays = '/api/subjects'
                fetch(mondays)
                .then(res => res.json())
                .then(res => {
                    this.mondays = res;
                })
                .catch(err => console.log(err));            
            },

            fetchTuesday()
            {
                let tuesdays = '/api/subjects'
                fetch(tuesdays)
                .then(res => res.json())
                .then(res => {
                    this.tuesdays = res;
                })
                .catch(err => console.log(err));            
            },

            fetchWednesday()
            {
                let wednesdays = '/api/subjects'
                fetch(wednesdays)
                .then(res => res.json())
                .then(res => {
                    this.wednesdays = res;
                })
                .catch(err => console.log(err));            
            },

            fetchThursday()
            {
                let thursdays = '/api/subjects'
                fetch(thursdays)
                .then(res => res.json())
                .then(res => {
                    this.thursdays = res;
                })
                .catch(err => console.log(err));            
            },

            fetchFriday()
            {
                let fridays = '/api/subjects'
                fetch(fridays)
                .then(res => res.json())
                .then(res => {
                    this.fridays = res;
                })
                .catch(err => console.log(err));            
            },



            fetchDesignation()
            {
                let designations = '/api/designations'
                fetch(designations)
                .then(res => res.json())
                .then(res => {
                    this.designations = res;
                })
                .catch(err => console.log(err));            
            },
            
        }
    };
</script>



<template>

    <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

    <div class="row">
          <div class="col-xl-2 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px"> Subjects 

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
              <subjectExcelExport :data="allSubjects" :file_name="'All Subject'"></subjectExcelExport>           

              <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addSubjectModal" data-toggle="modal" 
            data-original-title="Add New Subject" @click="clearForm()">    <i class="icon wb-plus" aria-hidden="true"></i>
              </button>              
          </div>
      </div>

    

      <div class="panel" style="">
        <div class="row page-content">
          <div class="col-md-12">


            <!-- Example Basic -->
              <div class="example-wrap">
                <div class="page-header" style="padding: 0px 0px 1px 0px; margin-top: -20px">



                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead class="thead-dark">
                              <tr>
                                <th>Subject Name</th>
                                <th>Subject Type</th>
                                <th>Class </th>
                                <th>Academic Session </th>
                                <th>Status</th>
                                <th style="text-align: right;">Action</th>
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
                                <td style="text-align: right;">
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



                    <!-- Modal -->
                    <form @submit.prevent="addSubject">
                        <div class="modal fade modal-just-me" id="addSubjectModal">
                            <div class="modal-dialog">
                              <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">X</span>  </button>
                            <h4 class="modal-title">New Subject</h4>
                          </div>

                              <div class="modal-body">

                                    <div class="example-wrap">
                                          <div class="example">

                                              <div class="form-group row">
                                                <label class="col-md-3 control-label">Subject Name </label>
                                                <div class="col-md-9">
                                                  <input type="text" class="form-control round" autocomplete="off" v-model="subject.subject_name" required/>
                                                </div>
                                              </div>
                                                
                                              <div class="form-group row">
                                                <label class="col-md-3 control-label">Type </label>
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
                                                  <label for="class_id" class="col-md-3 control-label">Class</label>
                                                <div class="col-md-9">
                                                  <select class="form-control round" v-model="subject.class_id" required>
                                                    <option value=""></option>
                                                    <option v-for="classs in classed" v-bind:value="classs.id" v-bind:key="classs.id"> {{ classs.class_name }} </option>
                                                  </select>
                                                </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="session_id" class="col-md-3 control-label">Session</label>
                                                <div class="col-md-9">
                                                  <select class="form-control round" v-model="subject.session_id" required>
                                                    <option value=""></option>
                                                    <option v-for="session in sessiones" v-bind:value="session.id" v-bind:key="session.id"> {{ session.session_name }} </option>
                                                  </select>
                                                </div>
                                               </div>
                                                
                                             
                                              <div class="form-group row">
                                                <div class="col-md-6 offset-md-0" style="text-align:left">
                                                  <button type="reset" class="btn btn-outline btn-warning btn-round">Clear</button>
                                                </div>
                                                
                                                <div class="col-md-6 offset-md-0" style="text-align:right">
                                                  <button type="submit" class="btn btn-dark btn-round">Create New Subject </button>
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
</div>
</div>
        

</template>












<script>
    export default
    {
        data()
        {
            return{
                allSubjects: [],
                search: '',
                classed: [],
                sessiones: [],
                subjects: [], 
                subject: {
                    id: '',
                    subject_name: '',
                    subject_type: '',
                    class_id: ''
                },
                subject_id: '',
                pagination: {},
                edit: false
            }
        },

        mounted()
        {
            // console.log('Component Mounted.')
        },


        created()
        {
            this.fetchSubjects();
            this.fetchAllSubjects();
            this.fetchClasses();
            this.fetchSessions();
        },

        computed: {
            filteredSubjects: function()
            {
                return this.subjects.filter((subject) => {
                    return subject.subject_name.toLowerCase().match(this.search.toLowerCase()) ||
                           subject.classed.class_name.toLowerCase().match(this.search.toLowerCase()) ||
                           subject.session.session_name.toLowerCase().match(this.search.toLowerCase())
                });
            }

        },
        methods:{


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
                        toastr.success('Subject Has Been Deleted Successfully');
                        this.fetchSubjects();
                        this.edit = false;
                    })
                    .catch(err => console.log(err));
                }
            },

            addSubject()
            {
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
                        this.clearForm()
                        toastr.success('Subject Has Been Created Successfully');
                        this.fetchSubjects();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addSubjectModal').trigger('click');

                }
                else
                {
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
                        this.clearForm();
                        toastr.success('Subject Has Been Updated Successfully');
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
                this.subject.session_id = subject.session_id;
            },



            clearForm()
            {
                this.subject.subject_name = '';
                this.subject.subject_type = '';
                this.subject.class_id = '';
                this.subject.session_id = '';
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
            }
        }
    };
</script>


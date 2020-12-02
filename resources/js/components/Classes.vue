
<template>

    <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

    <div class="row">
          <div class="col-xl-2 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px">Classes 

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
              <classExcelExport :data="allClasses" :file_name="'All Classes'"></classExcelExport>            

              <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addClassModal" data-toggle="modal" 
                    data-original-title="Add New Class" @click="clearForm()" style="">  <i class="icon wb-plus" aria-hidden="true"></i>
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
                    <table class="table table-striped">
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
                                <a class="pull-right" data-toggle="modal" data-target="#addClassModal" @click="editClass(classe)">
                                    <span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                                </a>
                                <a class="pull-right" @click="deleteClass(classe.id)"><span class="fa fa-trash text-inverse m-r-10" 
                                    style="margin :1px 2px; color: red"></span>
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



                    <!-- Modal -->
                    <form @submit.prevent="addClass">
                        <div class="modal fade modal-just-me" id="addClassModal">
                            <div class="modal-dialog">
                              <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">X</span>  </button>
                            <h4 class="modal-title">New Class</h4>
                          </div>

                          <div class="modal-body">



                                 <div class="example-wrap">
                                      <div class="example">

                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Class Name </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="classe.class_name" required/>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Type </label>
                                            <div class="col-md-9">
                                              <select class="form-control round" v-model="classe.class_type" required>
                                                <option value=""></option>
                                                <option value="1">Primary</option>
                                                <option value="2">Junior Secondary</option>
                                                <option value="3">Senior Secondary</option>
                                            </select>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                              <label for="session_id" class="col-md-3 control-label">Session</label>
                                            <div class="col-md-9">
                                              <select class="form-control round" v-model="classe.session_id" required>
                                                <option value=""></option>
                                                <option v-for="session in sessiones" v-bind:value="session.id"> {{ session.session_name }} </option>
                                              </select>
                                            </div>
                                           </div>

                                            
                                         
                                          <div class="form-group row">
                                            <div class="col-md-6 offset-md-0" style="text-align:left">
                                              <button type="reset" class="btn btn-outline btn-warning btn-round">Reset</button>
                                            </div>
                                            
                                            <div class="col-md-6 offset-md-0" style="text-align:right">
                                              <button type="submit" class="btn btn-dark btn-round">Create New Class </button>
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
                allClasses: [],
                search: '',
                sessiones: [], 
                classes: [], 
                classe: {
                    id: '',
                    class_name: '',
                    class_type: '',
                    status_id: '',
                    session_id: ''
                },
                classe_id: '',
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
            this.fetchClasses();
            this.fetchAllClasses();
            this.fetchSessions();
        },

        computed: {
            filteredClasses: function()
            {
                return this.classes.filter((classe) => {
                    return classe.class_name.toLowerCase().match(this.search.toLowerCase()) ||
                           classe.session.session_name.toLowerCase().match(this.search.toLowerCase())
                });
            }

        },

        methods:{

            fetchAllClasses(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/classes?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allClasses = res.data;
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
                        toastr.success('Class Has Been Deleted Successfully');

                        this.fetchClasses();
                    })
                    .catch(err => console.log(err));
                }
            },

            addClass()
            {
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
                        this.clearForm()
                        toastr.success('Class Has Been created Successfully');
                        this.fetchClasses();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addClassModal').trigger('click');

                }
                else
                {
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
                        this.clearForm();
                        toastr.success('Class Has Been Updated Successfully');
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
                this.classe.classe_id = classe.id;
                this.classe.class_name = classe.class_name;
                this.classe.session_id = classe.session_id;
                this.classe.class_type = classe.class_type;
            },

            clearForm()
            {
                this.classe.class_name = '';
                this.classe.class_type = '';
                this.classe.session_id = '';
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


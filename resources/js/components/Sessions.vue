
<template>
    <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

      <div class="row">
          <div class="col-xl-3 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px"> Academic Session 

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
              <sessionExcelExport :data="allSessions" :file_name="'All Session'" class="pull-left"></sessionExcelExport>

            <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addSessionModal" data-toggle="modal" data-original-title="Add New Session" 
                @click="clearForm()" style="">  <i class="icon wb-plus" aria-hidden="true"></i>
            </button>              
          </div>
      </div>

      
      <div class="panel" style="margin-top: -10px">
        <div class="row page-content">
          <div class="col-md-12">


            <!-- Example Basic -->
              <div class="example-wrap">
                <div class="page-header" style="padding: 0px 0px 1px 0px; margin-top: -20px">
                  <!-- <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>        <li class="breadcrumb-item active">Gradings</li>
                  </ol> -->

                  
                      

                

                <div class="example table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                          <tr>
                            <th>Session Name</th>
                            <th>Start Date</th>
                            <th>End Date </th>
                            <th style="text-align: right;">Actions </th>
                          </tr>
                        </thead>
                        <tbody v-for="session in filteredSessions" v-bind:key="session.id">
                          <tr style="background: #fff">
                            <td>{{session.session_name}}</td>
                            <td>{{session.start_date}}</td>
                            <td>{{session.end_date}}</td>
                            <td style="text-align: right;">
                                <a class="pull-right" data-toggle="tooltip" title="Create A Time Table For This Academic Session">
                                    <router-link class="" v-bind:to="'/configure_session/' + session.id" style="">
                                        <span class="fa fa-calendar text-inverse m-r-10" style="margin :1px 2px; color: #6cb2eb"></span>
                                    </router-link>
                                </a>
                                <a class="pull-right" data-toggle="modal" data-target="#addSessionModal" 
                                    @click="editSession(session)"><span class="fa fa-pencil text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                                </a>
                                <a class="pull-right" @click="deleteSession(session.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span>
                                </a>
                            </td>
                          </tr>
                        </tbody>
                    </table>
            

                    <nav aria-label="Page navigation example pull-right">
                        <ul class="pagination pagination-sm">
                          <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchSessions(pagination.prev_page_url)">Prev</a></li>
                          <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                          <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchSessions(pagination.next_page_url)">Next</a></li>
                        </ul>
                    </nav>

                </div>

              </div>



            <!-- Modal -->
            <form @submit.prevent="addSession">
                    <div class="modal fade modal-just-me" id="addSessionModal">
                        <div class="modal-dialog">
                          <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">X</span>  </button>
                        <h4 class="modal-title">New Academic Session</h4>
                      </div>

                      <div class="modal-body">



                             <div class="example-wrap">
                                  <div class="example">

                                      <div class="form-group row">
                                        <label class="col-md-3 control-label">Session Name </label>
                                        <div class="col-md-9">
                                          <input type="text" class="form-control round" autocomplete="off" v-model="session.session_name" required/>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label class="col-md-3 control-label">Start Date </label>
                                        <div class="col-md-9">
                                          <input type="date" class="form-control round" autocomplete="off" v-model="session.start_date" required/>
                                        </div>
                                      </div>

                                      <div class="form-group row">
                                        <label class="col-md-3 control-label">End Date </label>
                                        <div class="col-md-9">
                                          <input type="date" class="form-control round" autocomplete="off" v-model="session.end_date" required/>
                                        </div>
                                      </div>

                                        
                                     
                                      <div class="form-group row">
                                        <div class="col-md-6 offset-md-0" style="text-align:left">
                                          <button type="reset" class="btn btn-outline btn-warning btn-round">Reset</button>
                                        </div>
                                        
                                        <div class="col-md-6 offset-md-0" style="text-align:right">
                                          <button type="submit" class="btn btn-dark btn-round">Create New Session </button>
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





        

</template>












<script>
    export default
    {
        data()
        {
            return{
                allSession: [],
                search: '',
                sessions: [], 
                session: {
                    id: '',
                    session_name: '',
                    start_date: '',
                    end_date: ''
                },
                session_id: '',
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
            this.fetchSessions();
            this.fetchAllSessions();
        },

        computed: {
            filteredSessions: function()
            {
                return this.sessions.filter((session) => {
                    return session.session_name.toLowerCase().match(this.search.toLowerCase())
                });
            }

        },

        methods:{

            fetchAllSessions(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/sessions?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allSessions = res.data;
                    // vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
            },

            fetchSessions(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/sessions'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.sessions = res.data;
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

            deleteSession(id)
            {
                if(confirm('Are You Sure You Want To Delete This Academic Session ?'))
                {
                    fetch(`api/session/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success('Academic Session Has Been Deleted');
                        this.fetchSessions();
                        this.edit = false;
                    })
                    .catch(err => console.log(err));
                }
            },

            addSession()
            {
                if(this.edit === false)
                {
                    fetch('api/session', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.session),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm()
                        toastr.success('Academic Session Has Been created Successfully');
                        this.fetchSessions();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addSessionModal').trigger('click');

                }
                else
                {
                    fetch('api/session', 
                    {
                        method: 'put',
                        body: JSON.stringify(this.session),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        toastr.success('Session Was Updated Successfully');
                        this.fetchSessions();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                    $('#addSessionModal').trigger('click');
                }
            },

            editSession(session)
            {
                this.edit = true;
                this.session.id = session.id;
                this.session.session_id = session.id;
                this.session.session_name = session.session_name;
                this.session.start_date = session.start_date;
                this.session.end_date = session.end_date;
            },



            clearForm()
            {
                this.session.session_name = '';
                this.session.start_date = '';
                this.session.end_date = '';
            }
        }
    };
</script>


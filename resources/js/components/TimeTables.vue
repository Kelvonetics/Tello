
<style>
    .modal-sidebar
    {        
        height: 100%;
        right: 2px;
        position: fixed;
        width: 545px;          
        margin-top: 55px !important;
        margin-bottom: 0px !important;
        top: 0px;
        /*height: 98%;*/
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
    <div class="row" style="">

        <div class="col-md-12" style="padding: 0px">

            <div class="row">
                <div class="col-xl-9 col-md-7 col-sm-6" style=""><h2 style=""> Academic Time Table
                    <timeTableExcelExport :data="allTimeTables" :file_name="'All TimeTables'"></timeTableExcelExport>

                    <button class="btn btn-sm pull-right" style="border:thin line black; background:#202020; color:#fff;" @click="exportPDF"><i class="fa fa-file-pdf-o"> </i> PDF </button>
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

                    <button type="button" class="btn btn-success  btn-sm btn-iconbtn-outline btn-round" data-target="#addTimeTableModal" data-toggle="modal" 
                    data-original-title="Add New Academic Time Table" @click="clearForm()">    <i class="icon wb-plus" aria-hidden="true"></i>
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
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody v-for="time_table in filteredTimeTables" v-bind:key="time_table.id">
                      <tr style="background: #fff">
                        <td>{{time_table.session_id}}</td>
                        <td>{{time_table.class_id}}</td>
                        <td>{{time_table.term_id}}</td>
                        <td>{{time_table.week}}</td>
                        <td>{{time_table.time_slot}}</td>
                        <td>{{time_table.monday}}</td>
                        <td>{{time_table.tuesday}}</td>
                        <td>{{time_table.wednesday}}</td>
                        <td>{{time_table.thursday}}</td>
                        <td>{{time_table.friday}}</td>
                        <td>
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


                <!-- Modal -->
                <form @submit.prevent="addTimeTable" class="form-horizontal">
                    <div class="modal modal-lg fade" id="addTimeTableModal" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1" style="margin-top: 36px">
                      <div class="modal-dialog modal-sidebar modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">&times;</span>  </button>
                            <h4 class="modal-title">New TimeTable</h4>
                          </div>

                          <div class="modal-body">



                                 <div class="example-wrap">
                                      <div class="example"> 
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Session </label>
                                            <div class="col-md-9">
                                              <select class="form-control round" v-model="time_table.session_id" required>
                                                <option value=""></option>
                                                <option value="1">SESSION 2018 - 2019</option>
                                                <option value="2">SESSION 2019 - 2020</option>
                                                <option value="3">SESSION 2020 - 2021</option>
                                            </select>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Class </label>
                                            <div class="col-md-9">
                                              <select class="form-control round" v-model="time_table.class_id" required>
                                                <option value=""></option>
                                                <option value="1">Class One</option>
                                                <option value="2">Class Two</option>
                                                <option value="3">Class Three</option>
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
                                                <option value="1">Mathematics</option>
                                                <option value="2">English</option>
                                                <option value="3">Economics</option>
                                            </select>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Thuesday </label>
                                            <div class="col-md-9">
                                              <select class="form-control round" v-model="time_table.tuesday" required>
                                                <option value=""></option>
                                                <option value="1">Mathematics</option>
                                                <option value="2">English</option>
                                                <option value="3">Economics</option>
                                            </select>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Wednesday </label>
                                            <div class="col-md-9">
                                              <select class="form-control round" v-model="time_table.wednesday" required>
                                                <option value=""></option>
                                                <option value="1">Mathematics</option>
                                                <option value="2">English</option>
                                                <option value="3">Economics</option>
                                            </select>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Thursday </label>
                                            <div class="col-md-9">
                                              <select class="form-control round" v-model="time_table.thursday" required>
                                                <option value=""></option>
                                                <option value="1">Mathematics</option>
                                                <option value="2">English</option>
                                                <option value="3">Economics</option>
                                            </select>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 form-control-label">Friday </label>
                                            <div class="col-md-9">
                                              <select class="form-control round" v-model="time_table.friday" required>
                                                <option value=""></option>
                                                <option value="1">Mathematics</option>
                                                <option value="2">English</option>
                                                <option value="3">Economics</option>
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
                                              <button type="submit" class="btn btn-primary pull-right">Create New TimeTable </button>
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
                allTimeTables: [],
                search: '',
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
                time_table_id: '',
                edit: false
            }
        },


        created()
        {
            this.fetchTimeTables();
            this.fetchAllTimeTables()
        },

        computed: {
            filteredTimeTables: function()
            {
                return this.time_tables.filter((time_table) => {
                    return time_table.week.toLowerCase().match(this.search.toLowerCase()) ||
                           time_table.time_slot.toLowerCase().match(this.search.toLowerCase()) 
                });
            }
        },

        methods:{


            fetchAllTimeTables(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/time_tables?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allTimeTables = res.data;
                    // vm.makePagination(res.meta, res.links);
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
                        this.edit = false;
                    })
                    .catch(err => console.log(err));
                }
            },

            addTimeTable()
            {
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
                        this.clearForm()
                        toastr.success('TimeTable Has Been created Successfully');
                        this.fetchTimeTables();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addTimeTableModal').trigger('click');

                }
                else
                {
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
                        this.clearForm();
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



            clearForm()
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

            exportPDF()
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
            }
        }
    };


</script>


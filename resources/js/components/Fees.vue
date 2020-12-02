
<template>

    <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

    <div class="row">
          <div class="col-xl-2 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px">Fees 

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
              <!-- <classExcelExport :data="allClasses" :file_name="'All Classes'"></classExcelExport>             -->

              <button type="button" class="btn btn-sm btn-icon btn-inverse btn-round" data-target="#addFeeModal" data-toggle="modal" 
            data-original-title="Add New Fees" @click="clearForm()">    <i class="icon wb-plus" aria-hidden="true"></i>
              </button>              
          </div>
      </div>

    

      <div class="panel" style="margin-top:-10px">
        <div class="row page-content">
          <div class="col-md-12">


            <!-- Example Basic -->
              <div class="example-wrap">
                <div class="page-header" style="padding: 0px 0px 1px 0px; margin-top: -20px">

                  <div class="example table-responsive">
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


                    <nav aria-label="Page navigation example pull-right">
                        <ul class="pagination pagination-sm">
                          <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchFees(pagination.prev_page_url)">Prev</a></li>
                          <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                          <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchFees(pagination.next_page_url)">Next</a></li>
                        </ul>
                    </nav>

                </div>



                <!-- Modal -->
                <form @submit.prevent="addFee">
                    <div class="modal fade modal-just-in" id="addFeeModal" aria-hidden="true" aria-labelledby="examplePositionSidebar" role="dialog" tabindex="-1" style="">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-danger">X</span>  </button>
                            <h4 class="modal-title">New Fee</h4>
                          </div>

                            <div class="modal-body">

                                 <div class="example-wrap">
                                      <div class="example">

                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Fee Name </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="fee.fee_name" required/>
                                            </div>
                                          </div>
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Type </label>
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
                                            <label class="col-md-3 control-label">Currency </label>
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
                                            <label class="col-md-3 control-label">Amount </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="fee.amount" required/>
                                            </div>
                                          </div>
                                            
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label"> Class </label>
                                            <div class="col-md-9">
                                              <select class="form-control round" v-model="fee.class_id" required>
                                                <option value=""></option>
                                                <option v-for="classs in classed" v-bind:value="classs.id"> {{ classs.class_name }} </option>
                                            </select>
                                            </div>
                                          </div>
                                            
                                            
                                          <div class="form-group row">
                                            <label class="col-md-3 control-label"> Session </label>
                                            <div class="col-md-9">
                                              <select class="form-control round" v-model="fee.session_id" required>
                                                <option value=""></option>
                                                <option v-for="session in sessiones" v-bind:key="session.id" v-bind:value="session.id">{{ session.session_name }}</option>
                                            </select>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <label class="col-md-3 control-label">Frequency </label>
                                            <div class="col-md-9">
                                              <input type="text" class="form-control round" autocomplete="off" v-model="fee.frequency" required/>
                                            </div>
                                          </div>

                                            
                                         
                                          <div class="form-group row">
                                            <div class="col-md-6 offset-md-0" style="text-align:left">
                                              <button type="reset" class="btn btn-outline btn-warning btn-round">Reset</button>
                                            </div>
                                            
                                            <div class="col-md-6 offset-md-0" style="text-align:right">
                                              <button type="submit" class="btn btn-dark btn-round">Create New Fee </button>
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
                allfees: [],
                search: '',
                classed: [],
                sessiones: [],                 
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
                fee_id: '',
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
            this.fetchAllFees();
            this.fetchFees();
            this.fetchClasses();
            this.fetchSessions();
        },

        computed: {
            filteredFees: function()
            {
                return this.fees.filter((fee) => {
                    return fee.fee_name.toLowerCase().match(this.search.toLowerCase())||
                           fee.amount.toLowerCase().match(this.search.toLowerCase()) ||
                           fee.classed.class_name.toLowerCase().match(this.search.toLowerCase()) ||
                           fee.session.session_name.toLowerCase().match(this.search.toLowerCase()) || 
                           fee.frequency.toLowerCase().match(this.search.toLowerCase())
                });
            }

        },

        methods:{


            fetchAllFees(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/fees?all=1'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.allFees = res.data;
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
                        toastr.success('Fees Has Been Deleted Successfully');
                        this.fetchFees();
                    })
                    .catch(err => console.log(err));
                }
            },

            addFee()
            {
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
                        this.clearForm()
                        toastr.success('Fees Has Been Created Successfully');
                        this.fetchFees();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addFeeModal').trigger('click');

                }
                else
                {
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
                        this.clearForm();
                        toastr.success('Fees Has Been Updated Successfully');
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
                console.log(fee);
            },



            clearForm()
            {
                this.fee.fee_name = '';
                this.fee.fee_type_id = '';
                this.fee.currency = '';
                this.fee.amount = '';
                this.fee.class_id = '';
                this.fee.session_id = '';
                this.fee.frequency = '';
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


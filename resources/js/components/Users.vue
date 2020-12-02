
<template>
    <div class="row" style="">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-11"><h2 style="padding: ">Users</h2></div>
                <div class="col-md-1">
                    <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#addUserModal" @click="clearForm()">Add</button>
                </div>
            </div>


            <table class="table table-striped table-hover table-sm">
                <thead class="thead-dark">
                  <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>State</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody v-for="user in users" v-bind:key="user.id">
                  <tr style="background: #fff">
                    <td>{{user.firstname}}</td>
                    <td>{{user.lastname}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.phone}}</td>
                    <td>{{user.gender}}</td>
                    <td>{{user.state_id}}</td>
                    <td>
                        <a class="pull-right" data-toggle="modal" data-target="#addUserModal" 
                            @click="editUser(user)"><span class="fa fa-pen text-inverse m-r-10" style="margin :1px 2px; color: #396"></span>
                        </a>
                        <a class="pull-right" @click="deleteUser(user.id)"><span class="fa fa-trash text-inverse m-r-10" style="margin :1px 2px; color: red"></span>
                        </a>
                    </td>
                  </tr>
                </tbody>
            </table>
            

            <nav aria-label="Page navigation example pull-right">
                <ul class="pagination pagination-sm">
                  <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchUsers(pagination.prev_page_url)">Prev</a></li>
                  <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                  <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchUsers(pagination.next_page_url)">Next</a></li>
                </ul>
            </nav>



            <!-- Modal -->
            <form @submit.prevent="addUser">
                <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" style="">
                    <div class="modal-dialog" role="document" style="">
                            <div class="modal-content" style="">

                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Add User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-md-3 control-label">FirstName</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="firstname" v-model="user.firstname" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 control-label">LastName</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="lastname" v-model="user.lastname" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="email" v-model="user.email" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" placeholder="password" v-model="user.password" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Phone</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="phone" v-model="user.phone" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Address</label>
                                    <div class="col-md-9">
                                        <textarea type="text" class="form-control" placeholder="address" v-model="user.address" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Date Of Birth</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" placeholder="dob" v-model="user.dob" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Gender</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="user.gender" required>
                                            <option value=""></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 control-label">M - Status</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="user.marital_status" required>
                                            <option value=""></option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 control-label">State</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="user.state_id" required >
                                            <option v-for="state in states" v-bind:value="state.id">
                                                {{ state.state_name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Nationality</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Nationality" v-model="user.nationality" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Photo</label>
                                    <div class="col-md-9">
                                        <input type="file" name="photo" class="form-control" placeholder="Photo" @change="getImage">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 control-label">Preview</label>
                                    <div class="col-md-9">
                                        <img :src="avatar" alt="Preview" style="max-width: 150px; max-height: 100px">
                                    </div>
                                </div>
                
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                                </div>

                            </div>
                        </div><!-- modal-content -->
                    </div><!-- modal-dialog -->
                </div><!-- modal -->
            </form>
            
            
    


        </div>
    </div>





        

</template>












<script>
    export default
    {
        data(){
            return{
                states: [],
                users: [], 
                user: {
                    id: '',
                    firstname: '',
                    lastname: '',
                    email: '',
                    password: '',
                    phone: '',
                    address: '',
                    dob: '',
                    gender: '',
                    marital_status: '',
                    state_id: '',
                    nationality: '',
                    photo: ''
                },
                user_id: '',
                pagination: {},
                avatar: null,
                edit: false
            }
        },

        mounted()
        {
            console.log('Component Mounted.')
        },


        created()
        {
            this.fetchState();
            this.fetchUsers();
        },

        methods:{
            getImage(e)
            {
                let image = e.target.files[0];
                let reader = new FileReader();    
                reader.readAsDataURL(image);
                reader.onload = e =>{
                    // console.log(e);
                    this.avatar = e.target.result;
                    this.user.photo = e.target.result;

                    console.log(this.photo);
                }
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


            fetchUsers(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/users'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.users = res.data;
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

            deleteUser(id)
            {
                if(confirm('Are You Sure You Want To Delete This User Details?'))
                {
                    fetch(`api/user/${id}`, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(data => {
                        toastr.success('The User Record Has Been Deleted');
                        this.fetchUsers();
                        this.edit = false;
                    })
                    .catch(err => console.log(err));
                }
            },

            addUser()
            {
                if(this.edit === false)
                {
                    fetch('api/user', 
                    {
                        method: 'post',
                        body: JSON.stringify(this.user),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm()
                        toastr.success('User Has Been created Successfully');
                        this.fetchUsers();
                        this.edit = false;
                    })
                    .catch(err => console.log(err)); 
                    $('#addUserModal').trigger('click');

                }
                else
                {
                    fetch('api/user', 
                    {
                        method: 'put',
                        body: JSON.stringify(this.user),
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        this.clearForm();
                        toastr.success('User Has Been Updated');
                        this.fetchUsers();
                        this.edit = false;
                    }) 
                    .catch(err => console.log(err));
                    $('#addUserModal').trigger('click');
                }
            },

            editUser(user)
            {
                this.edit = true;
                this.user.id = user.id;
                this.user.user_id = user.id;
                this.user.firstname = user.firstname;
                this.user.lastname = user.lastname;
                this.user.email = user.email;
                this.user.password = user.password;
                this.user.phone = user.phone;
                this.user.address = user.address;
                this.user.dob = user.dob;
                this.user.gender = user.gender;
                this.user.marital_status = user.marital_status;
                this.user.state_id = user.state_id;
                this.user.nationality = user.nationality;
                this.user.photo = user.photo;
            },



            clearForm()
            {
                this.user.firstname = '';
                this.user.lastname = '';
                this.user.email = '';
                this.user.password = '';
                this.user.phone = '';
                this.user.address = '';
                this.user.dob = '';
                this.user.gender = '';
                this.user.marital_status = '';
                this.user.state_id = '';
                this.user.nationality = '';
                this.user.photo = '';
            }
        }
    };
</script>



<template>

  <!-- Page -->
  <!-- <div class="page" style="padding: -25px 0px 0px 0px;"> -->

      <!-- Page -->                                
    <div class="page">
      <div class="page-header">
        <h1 class="page-title">Student Yearbook  </h1>
        <div class="page-header-actions">
          <form>
            <div class="input-search">
              <i class="input-search-icon wb-search" aria-hidden="true"></i>
              <input type="text" class="form-control" name="" placeholder="Search ...">
            </div>
          </form>
        </div>
      </div>

      <div class="page-content">
        <div class="projects-sort">
          <span class="projects-sort-label">Sorted by : </span>
          <div class="inline-block dropdown">
            
              <select class="form-control round" v-model="year_book.session_id" required>
                <option value="">Session</option>
                <option v-for="session in sessiones" v-bind:key="session.id" v-bind:value="session.id">{{ session.session_name }} </option>
              </select>
              
          </div>
        </div>
        <div class="projects-wrap">
          <ul class="blocks blocks-100 blocks-xxl-5 blocks-lg-4 blocks-md-3 blocks-sm-2" data-plugin="animateList" data-child=">li">

            <li v-for="year_book in year_books" v-bind:key="year_book.id">
              <div class="panel" style="padding: 10px">
                <figure class="overlay overlay-hover animation-hover">
                  <img class="caption-figure overlay-figure" v-bind:src="year_book.photo" style="width:250; height:200;">
                  <figcaption class="overlay-panel overlay-background overlay-fade text-center vertical-align">
                    <div class="btn-group">
                      <div class="dropdown float-left">
                      </div>
                    </div>
                    <button type="button" class="btn btn-outline btn-default project-button text-light">
                      <router-link class="" v-bind:to="'/student-profile/' + year_book.registration_no" style="">
                        <span class="fa fa-male text-inverse m-r-10" style="margin :1px 2px; color: #fff; cursor: pointer;"> View Profile</span>
                      </router-link>
                    </button>
                  </figcaption>
                </figure>
                <div class="time float-right">{{year_book.classed.class_name}}</div>

                <div class="text-truncate">{{year_book.firstname}} {{year_book.lastname}}</div>
                <div class="text-truncate">{{year_book.email}}</div>
              </div>
            </li>

            
          </ul>
        </div>

        <nav aria-label="Page navigation example pull-right">
            <ul class="pagination pagination-sm">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchYearBooks(pagination.prev_page_url)">Prev</a></li>
                <li class="page-item disabled"><a class="page-link text-dark" href="#" >Page {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchYearBooks(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>
      </div>
    </div>

    
    
 <!-- </div> -->


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
                sessiones: [],
                year_books: [], 
                year_book: {
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
                    status_id: '1',
                    photo: ''
                },
                year_book_id: '',
                img_path: './assets/images/uploads/',
                m: 'Male',
                f: 'Female',
                pagination: {},
                avatar: null,
                edit: false
            }
        },


        created()
        {
            this.fetchAllYearBooks();
            this.fetchYearBooks()
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


            fetchAllYearBooks(page_url)
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


            fetchYearBooks(page_url)
            {
                let vm = this;
                page_url = page_url || '/api/year-books'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.year_books = res.data;
                    // this.img_path = ' + res.data.photo';
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


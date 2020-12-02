


<template>
  
  <!-- Page -->
  <div class="page">
    <div class="page-content container-fluid">
      <div class="row" data-plugin="matchHeight" data-by-row="true">
          <div class="col-xl-3 col-md-6">
          <!-- Widget Linearea One-->
          <a href="#">
            <div class="card card-shadow" id="widgetLineareaOne">
              <div class="card-block p-20 p-t-10">
                <div class="clearfix">
                  <div class="grey-800 pull-xs-left p-y-10">
                    <i class="fa fa-desktop font-size-24 vertical-align-bottom m-r-5" style="font-size:25px; color: red"></i>                  Exams Today
                  </div>
                  <span class="pull-xs-right grey-700 font-size-30">{{exams}}</span>
                </div>
                <div class="m-b-20 grey-500">
                  <i class="icon md-long-arrow-up red-500 font-size-16"></i> {{exams_completed}}% Completed Already
                </div>
                <div class="ct-chart h-50"></div>
              </div>
            </div>
          </a>
          <!-- End Widget Linearea One -->
          </div>
        
          <div class="col-xl-3 col-md-6">
            <a href="#">
                <!-- Widget Linearea Two -->
                <div class="card card-shadow" id="widgetLineareaTwo">
                  <div class="card-block p-20 p-t-10">
                    <div class="clearfix">
                      <div class="grey-800 pull-xs-left p-y-10">
                        <i class="fa fa-spinner fa-spin" style="font-size:25px; color: red"></i> Ongoing Exams
                      </div>
                      <span class="pull-xs-right grey-700 font-size-30"> {{total_live_exams}} </span>
                    </div>
                    <div class="m-b-20 grey-500">
                      <i class="icon md-long-arrow-up red-500 font-size-16"></i> {{exams_completed}}% Completed Already </div>
                    <div class="ct-chart h-50"></div>
                  </div>
                </div>
                <!-- End Widget Linearea Two -->
            </a>
          </div>
              
          <div class="col-xl-3 col-md-6">
              <a href="#">
                <!-- Widget Linearea Three -->
                <div class="card card-shadow" id="widgetLineareaThree">
                  <div class="card-block p-20 p-t-10">
                    <div class="clearfix">
                      <div class="grey-800 pull-xs-left p-y-10">
                        <i class="fa fa-users font-size-24 vertical-align-bottom m-r-5" style="font-size:25px; color: red"></i>                 Enlisted Candidates
                      </div>
                      <span class="pull-xs-right grey-700 font-size-30"> {{exam_users}} </span>
                    </div>
                    <div class="m-b-20 grey-500">
                      <i class="icon md-long-arrow-down red-500 font-size-16"></i> {{users_finished}}% of Candidates Done With Exam
                    </div>
                    <div class="ct-chart h-50"></div>
                  </div>
                </div>
              </a>
                <!-- End Widget Linearea Three -->
          </div>
              
          <div class="col-xl-3 col-md-6">
            <a href="#">
                <!-- Widget Linearea Four -->
                <div class="card card-shadow" id="widgetLineareaFour">
                  <div class="card-block p-20 p-t-10">
                    <div class="clearfix">
                      <div class="grey-800 pull-xs-left p-y-10">
                        <i class="fa fa-circle-o-notch fa-spin" style="font-size:25px; color: red"></i>                  Candidate Live
                      </div>
                      <span class="pull-xs-right grey-700 font-size-30"> {{total_live_users}} </span>
                    </div>
                    <div class="m-b-20 grey-500">
                      <i class="icon md-long-arrow-up red-500 font-size-16"></i> {{users_finished}}% of Candidates Done With Exam
                    </div>
                    <div class="ct-chart h-50"></div>
                  </div>
                </div>
              </a>
                <!-- End Widget Linearea Four -->
           </div>






          <div class="col-lg-6 masonry-item">
            <!-- Panel Projects -->
            <div class="panel" id="projects">
              <div class="panel-heading" style="padding: 0px ">
                <span class="panel-title">Ongoing Exams</span>
                <div class="panel-actions panel-actions-keep">
                  <div class="dropdown">
                    <a class="panel-action" id="examplePanelDropdown" data-toggle="dropdown" href="#"
                      aria-expanded="false" role="button"><i class="icon md-more-vert" aria-hidden="true"></i></a>
                    <div class="dropdown-menu dropdown-menu-bullet dropdown-menu-right" aria-labelledby="examplePanelDropdown"
                      role="menu">
                      <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-flag" aria-hidden="true"></i> Action</a>
                      <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-print" aria-hidden="true"></i> Another action</a>
                      <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-favorite" aria-hidden="true"></i> Something else here</a>
                      <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-share" aria-hidden="true"></i> Separated link</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-sm">
                  <thead>
                    <tr>
                      <td>Exam</td>
                      <td>Category</td>
                      <td>Date</td>
                      <td>Status</td>
                      <td>Actions</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="live_exam_detail in live_exam_details" v-bind:key="live_exam_detail.id">
                      <td>{{live_exam_detail.test_name}}</td>
                      <td> {{live_exam_detail.category_id}} </td>
                      <td>{{live_exam_detail.exam_date}}</td>
                      <td> <span data-plugin="peityPie" data-skin="blue"></span>     </td>
                      <td>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" data-original-title="Edit">
                          <i class="icon md-wrench" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" data-original-title="Edit">
                          <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- End Panel Projects -->
          </div>

          <div class="col-lg-3 masonry-item">
            <!-- Panel Projects -->
            <div class="panel" id="projects">
              <div class="panel-heading" style="padding: 0px ">
                <span class="panel-title">Inactive Candidates</span>
                <div class="panel-actions panel-actions-keep">
                  <div class="dropdown">
                    <a class="panel-action" id="examplePanelDropdown" data-toggle="dropdown" href="#"
                      aria-expanded="false" role="button"><i class="icon md-more-vert" aria-hidden="true"></i></a>
                    <div class="dropdown-menu dropdown-menu-bullet dropdown-menu-right" aria-labelledby="examplePanelDropdown"
                      role="menu">
                      <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-flag" aria-hidden="true"></i> Action</a>
                      <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-print" aria-hidden="true"></i> Another action</a>
                      <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-favorite" aria-hidden="true"></i> Something else here</a>
                      <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-share" aria-hidden="true"></i> Separated link</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-sm">
                  <thead>
                    <tr>
                      <td>Name</td>
                      <td>Exam</td>
                      <td>Actions</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Candidate 1</td>
                      <td> Scrum Exam </td>
                      <td> 
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" data-original-title="Edit">
                          <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>Candidate 2</td>
                      <td> Skill Aquisition Exam </td>
                      <td> 
                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" data-original-title="Edit">
                          <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- End Panel Projects -->
          </div>

          <div class="col-lg-3 masonry-item">
            <!-- Panel Projects -->
            <div class="panel" id="projects">
              <div class="panel-heading" style="padding: 0px ">
                <span class="panel-title">Average Completion Time</span>
                <div class="panel-actions panel-actions-keep">
                  <div class="dropdown">
                    <a class="panel-action" id="examplePanelDropdown" data-toggle="dropdown" href="#"
                      aria-expanded="false" role="button"><i class="icon md-more-vert" aria-hidden="true"></i></a>
                    <div class="dropdown-menu dropdown-menu-bullet dropdown-menu-right" aria-labelledby="examplePanelDropdown"
                      role="menu">
                      <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-flag" aria-hidden="true"></i> Action</a>
                      <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-print" aria-hidden="true"></i> Another action</a>
                      <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-favorite" aria-hidden="true"></i> Something else here</a>
                      <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-share" aria-hidden="true"></i> Separated link</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-striped table-sm">
                  <thead>
                    <tr>
                      <td>Exam</td>
                      <td>No of Users</td>
                      <td>Ave Time</td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td> Scrum Exam </td>
                      <td> 14 </td>
                      <td> 44 mins </td>
                    </tr>                    
                    <tr>
                      <td> Skills Exam </td>
                      <td> 10 </td>
                      <td> 32 mins </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- End Panel Projects -->
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
    return {
      exams: [],
      exams_completed: [],
      total_live_exams: [],
      exam_users: [],
      users_finished: [],
      total_live_users: [],
      live_exam_details: []
    }
  },
  
  created() 
  {
    this.fetchExam();
    this.fetchCompletedExam();
    this.fetchTotalLiveExams();
    this.fetchTotalExamUsers();
    this.fetchFinishedUsers();
    this.fetchTotalLiveUsers();
  },


  methods: {
    fetchExam(page_url) 
    {
      fetch('/api/get_exams')
        .then(res=>res.json())
        .then(res => {
        this.exams = res.count_exams;
        })
        .catch(err => console.log(err));
    },

    fetchCompletedExam(page_url) 
    {
      fetch('/api/completed_exams')
        .then(res=>res.json())
        .then(res => {
        this.exams_completed = res.completed_exams;
        })
        .catch(err => console.log(err));
    },

    fetchTotalLiveExams(page_url) 
    {
      fetch('/api/total_live_exams')
        .then(res=>res.json())
        .then(res => {
        this.total_live_exams = res.all_live_exams;
        this.live_exam_details = res.live_exam_details;
        })
        .catch(err => console.log(err));
    },

    fetchTotalExamUsers(page_url) 
    {
      fetch('/api/total_exam_users')
        .then(res=>res.json())
        .then(res => {
        this.exam_users = res.all_exam_users;
        })
        .catch(err => console.log(err));
    },

    fetchFinishedUsers(page_url) 
    {
      fetch('/api/users_finished')
        .then(res=>res.json())
        .then(res => {
        this.users_finished = res.all_finished_users;
        })
        .catch(err => console.log(err));
    },

    fetchTotalLiveUsers(page_url) 
    {
      fetch('/api/total_live_users')
        .then(res=>res.json())
        .then(res => {
        this.total_live_users = res.all_live_users;
        })
        .catch(err => console.log(err));
    },

  }
};
</script>

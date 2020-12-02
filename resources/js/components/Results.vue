
<template>

  <!-- Page -->
  <div class="page" style="padding: -25px 0px 0px 0px;">


    <div class="page-content">

    <div class="row">
            <div class="col-xl-6 col-md-7 col-sm-6" style="text-align: left; padding-bottom: 0px"><h2 style="margin-top: -1px"> Results </h2>            </div>
            <div class="col-xl-3 col-md-3 col-sm-3" style="text-align: left; padding-bottom: 0px"> 
                <div class="form-group">
                    <select class="form-control round" required>
                      <option value="">Select Student</option>
                      <option v-for="student in Students" v-bind:value="student.id" v-bind:key="student.id">   {{ student.firstname }} </option>
                    </select>
                </div>
            </div>  

            <div class="col-xl-3 col-md-2 col-sm-3" style="text-align: right; padding-bottom: 0px"> 
              <select class="form-control">
                <option value="">Select Class</option>
              </select>              
            </div> 
        </div>

      <div class="panel" style="margin-top: -10px">
        <div class="row page-content">
          

          <div class="col-md-12">

           <div class="">
                <table class="table table-striped table-sm">
                    <tbody class="">
                      <tr>
                        <td  rowspan="2" style="text-align: center;"> <img v-bind:src="photo" width='150' height='80' />   </td>
                        <td style="font-size:16px">Full Names </td>
                        <td style="font-size:16px">Class </td>
                        <td style="font-size:16px">Term</td>
                        <td style="font-size:16px">Session</td>
                      </tr>
                      <tr>
                        <td style="font-size:20px"> Mary Jane Doe </td>
                        <td style="font-size:20px"> Form One </td>
                        <td style="font-size:20px"> Third Term </td>
                        <td style="font-size:20px"> Session 2018-2019 </td>
                      </tr>
                    </tbody>
                </table>

                <div class="row">
                  <div class="col-md-4"> <b style="font-size:20px"> First Term </b>
                      <table class="table" style="background:#eee">	
                          <!-- CLASS ONE BEST RESULT -->
                          <thead>
                            <tr>
                              <th>Subject</th>
                              <th>Marks </th>
                              <th>Grade</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Mathematics</td>
                              <td>89% </td>
                              <td>Excellent</td>
                            </tr>
                            <tr>
                              <td>English</td>
                              <td>74% </td>
                              <td>B-Plus</td>
                            </tr>
                            <tr>
                              <td>Economics</td>
                              <td>38% </td>
                              <td>Fair</td>
                            </tr>
                          </tbody>
                        </table>
                  </div>
                  <div class="col-md-4"> <b style="font-size:20px"> Second Term </b>
                      <table class="table" style="background:#eee">	
                          <!-- CLASS ONE BEST RESULT -->
                          <thead>
                            <tr>
                              <th>Subject</th>
                              <th>Marks </th>
                              <th>Grade</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Mathematics</td>
                              <td>89% </td>
                              <td>Excellent</td>
                            </tr>
                            <tr>
                              <td>English</td>
                              <td>74% </td>
                              <td>B-Plus</td>
                            </tr>
                            <tr>
                              <td>Economics</td>
                              <td>38% </td>
                              <td>Fair</td>
                            </tr>
                          </tbody>
                        </table>
                  </div>
                  <div class="col-md-4"> <b style="font-size:20px"> Third Term </b>
                      <table class="table" style="background:#eee">	
                          <!-- CLASS ONE BEST RESULT -->
                          <thead>
                            <tr>
                              <th>Subject</th>
                              <th>Marks </th>
                              <th>Grade</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Mathematics</td>
                              <td>89% </td>
                              <td>Excellent</td>
                            </tr>
                            <tr>
                              <td>English</td>
                              <td>74% </td>
                              <td>B-Plus</td>
                            </tr>
                            <tr>
                              <td>Economics</td>
                              <td>38% </td>
                              <td>Fair</td>
                            </tr>
                          </tbody>
                        </table>
                  </div>
                </div>
                
                

                <!-- <table class="table">	
                    <thead>
                      <tr>
                        <th>Subject</th>
                        <th>Marks </th>
                        <th>Grade</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Mathematics</td>
                        <td>89% </td>
                        <td>Excellent</td>
                      </tr>
                      <tr>
                        <td>English</td>
                        <td>74% </td>
                        <td>B-Plus</td>
                      </tr>
                      <tr>
                        <td>Economics</td>
                        <td>38% </td>
                        <td>Fair</td>
                      </tr>
                    </tbody>
                </table> -->

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
              Students: [],
                student: {
                    id: '',
                    registration_no: 'STUD-2019-1234',
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
              student_id: '',
              photo: './assets/images/avatar.png',                
            }
        },


        created()
        {
            this.fetchStudent();
            this.fetchClasses();
            this.fetchSessions();
        },


        methods:{

            fetchStudent()
            {
                let Students = '/api/students'
                fetch(Students)
                .then(res => res.json())
                .then(res => {
                    this.Students = res;
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


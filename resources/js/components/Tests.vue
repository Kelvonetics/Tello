
<template>
    <div class="row" style=""> 


        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Test Questions</h3>

              

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool"><i class="fa fa-list"></i></button>
              </div>
              <!-- /.box-tools -->
            </div> <br> <br>
                <!-- /.box-header -->
                <div class="box-body" v-for="question in questions" v-bind:key="question.id">
                    <div class="row" style="">
                        <div class="col-md-11">
                            <h4> Question : {{question.id}} </h4>
                        </div>
                        <div class="col-md-1">
                            <span class="pull-right">1 of 45</span>
                        </div>

                        <div class="col-md-12">
                            <h5> {{question.questions}} </h5>
                        </div>
                            
                    </div> <hr><br>


                    <div class="row" style="">
                        <div class="col-md-6" style="">
                            <!-- Options -->
                              <div class="">
                                <div class="box-header">  <h5 class="box-title">Option A</h5>    </div>
                                <div class="box-body">
                                  <!-- Minimal style -->                                 
                                  <!-- radio -->
                                  <div class="form-group">
                                    <label>  <input type="radio" name="r3" class="flat-red"> {{question.option1}}  </label>
                                  </div>
                                </div>
                                
                              </div>
                              <!-- Options -->
                        </div>
                        <div class="col-md-6" style="">
                            <!-- Options -->
                              <div class="">
                                <div class="box-header">  <h5 class="box-title">Option B</h5>    </div>
                                <div class="box-body">
                                  <!-- Minimal style -->                                 
                                  <!-- radio -->
                                  <div class="form-group">
                                    <label>  <input type="radio" name="r3" class="flat-red"> {{question.option2}}  </label>
                                  </div>
                                </div>
                                
                              </div>
                              <!-- Options -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6" style="">
                            <!-- Options -->
                              <div class="">
                                <div class="box-header">  <h5 class="box-title">Option C</h5>    </div>
                                <div class="box-body">
                                  <!-- Minimal style -->                                 
                                  <!-- radio -->
                                  <div class="form-group">
                                    <label>  <input type="radio" name="r3" class="flat-red"> {{question.option3}}  </label>
                                  </div>
                                </div>
                                
                              </div>
                              <!-- Options -->
                        </div>
                        <div class="col-md-6" style="">
                            <!-- Options -->
                              <div class="">
                                <div class="box-header">  <h5 class="box-title">Option D</h5>    </div>
                                <div class="box-body">
                                  <!-- Minimal style -->                                 
                                  <!-- radio -->
                                  <div class="form-group">
                                    <label>  <input type="radio" name="r3" class="flat-red"> {{question.option4}}  </label>
                                  </div>
                                </div>
                                
                              </div>
                              <!-- Options -->
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-9" style="">
                            
                        </div>
                        <div class="col-md-3" style="">
                            <nav aria-label="Page navigation example">
                              <ul class="pagination pagination-sm">
                                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchQuestions(pagination.prev_page_url)">Previous</a></li>
                                <li class="page-item disabled"><a class="page-link text-dark" href="#" >Question {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchQuestions(pagination.next_page_url)">Next</a></li>
                              </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
          </div>
        </div>   
    
    </div>



</template>

                        












<script>
    export default
    {
        data(){
            return{
                questions: [], 
                question: {
                    id: '',
                    category_id: '',
                    section_id: '',
                    questions: '',
                    option1: '',
                    option2: '',
                    option3: '',
                    option4: '',
                    answer: ''
                },
                article_id: '',
                pagination: {},
                edit: false
            }
        },

        created()
        {
            this.fetchQuestions();
        },

        methods: 
        {
            fetchQuestions(page_url)
            {
              let vm = this;
              page_url = page_url || '/api/tests'
                fetch(page_url)
                .then(res => res.json())
                .then(res => {
                  this.questions = res.data;
                  vm.makePagination(res.meta, res.links);
                })
                .catch(err => console.log(err));
              },
              makePagination(meta, links) {
                  let pagination = {
                  current_page: meta.current_page,
                  last_page: meta.last_page,
                  next_page_url: links.next,
                  prev_page_url: links.prev
                };

                this.pagination = pagination;
            }
        }
    };
</script>


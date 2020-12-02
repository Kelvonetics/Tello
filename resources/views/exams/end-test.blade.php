@extends('layouts.app')


<style type="text/css">
    *
    {
    	font-size: 13px;
    }
</style>

@section('content')


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
                        <tbody>
                          
                        </tbody>
                    </table>
                  </div>
              
                </div>
            </div>
        </div>


    </div>
   </div>
 </div>
</div>




    <div class="row" style="padding: 0px 15px; margin-top: -10px"> 

    
        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              
                <div class="row">
                   <div class="container-fluid col-sm-10">
                      <h2 class="title" style="text-align:center">Thanks For Taking The Exam, We Will Get Back To You Shortly</h2>
                   </div>

                   <div class="container-fluid col-sm-2">
                      <center>
                      <img src="{{asset('assets/dist/img/avatar.png')}}" alt="avatar" style="border-radius:50%;margin-top:30px;width:100;height:100;">
                      </center>
                      <h4 style="text-align:center;margin-top:15px">Student</h4>
                   </div>
                </div>
              
              <!-- /.box-tools -->
            </div> <br> <br>
           
          </div>
        </div>   

                      

    </div>


@endsection



















@section('script')








  @if(Session::has('info'))
      <script>
          $(function() 
          {
              toastr.success('{{session('info')}}', {timeOut:100000});
          });
      </script>
  @elseif(Session::has('error'))
      <script>
          $(function() 
          {
              toastr.error('{{session('error')}}', {timeOut:100000});
          });
      </script>
  @endif

@endsection
<template>

 <span>
     

<div class="modal fade" id="UploadExamUserModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Upload Eam Users</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">    <span aria-hidden="true">&times;</span></button>
      </div>

      <div class="modal-body">                        
        <div>
          <input type="file" :id="id" @change="doConversion">
          {{ uploadedFile.length > 0 ?  uploadedFile.length + ' Bytes Uploaded' : '' }}
          <!-- <img :src="uploadedFile" />  -->
        </div>
        <div>
           <input type="text" name="exam_id" v-bind:value='$route.params.id'> 
          <div style="margin-top:11px;" class="alert alert-success" v-show="uploadedFile.length" @click.prevent="sendToApiTransform"> {{ statusText }}</div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->         





          <button class="btn btn-sm btn-icon btn-default btn-round pull-right" data-toggle="modal" data-target="#UploadExamUserModal" 
            title="Upload Exam User From Excel File"> <span class="fa fa-upload" style="margin :1px 2px; color: #777"></span> 
          </button>

 </span> 

</template>

<script>
    export default 
    {
        mounted() 
        {
            console.log('Component mounted.');
        },
        props:[
          'id',
          'api_url'
        ],
        data()
        {
          return {
            uploadedFile:'',
            // apiUrl:'http://localhost:8000/batch-excel-create',
            statusText:'Batch Create',
            file:null,
            uploadedFile:''
          }
        },
        methods:{

          doConversion()
          {
          this.file = $('#' + this.id).get(0).files.item(0); 
          this.getBase64();
          },
          getBase64() 
          {
          var reader = new FileReader();
          var $self = this;

          reader.readAsDataURL(this.file);
          reader.onload = () =>{ 
          this.uploadedFile = reader.result;
          this.sendToApiTransform();
          }; 
          reader.onerror = (error) => 
          {
          // console.log('Error: ', error);
          this.uploadedFile = reader.result;
          };

          },

          sendToApiTransform()
          {
            this.statusText = 'Users Details Uploading ...';
            fetch(this.api_url,{
              method:'POST',
              body:JSON.stringify(
              {
                exam_id:this.$route.params.id,
                blob:this.uploadedFile,
                _token:laravel.csrfToken
              }),
              headers:{
                'content-Type':'application/json'
              }
            })
            .then(response=>{
                this.statusText = 'Users Details Uploaded.';
                $('.modal').trigger('click');
                this.$emit('done-uploading');
            })
          }



          
        }
        
    }
</script>

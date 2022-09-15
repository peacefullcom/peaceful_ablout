@extends('backend.layouts.adminlte')
@section('content')
<section class="content">
<!-- container-fluid start -->
    <div class="container-fluid">






<!-- col-md-9 start -->
<div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item">Change Password</li>
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">


<!-- form start -->
        <form method="POST" class="form-horizontal col-sm-10" autocomplete="off" id="form1" onsubmit="return validateForm();" action="/backend/change-password">
            @csrf

          <div class="col-sm-10 offset-sm-1 col-xs-12">  
                
                @if( Session::has('success') )
                       <div class="col-sm-12">
                          <h4 class="text-success text-center"><b>{{ Session::get('success') }}</b></h4>   
                       </div>
                  @elseif (Session::has('failure'))
                       <div class="col-sm-12">
                          <h4 class="text-danger text-center"><b>{{ Session::get('failure') }}</b></h4>  
                       </div>
                  @endif
                    
                <div class="col-sm-10 offset-sm-1 col-xs-12">  
                
                                        
                    <div class="form-group row">
                    <label for="Old Password" class="col-sm-3 col-xs-12 required">Old Password</label>
                    <input class="col-sm-9 col-xs-12 form-control" id="oldpass" onfocus="this.value=''" name="old_password" type="password" value="">
                    </div>
                     
                    <div class="form-group row">
                     <label for="New Password" class="col-sm-3 col-xs-12 required">New Password</label>
                     <input class="col-sm-9 col-xs-12 form-control" id="password" placeholder="Min 8 characters" name="password" type="password" value="">
                    </div>
                     
                    <div class="form-group row">
                     <label for="Password Confirm" class="col-sm-3 col-xs-12 required">Password Confirm</label>
                     <input class="col-sm-9 col-xs-12 form-control" id="password_confirm" placeholder="Retype New Password" name="password_confirm" type="password" value="">
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                           <input name="submit" class="btn btn-info pull-center text-center" id="sbmtbtn" type="submit" value="Update">
                        </div>
                    </div>
                 
                </div>
           </div>           
        </form>
<!-- form end -->
            </div>
        </div>
    </div>

    </div>
</div>


<!-- col-md-9 end -->
    
    <div class="col-sm-12">
          @if ($errors->any())
            <div class="alert alert-danger text-center">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
    </div>
<!-- warningModal start -->
    <div class="modal fade" id="warningModal" tabindex="-1">
     <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title text-danger">Warning</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body text-danger" id='warningText'>
            
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div> 
    
  </div> 
<!-- warningModal end -->
  </div>
<!-- container-fluid end -->
</section>
@stop

@section('script')
<script type="text/javascript">
  function validateForm(){
    err = '';
    oldpass = $.trim($('#oldpass').val());
    pass1 = $.trim($('#password').val());
    pass2 = $.trim($('#password_confirm').val()); 

    if(pass1.length < 1){
        err += "Old Password is required<br>";
    }
    if(pass1.length < 8){
        err += "New Password is at least 8 characters<br>";
    }
    if(pass2 != pass1 ){
        err += "New Password and Password Confirm are not the same<br>";
    }  
   if(err != ''){
       $('#warningText').html(err);
       $('#warningModal').modal("toggle"); 
       return false;
   } 
   return true;
 }
 
</script>
@stop
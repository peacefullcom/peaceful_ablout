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
                  <li class="nav-item">Change Profile</li>
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">


<!-- form start -->
        <form method="POST" action="/backend/change-profile" accept-charset="UTF-8" class="form-horizontal col-sm-10" autocomplete="off" id="form1" onsubmit="return validateProfileForm();">
        @csrf

         <div class="col-sm-8 offset-sm-2 col-xs-12">  
               
            <div class="form-group row">
            <label for="Account (Email)" class="col-sm-3 col-xs-12 required">Account (Email)</label>
                    {{ $row->email }}
                    
            </div>                
            <div class="form-group row">
            <label for="Username" class="col-sm-3 col-xs-12 required">Username</label>
                    <input class="col-sm-9 col-xs-12 form-control" id="username" readonly="readonly" name="username" type="text" value="{{ $row->username }}">
                    </div>
                     
                <div class="form-group row">
            <label for="Last Name" class="col-sm-3 col-xs-12 required">Last Name</label>
                    <input class="col-sm-9 col-xs-12  form-control" id="last_name" readonly="readonly" name="last_name" type="text" value="{{ $row->last_name }}">
                    </div>
                    
                    <div class="form-group row">
            <label for="First Name" class="col-sm-3 col-xs-12 required">First Name</label>
                    <input class="col-sm-9 col-xs-12  form-control" id="first_name" readonly="readonly" name="first_name" type="text" value="{{ $row->first_name }}">
                    </div>
                    
            

            <div class="form-group row">
            <label for="Phone" class="col-sm-3 col-xs-12 required">Phone</label>
                    <input class="col-sm-9 col-xs-12  form-control  " id="phone" readonly="readonly" name="phone" type="text" value="{{ $row->phone }}">
                    </div>
                     
            <div class="form-group row">
            <div class="col-sm-12 text-center">
            <span class="btn btn-info" onclick="removeReadonly();">  Edit </span>
            <input name="submit" class="btn btn-info pull-center text-center" id="sbmtbtn" type="submit" value="Update">
                     
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
 <script>
  function removeReadonly() {
      $(':input').prop('readonly', false);
  }
 </script>
@stop
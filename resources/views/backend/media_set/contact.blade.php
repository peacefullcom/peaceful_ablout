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
                  <li class="nav-item mr-2"><a href="/backend/media-set-description">Description</a></li>
                  <li class="nav-item mr-2"><a href="/backend/media-set-headinfo">HeadInfo</a></li>
                  <li class="nav-item mr-2">Contact</li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">


<!-- form start -->
        <form method="POST" action="" accept-charset="UTF-8" class="form-horizontal col-sm-10" autocomplete="off" id="form1" >
        @csrf
         <div class="col-sm-8 offset-sm-2 col-xs-12"> 
            <div class="form-group row">
              <label for="twitter" class="col-sm-3 col-xs-12 required">twitter</label>
              <input class="col-sm-9 col-xs-12 form-control" id="twitter" name="twitter" type="text" value="{{ $data['twitter'] }}">
            </div>

            <div class="form-group row">
              <label for="facebook" class="col-sm-3 col-xs-12 required">facebook</label>
              <input class="col-sm-9 col-xs-12 form-control" id="facebook" name="facebook" type="text" value="{{ $data['facebook'] }}">
            </div>

            <div class="form-group row">
              <label for="instagram" class="col-sm-3 col-xs-12 required">instagram</label>
              <input class="col-sm-9 col-xs-12 form-control" id="instagram" name="instagram" type="text" value="{{ $data['instagram'] }}">
            </div>

            <div class="form-group row">
              <label for="pinterest" class="col-sm-3 col-xs-12 required">pinterest</label>
              <input class="col-sm-9 col-xs-12 form-control" id="pinterest" name="pinterest" type="text" value="{{ $data['pinterest'] }}">
            </div>

            <div class="form-group row">
              <div class="col-sm-12 text-center">
                <input name="submit" class="btn btn-info pull-center text-center" id="sbmtbtn" type="submit" value="Submit">
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
<!-- Bootstrap Switch -->
<script src="/adminlte/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script>
 $(function () {
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
  })

</script>
@stop

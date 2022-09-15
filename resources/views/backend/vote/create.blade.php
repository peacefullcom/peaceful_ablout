@extends('backend.layouts.adminlte')

@section('headpart')
<!-- daterange picker -->
  <link rel="stylesheet" href="/adminlte/plugins/daterangepicker/daterangepicker.css">
@stop
@section('content')
<section class="content">
<!-- container-fluid start -->
    <div class="container-fluid">

<!-- col-md-9 start -->
<div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item">Create</li>
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">


<!-- form start -->
        <form method="POST" action="/backend/vote/create" accept-charset="UTF-8" class="form-horizontal col-sm-10" autocomplete="off" id="form1">
        @csrf

         <div class="col-sm-8 offset-sm-2 col-xs-12">        
            <div class="form-group row">
              <label for="title" class="col-sm-3 col-xs-12 required">title</label>
              <input class="col-sm-9 col-xs-12 form-control" id="title" name="title" type="text">
            </div>
            <div class="form-group row">
              <label for="content" class="col-sm-3 col-xs-12 required">content</label>
              <textarea class="col-sm-9 col-xs-12 form-control" id="content" name="content" rows="4" cols="50"></textarea>
            </div>
            <div class="form-group row">
              <label for="rule" class="col-sm-3 col-xs-12 required">rule</label>
              <textarea class="col-sm-9 col-xs-12 form-control" id="rule" name="rule" rows="4" cols="50"></textarea>
            </div>
            <div class="form-group row">
              <label for="group" class="col-sm-3 col-xs-12 required">group</label>
              <input class="col-sm-9 col-xs-12 form-control" id="group" name="group" type="text">
            </div>
            <div class="form-group row">
                <label for="date_range" class="col-sm-3 col-xs-12 required">Date range:</label>
            <!-- Date range -->
                <div class="form-group">
                  

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservation" name="date_range">
                  </div>
                  <!-- /.input group -->
                </div>
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
<script src="/adminlte/plugins/moment/moment.min.js"></script>
<script src="/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<script>
 $(function () {
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

    $('#reservation').daterangepicker({
      locale: {
        format: 'YYYY/MM/DD'
      }
    })
  })
</script>
@stop

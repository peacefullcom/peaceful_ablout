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
                  <li class="nav-item">Create</li>
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">


<!-- form start -->
        <form method="POST" action="" accept-charset="UTF-8" class="form-horizontal col-sm-10" autocomplete="off" id="form1">
        @csrf

         <div class="col-sm-8 offset-sm-2 col-xs-12">        
            <div class="form-group row">
              <label for="name" class="col-sm-3 col-xs-12 required">name</label>
              <input class="col-sm-9 col-xs-12 form-control" id="name" name="name" type="text" value="{{ $articleCategory->name }}">
            </div>
            <div class="form-group row">
              <label for="name_en" class="col-sm-3 col-xs-12 required">name_en</label>
              <input class="col-sm-9 col-xs-12  form-control" id="name_en" name="name_en" type="text" value="{{ $articleCategory->name_en }}">
            </div>
            <div class="form-group row">
              <label for="is_publish" class="col-sm-3 col-xs-12 required">publish</label>
              <input type="checkbox" name="is_publish" data-bootstrap-switch data-off-color="danger" data-on-color="success" 
              @if($articleCategory->is_publish == 1) checked @endif 
              >
            </div>
            <div class="form-group row">
              <label for="sort" class="col-sm-3 col-xs-12 required">sort</label>
              <input class="col-sm-3 col-xs-3  form-control" id="sort" name="sort" type="text" value="{{ $articleCategory->sort }}">
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

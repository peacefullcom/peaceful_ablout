@extends ('backend.layouts.default')
@section ('content')
<section style="width:100%; margin-top: 180px;">
     
    <div class="mx-auto">
        <form  method="POST" action="/backend/login" onsubmit="return validateForm();" accept-charset="UTF-8"  autocomplete="on">
        {{ csrf_field() }} 
        <div class="modal-body" id='registerBody'>
           <div class="container">
              <div class="px-5 py-5 mx-auto" style="max-width: 800px; background-color:rgba(0,0,0,0.5);">
                <!-- 
                <div class="form-group row">
                   <div class="col-sm-2"><i class="fa fa-user-circle"></i></div>
                   <div class="col-sm-10"><input type="text" id="orangeForm-name" class="form-control"></div>
                </div>
                -->
                <div class="form-group row my-2">
                   <h3 class="text-center text-light">和平后台管理系统</h3>
                </div>
                <div class="form-group row my-4">
                   <div class="col-sm-1 text-right text-light"><i class="fa fa-envelope"></i></div>
                   <div class="col-sm-11"><input type="email" id="email" name="email" class="form-control validate"  placeholder="Your Email" style="background-color:transparent; border:1"></div>
                </div>
                <div class="form-group row my-4">
                   <div class="col-sm-1  text-right text-light"><i class="fa fa-lock fa-lg"></i></div>
                   <div class="col-sm-11"><input type="password" id="password" name="password" class="form-control" placeholder="Password" style="background-color:transparent; border:1"></div>
                </div>
                   
                <div class="form-group row">
                   <div class="col-sm-12 text-center"><button class="btn bg-light text-dark" name="submit" value="login">LOGIN</button></div>
                </div>
                <!--
                <div class="col-sm-12 mt-2">
                    <div class="text-center"><a href="/backend/lost-password" class="btn btn-ligh">Lost Password</a></div>
                </div>
                -->
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
                   @if( Session::has('loginResult') )
                        <h5 class="text-center text-danger my-2">
                             {{Session::get('loginResult')}}
                        </h5>
                  @endif
                </div>
                
              </div>
            </div>
            
           </div>
         </form> 
        </div>

    <div class="modal fade" id="warningModal" tabindex="-1">
     <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title text-danger">Warning</h4>
          <!--<button type="button" class="close" data-bs-dismiss="modal">&times;</button>-->
        </div>
        <!-- Modal body -->
        <div class="modal-body text-danger" id='warningText'>  
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
   </div> 
</section>
 
@endsection

@section('scriptcontent')
<script>
function validateForm(){
    email = $('#email').val().trim();
    password = $('#password').val().trim();
    err = '';
    if(email.length < 1 ) {
          err += "Email Address is required<br>";
    } else if(! /\S+@\S+\.\S+/.test(email) ) {
         err += "Invalid Email Address<br>";
    }
    if(password.length < 8){
            err += "Password minimum 8 characters<br>";
    }
    if(err.length > 0 ){
        $('#warningText').html(err);
        $('#warningModal').modal("toggle");
        return false;
    }
    return true;
}
</script>
@stop
@extends ('backend.layouts.default')
@section ('content')
<section class="pt-4">
     
    <div class="offset-sm-2 offset-md-3 offset-xl-4">
        <form  method="POST" action="/backend/login" onsubmit="return validateForm();" accept-charset="UTF-8"  autocomplete="on">
        {{ csrf_field() }} 
        <div class="modal-body" id='registerBody'>
           <div class="container">
              <div class="col-sm-8 col-md-6 col-xl-4">
                <!-- 
                <div class="form-group row">
                   <div class="col-sm-2"><i class="fa fa-user-circle"></i></div>
                   <div class="col-sm-10"><input type="text" id="orangeForm-name" class="form-control"></div>
                </div>
                -->
                <div class="form-group row my-2">
                   <div class="col-sm-1 text-right"><i class="fa fa-envelope"></i></div>
                   <div class="col-sm-11"><input type="email" id="email" name="email" class="form-control validate"  placeholder="Your Email"></div>
                </div>
                <div class="form-group row my-2">
                   <div class="col-sm-1  text-right"><i class="fa fa-lock fa-lg"></i></div>
                   <div class="col-sm-11"><input type="password" id="password" name="password" class="form-control" placeholder="Password"></div>
                </div>
                   
                <div class="form-group row">
                   <div class="col-sm-12 text-center"><button class="btn btn-info" name="submit" value="login">Login</button></div>
                </div>
                <div class="col-sm-12 mt-2">
                    <div class="text-center"><a href="/backend/lost-password" class="btn btn-ligh">Lost Password</a></div>
                </div>  
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
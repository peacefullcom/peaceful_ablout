@extends ('backend.layouts.default')
@section ('content')
<section class="pt-4" id="services">
     <div class="container">
          <div class="col-12 row">
                   <h1 class="text-center text-light">和平后台管理系统</h1>
                   @if(Auth::guard('admin')->user())
                   <h3 class="text-center text-light">管理员：[{{Auth::guard('admin')->user()->username}} ]</h3>
                   @endif
          </div>   
     </div>
</section>
@endsection
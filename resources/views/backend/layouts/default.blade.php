<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="/css/style.css">
        <title>Peacefull BackEnd</title>

        <!-- Fonts -->
       <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css" integrity="sha512-usVBAd66/NpVNfBge19gws2j6JZinnca12rAe2l+d+QkLU9fiG02O1X8Q6hepIpr/EYKZvKx/I9WsnujJuOmBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />                              
    
   
    @yield('headcontent')
      
    </head>

    <body id="page-top" style="min-height:100vh; overflow-y: scroll;">

        @include('backend.layouts.navbar')
        
        @yield('content')
   
        <section class="bg-dark text-white" id="footer" >

        <div class="container p-3 mt-0">
        <div class="row">
        <div class="col-sm-4 mx-auto text-center pt-1">
            <!--<img src="/img/logo-eng.jpg" style="height:80px;width:auto"> -->
        </div>
        
        <div class="col-sm-4 mx-auto text-center">
            
            <div class="col-sm-12 row pb-4">
              <div class="col-sm-4">About Us</div>
              <div class="col-sm-4">Privacy Policy</div>
              <div class="col-sm-4">Term of Use</div>
            </div>
             
            <div class="col-sm-12"> #120 - 1200 W. 73rd Ave, Vancouver, BC V6P 6G5</div>
            <div class="col-sm-12">info@peacefulmall.com</div>
             
        </div>
        
        <div class="col-sm-4 mx-auto text-center">
            <div class="pb-2"><a href="https://play.google.com/store/apps/details?id=com.restaurantdem.peaceful_driver"><img src="/img/androidButtonsWhite.png" style="height:50px;width:auto"></a></div>
            <div><a href="https://apps.apple.com/ca/app/peaceful-driver/id1605258358"><img src="/img/appleButtonsWhite.png" style="height:50px;width:auto"></a></div>
        </div>
        
        </div>
        </div>

        </section>
   
       <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
       <!-- Bootstrap 5 -->
        
       <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js" integrity="sha512-a6ctI6w1kg3J4dSjknHj3aWLEbjitAXAjLDRUxo2wyYmDFRcz2RJuQr5M3Kt8O/TtUSp8n2rAyaXYy1sjoKmrQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
         
        @yield('scriptcontent')

    </body>

</html>
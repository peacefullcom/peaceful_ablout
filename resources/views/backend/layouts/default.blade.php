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

    <style>
        html {
            height: 100%;
        }

        body {
            min-height:100vh; 
            overflow-y: scroll; 
            background-image: url(/img/login_bg.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
        }
    </style>
      
    </head>

    <body id="page-top">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-md mb-5">
         <div class="container">
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto mt-3">
              <li class="nav-item">
                @if(Auth::guard('admin')->user())
                <a class="nav-link px-3 border border-white text-light" href="/backend/home">BACKEND</a>
                @else
                <a class="nav-link px-3 border border-white text-light opacity-50" href="/backend/login">SIGN IN</a>
                @endif
              </li>
            </ul>
          </div>
         </div>
        </nav>
        
        @yield('content')
   
        <section class="text-white" id="footer" >

        <div class="container p-3 mb-2">
            <div class="col-sm-12 mx-auto text-center">
                <div class="col-sm-12">©2022 PeacefulMall. All Rights Reserved. | #120 - 1200 W. 73rd Ave, Vancouver, BC V6P 6G5 | info@peacefulmall.com</div>
            </div>
        </div>

        </section>
   
       <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
       <!-- Bootstrap 5 -->
        
       <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js" integrity="sha512-a6ctI6w1kg3J4dSjknHj3aWLEbjitAXAjLDRUxo2wyYmDFRcz2RJuQr5M3Kt8O/TtUSp8n2rAyaXYy1sjoKmrQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
         
        @yield('scriptcontent')

    </body>

</html>
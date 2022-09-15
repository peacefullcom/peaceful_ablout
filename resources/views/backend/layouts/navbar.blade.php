<!-- Navigation -->
    <nav class="navbar navbar-expand-md navbar-light bg-light">
     <div class="container">
        <a href="/" class="navbar-brand">
            <img  src="/img/peacefulmall-logo-eng.svg" width="80" height="100" alt="Delivery Dispatching">
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ms-auto" style="margin-right:50px">
          <li class="nav-item">
            @if(Auth::guard('admin')->user())
            <p>You logged as <a href="/backend/home">{{Auth::guard('admin')->user()->username}}</a> </p>
            @else
            <a class="nav-link" href="/backend/login">Login</a>
            @endif
          </li>
        </ul>
      </div>
     </div>
    </nav>
@auth
    @if (Auth::user()->status != "ACTIVE")
        {{ Auth::logout( Auth::user() ) }}
    @endif
@endauth


<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="MTRACE">
  
  <meta name="author" content="MTRACE">
  <meta name="designer" content="MTRACE">
  <meta name="project manager" content="MTRACE">
  <meta property="fb:admins" content="MTRACE">
  <meta property="og:type" content="website">
  <meta property="og:url" content="http://mtrace.com">
  <meta property="og:title" content="MTRACE">
  <meta property="og:description"
      content="MTRACE">
  {{-- <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('/site.webmanifest') }}"> --}}

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>MTRACE | @yield('title')</title>

<link href="{{ asset('/dist/b5.css') }}" rel="stylesheet">
<link href="{{ asset('/css/admin.css') }}" rel="stylesheet">
<link href="{{ asset('/css/dt.css') }}" rel="stylesheet">
<link href="{{ asset('/css/jquery.dt.css') }}" rel="stylesheet">
@yield('styles')


<script src="{{ asset('/js/b5.js') }}" defer></script>
<script src="{{ asset('/js/popper.min.js') }}" defer></script>
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/dist/fa/js/all.min.js') }}"></script>


</head>

<body>

  <nav class="navbar navbar-dark sticky-top bg-theme flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 fw-bold" href="#">MTRACE</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
      data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <b class=" form-control form-control-dark w-100 h5 fw-bold" > Bienvenue, {{ 'M/Mme ' . Auth::user()->firstname  }}  !</b>
    <ul class="navbar-nav px-3 bg-theme">
      <li class="nav-item text-nowrap">
        <a class="nav-link mr-5 mr-md-1" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <i class="fa fa-power-off" ></i> Déconnexion</a>

      </li>
      
      <form id="logout-form" action="{{ route('logout') }}" method="POST">
        {{ csrf_field() }}
    </form>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 px-2 d-md-block bg-light sidebar position-fixed collapse">
        <div class="position-sticky pt-3" style="height:100vh; overflow-y: scroll">
          <ul class="nav flex-column ">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('user') }}">
                <i class="fa fa-cog fa-spin" aria-hidden="true"></i>
                Tableau De Bord
              </a>
            </li>

            {{-- Manage Users --}}
            @if( in_array('list-user', $permissions) )
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user') }}">
                <i class="fa fa-user-circle" aria-hidden="true"></i>
                Utilisateurs
              </a>
            </li>
            @endif

              <!-- Manage Zones -->
              @if( in_array('list-mining_zone', $permissions) )
            <li class="nav-item">
              <a class="nav-link" href="{{ route('mining_zone') }}">
                <i class="fa fa-building" aria-hidden="true"></i>
                Zones
              </a>
            </li>
            @endif

            <!-- Manage productions -->
            @if( in_array('list-mining_production', $permissions) )
            <li class="nav-item">
              <a class="nav-link" href="{{ route('mining_production') }}">
                <i class="fa fa-dollar-sign" aria-hidden="true"> </i>
                Productions
              </a>
            </li>
            @endif

            <!-- Manage Sales -->
            @if( in_array('list-mining_sale', $permissions) )
            <li class="nav-item">
              <a class="nav-link" href="{{ route('mining_sale') }}">
                <i class="fa fa-list-alt" aria-hidden="true"> </i>
                Ventes
              </a>
            </li>
            @endif

            <!-- Manage Logs -->
            @if( in_array('list-mining_log', $permissions) )
            <li class="nav-item">
              <a class="nav-link" href="{{ route('mining_log') }}">
                <i class="fa fa-list-alt" aria-hidden="true"> </i>
                Ventes
              </a>
            </li>
            @endif
          
          </ul>


        </div>
      </nav>

      <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
        <div
          class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2"> @yield('bigT', "Tableau De Bord") </h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button type="button" class="btn btn-sm btn-outline-secondary">Zones : {{ 0 }} </button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Zones : {{ 0 }} </button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Zones : {{ 0 }} </button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Zones : {{ 0 }} </button>
            </div>

          </div>
        </div>


        @yield('main', "Tableau De Bord")

      </main>
    </div>
  </div>



  <script src="{{ asset('js/chart.min.js')}}"></script>
  <script src="{{ asset('js/datatables.min.js')}}"></script>
  <script src="{{ asset('js/dashboard.js')}}"></script>
  @yield('scripts')

</body>

</html>

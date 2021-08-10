@extends('layouts.app')


@section('css')
<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('css/soft-ui-dashboard.css?v=1.0.2') }}" rel="stylesheet" />
<style>
    main{
        margin: 0;
        background-image : url('/img/diamond.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }
</style> 


 <!--   Core JS Files   -->
 <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.0.2') }}"></script>
@endsection


@section('content')

  <section>
    <div class="page-header section-height-75">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
            <div class="card card-plain mt-8">
              <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                <p class="mb-0">Enter your email and password to sign in</p>
              </div>
              <div class="card-body">
                <form role="form text-left">
                  <label>Email</label>
                  <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                  </div>
                  <label>Password</label>
                  <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                  </div>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                  </div>
                  <div class="text-center">
                    <button type="button" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                  </div>
                </form>
              </div>
              <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <p class="mb-4 text-sm mx-auto">
                  Don't have an account?
                  <a href="javascript:;" class="text-info text-gradient font-weight-bold">Sign up</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
              <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('{{ asset('img/curved-images/curved6.jpg')"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

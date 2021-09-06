@extends('layouts.app')

@section('css')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">

@endsection

@section('content')

    <div class="container">
        <div class="row">


            <div class="col-lg-3 col-md-4  col-12   my-5 ">
                <div class=" card h-100 am">

                  <div class="card-body">
                    <p class="card-text "> Portail : </p>
                    <h4 class="card-title  col-12 text-center">Artisan Minier</h4>
                    <a class="btn btn-sm btn-light rounded-pill go-btn" href="{{route('home', ['as' => "AM"])}}">
                    Go >
                    </a>
                  </div>
                  <img draggable="false"  contextmenu="false"  src="{{ asset('img/mine_trolley_120px.png') }}" alt="diamond" class="card-illust">
                </div>
            </div>
            <div class="col-lg-3 col-md-4  col-12   my-5 ">
                <div class=" card h-100 ac">

                  <div class="card-body">
                    <p class="card-text "> Portail : </p>
                    <h4 class="card-title  col-12 text-center">Artisan Collecteur</h4>
                    <a class="btn btn-sm btn-light rounded-pill go-btn" href="{{route('home', ['as' => "AC"])}}">
                    Go >
                    </a>
                  </div>
                  <img draggable="false"  contextmenu="false"  src="{{ asset('img/gold_ore_120px.png') }}" alt="gold ore" class="card-illust">
                </div>
            </div>

            <div class="col-lg-3 col-md-4  col-12   my-5 ">
                <div class=" card h-100 ba">

                  <div class="card-body">
                  <p class="card-text ">Portail :</p>
                    <h4 class="card-title  col-12 text-center">Bureau d'Achat</h4>
                    <a class="btn btn-sm btn-light rounded-pill go-btn" href="{{route('home', ['as' => "BA"])}}">

                    Go >
                    </a>
                  </div>
                  <img draggable="false"  contextmenu="false"  src="{{ asset('img/diamond.png') }}" alt="diamond" class="card-illust">
                </div>
            </div>

            <div class="col-lg-3 col-md-4  col-12   my-5 ">
                <div class=" card h-100 pf">

                  <div class="card-body">
                    <p class="card-text "> Portail : </p>
                    <h4 class="card-title  col-12 text-center">Point Focale</h4>
                    <a class="btn btn-sm btn-light rounded-pill go-btn" href="{{route('home', ['as' => "PF"])}}">
                    Go >
                    </a>
                  </div>
                  <img draggable="false"  contextmenu="false"  src="{{ asset('img/jewel_120px.png') }}" alt="diamond jewel" class="card-illust">
                </div>
            </div>
            <div class="col-lg-3 col-md-4  col-12   my-5 ">
                <div class=" card h-100 cbt">

                  <div class="card-body">
                    <p class="card-text "> Portail : </p>
                    <h4 class="card-title  col-12 text-center">CBT-CI</h4>
                    <a class="btn btn-sm btn-light rounded-pill go-btn" href="{{route('home', ['as' => "CB"])}}">
                    Go >
                    </a>
                  </div>
                  <img draggable="false"  contextmenu="false"  src="{{ asset('img/topaz_120px.png') }}" alt="topaz" class="card-illust">
                </div>
            </div>
            <div class="col-lg-3 col-md-4  col-12   my-5 ">
                <div class=" card h-100  snppk">

                  <div class="card-body">
                    <p class="card-text">Portail : </p>
                    <h4 class="card-title col-12 text-center">BEED</h4>
                    <a class="btn btn-sm btn-light rounded-pill go-btn" href="{{route('home', ['as' => "BE"])}}">
                    Go >
                    </a>
                  </div>
                  <img draggable="false"  contextmenu="false"   src="{{ asset('img/certification_120px.png') }}" alt="certification" class="card-illust">
                </div>
            </div>
        </div>
    </div>

@endsection

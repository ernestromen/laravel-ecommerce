<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <title>honey</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
   <link rel="stylesheet" href="{{asset('css/style.css?v=1a22s112323221232126820')}}">
   <link rel="stylesheet" href="{{asset('css/responsive.css?v=1a03')}}">
   <link rel="icon" href="images/fevicon.png" type="image/gif" />
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <script src="{{asset('js/jquery.min.js')}}"></script>
   <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
   <script src="{{asset('js/jquery-3.0.0.min.js')}}"></script>

</head>

<body>
   <header>
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-2 col-sm-4 col-2 order-md-1 order-3 logo_section text-center">
               <div class="full">
                  <div class="center-desk">
                     <div class="logo">
                        <a href="{{route('home')}}"><img src="{{asset('images/logo1.png')}}" alt="#" /></a>
                     </div>
                  </div>
               </div>
            </div>

            <div class="col-xl-8 col-md-7 col-3 order-md-2 order-1">
               <nav
                  class="navbar navbar-expand-md navbar-light bg-light responsive-navigation bg-transparent justify-content-md-center justify-content-start">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                     aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse m-auto" id="navbarNavAltMarkup"
                     style="flex-grow:initial !important;">
                     <div class="navbar-nav">
                        <a class="nav-item nav-link px-3" href="{{route('home')}}">Home</a>
                        <a class="nav-item nav-link px-3" href="{{route('categories')}}">categories</a>
                        <a class="nav-item nav-link px-3" href="{{route('products')}}">products</a>
                        @role('admin')
                        <a class="nav-item nav-link " href="{{route('leads')}}">leads</a>
                        @endrole

                     </div>
                  </div>
               </nav>
            </div>
            <div class="col-xl-2 col-md-3 col-sm-5 col-5 pt-3 order-md-3 order-2">
               <div class="row">
                  <div class="col-sm-2 col-4 order-sm-1 order-1 text-sm-left text-right pr-md-3 pr-0 icon_adjusting">
                     @if(!Auth::check())
                   <a href="{{ route('login') }}" title="login user"><i class=" pr-3 fa fa-sign-in"
                        aria-hidden="true"></i></a>
                @else
             @endif
                  </div>
                  <div class="col-2 order-md-2 order-2 icon_adjusting">
                     @if (Auth::user() !== null && Auth::user() !== '')
                   <a class="pr-4 "
                     href="{{Auth::user()->name == 'Admin' ? route('dashboard') : route('show_user', ['id' => Auth::id()])}}">
                     {{Auth::user()->name}}</a>
                   <a href="{{ route('logout') }}">Logout</a>
                @else
                <a href="{{ route('register') }}" title="register user"><i class="fa fa-user pr-5"
                     aria-hidden="true"></i></a>
             @endif
                  </div>
                  <div class="col-sm-8 col-5 text-left pl-sm-1 pl-3 order-md-3 order-3">
                     @if(Auth::check() && !auth()->user()->hasRole('Admin'))
                   <a href="{{ route('show_cart', ["id" => Auth::id()]) }}" title="login user">
                     <span class='badge badge-secondary' id='cart_count'>{{$cartItemCount}}</span>
                     <i class="fa fa-shopping-cart pr-sm-5 pr-0" aria-hidden="true"></i>
                   </a>
                @else
                <a href="{{ route('guest_cart', ["id" => Auth::id()]) }}" title="login user">
                  <span class='badge badge-secondary' id='cart_count'>{{$cartItemCount}}</span>
                  <i class="fa fa-shopping-cart pr-5" aria-hidden="true"></i>
                </a>
             @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </header>
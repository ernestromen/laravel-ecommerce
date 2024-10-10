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
   <link rel="stylesheet" href="{{asset('css/style.css?v=1a22s11232322123126820')}}">
   <link rel="stylesheet" href="{{asset('css/responsive.css?v=1a03')}}">
   <link rel="icon" href="images/fevicon.png" type="image/gif" />
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <!-- <script language="JavaScript" type="text/javascript" src="/js/jquery-1.2.6.min.js"></script> -->
   <!-- <script language="JavaScript" type="text/javascript" src="/js/jquery-ui-personalized-1.5.2.packed.js"></script> -->
   <!-- <script language="JavaScript" type="text/javascript" src="/js/sprinkle.js"></script> -->
   <script src="{{asset('js/jquery.min.js')}}"></script>
   <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
   <script src="{{asset('js/jquery-3.0.0.min.js')}}"></script>
   <!-- <script src="{{asset('js/custom.js?v=9999')}}"></script> -->
   <!-- 
      <script src="http://code.jquery.com/jquery-3.3.1.min.js"
 integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
 crossorigin="anonymous"></script> -->
   <style>
      header {
         border-bottom: 1px solid white;

      }
body{
   overflow-x: hidden;
}
html{
   overflow-x: hidden;
}
</style>

</head>
<body>
   <header>
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-2 col-sm-3 col logo_section text-center">
               <div class="full">
                  <div class="center-desk">
                     <div class="logo">
                        <a href="{{route('home')}}"><img src="{{asset('images/logo1.png')}}" alt="#" /></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-8 col-sm-9">
               <nav class="navigation navbar navbar-expand-md navbar-dark ">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04"
                     aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarsExample04">
                     <ul class="navbar-nav d-block mr-auto nav-list-modification m-auto">
                        <li class="nav-item ">
                           <a class="nav-link" href="{{route('home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{route('categories')}}">Categories</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{route('products')}}">Products</a>
                        </li>
                        @role('admin')
                        <li class="nav-item">
                           <a class="nav-link" href="{{route('leads')}}">Leads</a>
                        </li>
                        @endrole
                     </ul>
                  </div>
               </nav>
            </div>
            <div class="col-md-2 pt-3">
               @if(Auth::check() && !auth()->user()->hasRole('Admin'))
               <a href="{{ route('show_cart', ["id" => Auth::id()]) }}"
                 title="login user">
                 <span class='badge badge-secondary' id='cart_count'>{{$cartItemCount}}</span>
                 <i class="fa fa-shopping-cart pr-5" aria-hidden="true"></i>
               </a>
               @else
               <a href="{{ route('guest_cart', ["id" => Auth::id()]) }}"
                 title="login user">
                 <span class='badge badge-secondary' id='cart_count'>{{$cartItemCount}}</span>
                 <i class="fa fa-shopping-cart pr-5" aria-hidden="true"></i>
               </a>
            @endif
               @if(!Auth::check())
               <a href="{{ route('login') }}" title="login user"><i class=" pr-3 fa fa-sign-in"
                   aria-hidden="true"></i></a>
            @else
            @endif
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
         </div>
      </div>
   </header>
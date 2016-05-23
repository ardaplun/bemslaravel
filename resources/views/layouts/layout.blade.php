<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Home | UGM Building Management System </title>
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
        <link href="{{asset('css/price-range.css')}}" rel="stylesheet">
        <link href="{{asset('css/animate.css')}}" rel="stylesheet">
        <link href="{{asset('css/main.css')}}" rel="stylesheet">
        <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="{{asset('js/html5shiv.js')}}"></script>
        <script src="{{asset('js/respond.min.js')}}"></script>
        <![endif]-->
        <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/ico/apple-touch-icon-144-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/ico/apple-touch-icon-114-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/ico/apple-touch-icon-72-precomposed.png')}}">
        <link rel="apple-touch-icon-precomposed" href="{{asset('images/ico/apple-touch-icon-57-precomposed.png')}}">
    </head><!--/head-->

    <body>
        <header id="header"><!--header-->
            <div class="header_top"><!--header_top-->
                <div class="container">

                </div>
            </div><!--/header_top-->

            <div class="header-middle" style="background-color:darkblue;height:10px;"><!--header-middle-->
                <div class="container">

                </div>
            </div><!--/header-middle-->

            <div class="header-bottom"><!--header-bottom-->
                <div class="container">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="logo pull-left">
                            <a href="{{url('')}}"><img src="{{asset('images/home/logo.png')}}" alt="" /></a>
                        </div>

                      </div>
                        <div class="col-sm-9">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-right">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li><a href="{{url('')}}" {{$page == 'home' ? 'class=active' : ''}}>Home</a></li>
                                    <li><a href="{{url('menu')}}" {{$page == 'menu' ? 'class=active' : ''}}>Menu</a></li>
                                    <li><a href="{{url('about-us')}}" {{$page == 'about-us' ? 'class=active' : ''}}>About Us</a></li>
                                    <li><a href="{{url('login')}}" {{$page == 'login' ? 'class=active' : ''}}>Login</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--/header-bottom-->
        </header><!--/header-->

        @yield('content')

        <footer id="footer" style="background-color:darkblue;"><!--Footer-->
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                      <div class="col-sm-12">
                      <center>
                      </br>
                        <p style="color:white">Copyright © {{date('Y')}} Dept. Electrical Engineering and Information Technology | All rights reserved.</p>
                        <p style="color:white"><span>Designed and Builded by <a target="_blank" href="http://www.sensativ.com">www.sensativ.com</a></span></p>
                      </center>
                    </div>
                    </div>
                </div>
            </div>

            <!--<div class="footer-widget">
                <div class="container">

                </div>
            </div> -->

            <div class="footer-bottom">
                <div class="container">

                </div>
            </div>

        </footer><!--/Footer-->

        <script src="{{asset('js/jquery.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
        <script src="{{asset('js/price-range.js')}}"></script>
        <script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
    </body>
</html>

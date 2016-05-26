<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Designed and builded by Sensativ Engineer in the terms of contribution for Dept. Electrical Engineering and Information Technology UGM">
        <meta name="author" content="Sentativ by Yulian Tenta Wardana">
        <title>Home | UGM Building Management System </title>
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
        <link href="{{asset('css/animate.css')}}" rel="stylesheet">
        <link href="{{asset('css/main.css')}}" rel="stylesheet">
        <link href="{{asset('css/bems.css')}}" rel="stylesheet">
        <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="{{asset('js/html5shiv.js')}}"></script>
        <script src="{{asset('js/respond.min.js')}}"></script>
        <![endif]-->
        <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="{{asset('js/date_time.js')}}"></script>




    </head><!--/head-->

    <body style="background:url({{asset('images/home/background.jpg')}}) top center repeat">
        <header id="header"><!--header-->
            <div class="header_top"><!--header_top-->
                <div class="container">

                </div>
            </div><!--/header_top-->

            <div class="header-middle" style="background-color:#22334d;height:10px;"><!--header-middle-->
                <div class="container">

                </div>
            </div><!--/header-middle-->

            <div class="header-bottom"><!--header-bottom-->
                <div class="container">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="row">
                            <div class="logo center-logo">
                                <center><a href="{{url('')}}"><img src="{{asset('images/home/logo.png')}}" alt="" /></a></center>
                            </div>

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
                            <div id="timer" class="mainmenu pull-left" >
                              <span class="show-time">{{date("H:i")}}</span>
                              <span class="show-weekday">{{date("l")}}</span>
                              <div class="show-date" >{{date("d M Y")}}</div>
                        <script type="text/javascript">window.onload = date_time('date_time');</script>

                            </div>
                            <div class="mainmenu pull-right center-nav">
                                <ul class="nav navbar-nav collapse navbar-collapse vertical">
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

        <footer id="footer" style="background-color:#22334d;"><!--Footer-->
            <div class="footer-top">
                <div class="container">
                  <div class="pull-right">
                    <img class="footer-image"src="{{asset('images/home/footer-image.png')}}" alt="" />
                  </div>
                </div>
            </div>

            <!--<div class="footer-widget">
                <div class="container">

                </div>
            </div> -->

            <div class="footer-bottom">
                <div class="container">
                  <div class="col-sm-12">

                    <p class="pull-left"style="color:white;font-size:9px">Copyright © {{date('Y')}} Dept. Electrical Engineering and Information Technology | All rights reserved.</p>
                    <p class="pull-right"style="color:white;font-size:9px"><span>Designed and Builded by <a target="_blank" href="http://www.sensativ.com">www.sensativ.com</a></span></p>

                  </div>
                </div>
            </div>

        </footer><!--/Footer-->

        <script src="{{asset('js/jquery.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
        <script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
    </body>
</html>

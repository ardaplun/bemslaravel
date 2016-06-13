<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Designed and builded by Sensativ Engineer in the terms of contribution for Dept. Electrical Engineering and Information Technology UGM">
        <meta name="author" content="Sentativ by Yulian Tenta Wardana">
        <title>UGM Building Management System </title>
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/prettyPhoto.css')}}" rel="stylesheet">
        <link href="{{asset('css/animate.css')}}" rel="stylesheet">
        <link href="{{asset('css/main.css')}}" rel="stylesheet">
        <link href="{{asset('css/bems.css')}}" rel="stylesheet">
        <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
        <link href="{{asset('css/tree.css')}}" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="{{asset('js/html5shiv.js')}}"></script>
        <script src="{{asset('js/respond.min.js')}}"></script>
        <![endif]-->
        <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="{{asset('js/date_time.js')}}"></script>
        <script type="text/javascript">
        $(document).ready(function () {
          date_time('date_time');
        });</script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>



    </head><!--/head-->

    <body>
        <header id="header"><!--header-->
            <div class="header_top"><!--header_top-->
                <div class="container">

                </div>
            </div><!--/header_top-->

            <div class="header-middle" style="background-color:#22334d;height:25px;"><!--header-middle-->
                <div class="container">

                </div>
            </div><!--/header-middle-->

            <div class="header-bottom"><!--header-bottom-->
                <div class="container">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="row">
                            <div class="logo center-logo" style="line-height:5em">
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
                              <div class="show-date" >{{date(" M Y")}}</div>


                            </div>
                            <div class="mainmenu pull-right center-nav">
                                <ul class="nav navbar-nav collapse navbar-collapse vertical">
                                    <li style="padding: 0em 2em  0em 2em;"><a href="{{url('')}}" {{$page == 'home' ? 'class=active' : ''}}>HOME</a></li>
                                    <li style="padding: 0em 2em  0em 2em;"><a href="{{url('menu')}}" {{$page == 'menu' ? 'class=active' : ''}}>MENU</a></li>
                                    <!-- <li style="padding: 0em 2em  0em 2em;"><a href="{{url('about-us')}}" {{$page == 'about-us' ? 'class=active' : ''}}>ABOUT US</a></li> -->
                                    <li style="padding: 0em 2em  0em 2em;"><a href="#" data-toggle="modal" data-target="#aboutus">ABOUT US</a></li>
                                    <li style="padding: 0em 2em  0em 2em;"><a href="{{url('login')}}" {{$page == 'login' ? 'class=active' : ''}}>LOGIN</a></li>
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

                    <p class="pull-left"style="color:#22334d;font-size:9px">Copyright © {{date('Y')}} Dept. of Electrical Engineering and Information Technology | All rights reserved.</p>
                    <p class="pull-right"style="color:#22334d;font-size:9px"><span>Designed by Smart System Research Group and <a target="_blank" href="http://www.sensativ.com">Sensativ</a></span></p>

                  </div>
                </div>
            </div>

        </footer><!--/Footer-->

        <script src="{{asset('js/jquery.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
        <script src="{{asset('js/jquery.prettyPhoto.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>

        <!-- about us modal -->
        <div class="modal fade" id="aboutus"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">ABOUT US</h4>
              </div>
              <div class="modal-body">
                <div style="text-align:center;">
                  <img src="{{asset('images/UGM_3D_NEW_resize.jpg')}}" style="max-height:80px;">&emsp;&emsp;
                  <img src="{{asset('images/logo esystem lab_small.jpg')}}" style="max-height:80px;">&emsp;&emsp;
		  <img src="{{asset('images/Logo_Kemenristekdikti_small.png')}}" style="max-height:80px;">&emsp;&emsp;
		  <img src="{{asset('images/multikom.png')}}" style="max-height:80px;">
		  <img src="{{asset('images/logo sensativ_small.jpg')}}" style="max-height:80px;">		
                </div>
                <br/><br/>
                <strong>UGM BEMS</strong> <br />
                <span id="version-detail"></span>
		Version  : 1.0.0 (01-06-2016) <br>
                Copyright 2016, Smart System Research Group <br>
		Dept. of Electrical Engineering and Information Technology.

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    </body>
</html>

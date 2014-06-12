<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/favicon.ico" />

    <title>DensityPro</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <style>
     /*
      * Globals
      */

     /* Links */
     a,
     a:focus,
     a:hover {
       color: #fff;
     }

     /* Custom default button */
     .btn-default,
     .btn-default:hover,
     .btn-default:focus {
       color: #333;
       text-shadow: none; /* Prevent inheritence from `body` */
       background-color: #fff;
       border: 1px solid #fff;
     }


     /*
      * Base structure
      */

     html,
     body {
       height: 100%;
       background-color: #333;
       background: url('/images/WP_20131226_005.jpg');       
       background-repeat: no-repeat;
       background-size: cover;
       background-position: center;
       background-attachement: fixed;
       width: 100%;
       height: 100%;

     }
     body {
       color: #fff;
       text-align: center;
       text-shadow: 1px 2px 1px rgba(0,0,0,.7);
       box-shadow: inset 0 0 100px rgba(0,0,0,.5);
     }

     /* Extra markup and styles for table-esque vertical and horizontal centering */
     .site-wrapper {
       display: table;
       width: 100%;
       height: 100%; /* For at least Firefox */
       min-height: 100%;
       background-color: rgba(0, 0, 0, 0.2);
     }
     .site-wrapper-inner {
       display: table-cell;
       vertical-align: top;
     }
     .cover-container {
       margin-right: auto;
       margin-left: auto;
     }

     /* Padding for spacing */
     .inner {
       padding: 30px;
       /*       background-color: rgba(0, 0, 0, 0.2); */
     }


     /*
      * Header
      */
     .masthead-brand {
       margin-top: 10px;
       margin-bottom: 10px;
     }

     .masthead-nav > li {
       display: inline-block;
     }
     .masthead-nav > li + li {
       margin-left: 20px;
     }
     .masthead-nav > li > a {
       padding-right: 0;
       padding-left: 0;
       font-size: 16px;
       font-weight: bold;
       color: #fff; /* IE8 proofing */
       color: rgba(255,255,255,.75);
       border-bottom: 2px solid transparent;
     }
     .masthead-nav > li > a:hover,
     .masthead-nav > li > a:focus {
       background-color: transparent;
       border-bottom-color: rgba(255,255,255,.25);
     }
     .masthead-nav > .active > a,
     .masthead-nav > .active > a:hover,
     .masthead-nav > .active > a:focus {
       color: #fff;
       border-bottom-color: #fff;
     }

     @media (min-width: 768px) {
       .masthead-brand {
	 float: left;
       }
       .masthead-nav {
	 float: right;
       }
     }


     /*
      * Cover
      */

     .cover {
       padding: 0 20px;
     }
     .cover .btn-lg {
       padding: 10px 20px;
       font-weight: bold;
     }


     /*
      * Footer
      */

     .mastfoot {
       color: #999; /* IE8 proofing */
       color: rgba(255,255,255,.5);
     }


     /*
      * Affix and center
      */

     @media (min-width: 768px) {
       /* Pull out the header and footer */
       .masthead {
	 position: fixed;
	 top: 0;
       }
       .mastfoot {
	 position: fixed;
	 bottom: 0;
       }
       /* Start the vertical centering */
       .site-wrapper-inner {
	 vertical-align: middle;
       }
       /* Handle the widths */
       .masthead,
       .mastfoot,
       .cover-container {
	 width: 100%; /* Must be percentage or pixels for horizontal alignment */
       }
     }

     @media (min-width: 992px) {
       .masthead,
       .mastfoot,
       .cover-container {
	 width: 700px;
       }
     }     
    </style>
  </head>
  
  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand" style="font-family: Lucida Sans Unicode;">DensityPro</h3>
              <ul class="nav masthead-nav">
		@if(!Auth::check())
                <li class="active"><a href="/login">Sign In</a></li>		
		@else
		<li class="active"><a href="/home"><span class="glyphicon glyphicon-home" ></span> {{ Auth::user()->account->companyname }}</a></li>
                <li class="active"><a href="/logout">Logout</a></li>
		@endif
		<!--                <li><a href="#">Features</a></li>
                <li><a href="#">Contact</a></li> -->
              </ul>
            </div>
          </div>

          <div class="inner cover">
            <h1 class="cover-heading">Density Test Software</h1>
            <p class="lead">Density test organization and storage in the cloud for soil engineers and soil technicians.</p>
	    <p class="lead">
	      @if(!Auth::check())
	      <a class="btn btn-primary btn-lg" href="/register">Register</a>
	      @else
	      <a class="btn btn-primary btn-lg" href="/home">Home</a>
	      @endif
	    </p>
          </div>

	  <div class="row marketing">
	    <div class="col lg-6" style="text-align: left;">
	      <p><span class="glyphicon glyphicon-ok"></span> Digitize density tests as they are taken in the field.</p>
	      <p><span class="glyphicon glyphicon-ok"></span> Store data and files for multiple projects.</p>
	      <p><span class="glyphicon glyphicon-ok"></span> Access density test data any time from any device.</p>
	      <p><span class="glyphicon glyphicon-ok"></span> Offered with simple payment plans and built with secure technology used by major companies worldwide.</p>
	      <p>Currently in free and open beta.</p>
	    </div>
	  </div>

          <div class="mastfoot">
            <div class="inner">
              <span>&copy;2013-<?php echo date("Y"); ?> Devlabtech </span>&middot; 
	      <a href="/contact">Contact</a> &middot; 
	      <a href="/features">Features</a> &middot; 
	      <a href="/about">About</a> &middot; 
	      <a href="/help">Help</a> 
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script>
     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
       (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

     ga('create', 'UA-50133892-1', 'densitypro.com');
     ga('send', 'pageview');

    </script>
  </body>
</html>

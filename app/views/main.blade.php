<!doctype html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Digitize density tests in the field and store in the cloud"/>
    <meta name="keywords" content="soil testing, density test software, geotechnical engineering, soil technician, cloud storage, construction testing"/>
    <title>DensityPro</title>
    {{ HTML::style('/css/bootstrap.min.css') }}
    {{ HTML::style('/css/main.css') }}
    <link href="/css/pace.css" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" />
    @yield('underheader')
  </head>

  <body>

    <div id="wrap">
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            @yield('brandlink')
          </div>

          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
	      @yield('navmenu')
              @if(!Auth::check())
		<li>{{ HTML::link('/register', 'Register') }}</li> 
		<li>{{ HTML::link('/login', 'Sign In') }}</li>
	      @else
		<li><a href="/settings">Settings</a></li>
		<li><a href="/logout">Logout</a></li>
	      @endif
            </ul>

          </div><!--/.nav-collapse -->

	</div>

      </div>

      <!-- CONTENT -->    

      <div class="container" id="maincontainer">
	@yield('content')
      </div>
    </div>


    <!-- FOOTER -->
    <footer>
      <div class="container">
	<p>
	  DensityPro &copy;2014-<?php echo date("Y"); ?> Devlabtech &middot; 
	  <a href="/contact">Contact</a> &middot; 
	  <a href="/features">Features</a> &middot; 
	  <a href="/about">About</a> &middot; 
	  <a href="/help">Help</a> 
          <!--    <a href="/privacy">Privacy and Terms</a> &middot; 
	  -->
	</p>
      </div>
    </footer>


    <script src="/js/jquery1.10.2.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script src="/js/pace.js"></script>
    <script>
     $(document).ready( function() {
     });
    </script>
    @yield('underbody')
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

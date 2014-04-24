<!doctype html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DensityPro</title>
    {{ HTML::style('/css/bootstrap.min.css') }}
    {{ HTML::style('/css/main.css') }}
    <link href="/js/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet">
    @yield('underheader')
  </head>

  <body>

    <div id="wrap">
      <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
<!--		<li>{{ HTML::link('/register', 'Register') }}</li>   -->
		<li>{{ HTML::link('/login', 'Sign In') }}</li>
	      @else
		<li><a href="/home">{{ Auth::user()->account->companyname }} Home</a></li>
		<li><a href="/settings">Settings</a></li>
		<li><a href="/logout">Logout</a></li>
		<!--
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->firstname.' '.Auth::user()->lastname }} <b class="caret"></b></a>
		  <ul class="dropdown-menu">
                    <li><a href="/home"><span class="glyphicon glyphicon-home"></span>Home</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Account</li>
                    <li><a href="#">Separated link</a></li>
                    <li><a href="/settings"><span class="glyphicon glyphicon-cog"></span>Settings</a></li>
		    <li><a href="/logout"><span class="glyphicon glyphicon-off"></span>Logout</a></li>
		  </ul>
		</li>
		-->
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
	  DensityPro &copy;<?php echo date("Y"); ?> Devlabtech
	  <!-- &middot; 
	  <a href="/privacy">Privacy</a> &middot; 
	  <a href="/terms">Terms</a> &middot; 
	  <a href="/features">Features</a> &middot; 
	  <a href="/about">About</a>
	  -->
	</p>
      </div>
    </footer>


    <script src="/js/jquery1.10.2.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
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

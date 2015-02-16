@extends('main')

@section('brandlink')
  @if (Auth::check())
    <a class="navbar-brand" href="/home">DensityPro</a>
  @else
    <a class="navbar-brand" href="/">DensityPro</a>
  @endif
@stop

@section('content') 
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1 class="cover-heading">Density Test Software</h1>
      <p class="lead">Digitize density tests in the field and store them in the cloud</p>
     
      <style>
	.carousel-caption{
	 text-stroke: 1px black;
	 color: white;
	 text-shadow:    
	 -1px -1px .1em #000,  
	 1px -1px 0.1em #000,
	 -1px 1px 0.1em #000,
	 1px 1px 0.1em #000;
       }
      </style>

      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="height: 350px;">
	<!-- Wrapper for slides -->
	<div class="carousel-inner">
	  <div class="item active">
	    <img src="/images/image002re.jpg" alt="Project Selection">
	    <div class="carousel-caption">
	    </div>
	  </div>

	  <div class="item">
	    <img src="/images/image003re.jpg" alt="Project Overview">
	    <div class="carousel-caption">
	    </div>
	  </div>
	</div>

	<!-- Controls -->
	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
	  <span class="glyphicon glyphicon-chevron-left"></span>
	</a>
	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
	  <span class="glyphicon glyphicon-chevron-right"></span>
	</a>
      </div>

      <br>

      <p class="lead" style="text-align: center;">
	@if(!Auth::check())
	  <a class="btn btn-primary btn-lg" href="/register">Register</a>
	  <a class="btn btn-lg btn-default" href="/login">Sign In</a>
	@else
	  <a class="btn btn-primary btn-lg" href="/home">Home</a>
	@endif
      </p>

      <p><span class="glyphicon glyphicon-ok"></span> No need to digitize data by hand in the office.</p>
      <p><span class="glyphicon glyphicon-ok"></span> Access density test data any time from any device.</p>
      <p><span class="glyphicon glyphicon-ok"></span> Store data and files for multiple projects.</p>
      <p><span class="glyphicon glyphicon-ok"></span> Software aimed at Soil Technicians, Soil and Geotechnical Engineers, and Geologists.</p>
      <p><span class="glyphicon glyphicon-ok"></span> Offered with simple payment plans and built with secure technology used by major companies worldwide.</p>
      <p>Currently in free and open beta.</p>
    </div>
  </div>
@stop

@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/">DensityPro</a>
@stop

@section('content') 
  <div class="row">
    <div class="col-md-6 col-md-offset-2">
      <h1 class="cover-heading">Density Test Software</h1>
      <p class="lead">Digitize density tests in the field and store them in the cloud</p>
      <p class="lead" style="text-align: center;">
	@if(!Auth::check())
	  <a class="btn btn-primary btn-lg" href="/register">Register</a>
	  <a class="btn btn-lg" href="/login">Sign In</a>
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

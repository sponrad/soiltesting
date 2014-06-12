@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/">DensityPro</a>
@stop

@section('content') 
  <div class="row">
    <div class="col-md-6 col-md-offset-2">
      <h2>Features</h2>
      <p>DensityPro makes density testing of soil and other materials easier</p>
      <p><span class="glyphicon glyphicon-ok"></span> Store tests digitally at the time of the test, using mobile device, or from computer</p>
      <p><span class="glyphicon glyphicon-ok"></span> Tests are stored in the cloud for easy access from anywhere</p>
      <p><span class="glyphicon glyphicon-ok"></span> Easily edit tests</p>
      <p><span class="glyphicon glyphicon-ok"></span> Store tests for multiple projects</p>
      <p><span class="glyphicon glyphicon-ok"></span> Maximum densities are stored along with tests for easy access to any job</p>
      <p><span class="glyphicon glyphicon-ok"></span> Enter notes for a job, these notes stay in one place and are easy to access</p>
      <p><span class="glyphicon glyphicon-ok"></span> Add notes for individual tests</p>
      <p><span class="glyphicon glyphicon-ok"></span> Export data into csv format which can be loaded to popular spreadsheet programs like Microsoft Excel.</p>
      <p><span class="glyphicon glyphicon-ok"></span> Unit agnostic, works with US and metric units</>p
      <p><span class="glyphicon glyphicon-ok"></span> Calculates wet density, dry density, percent moisture, and percent relative compaction when values are entered</p>
      <!--       <p><span class="glyphicon glyphicon-ok"></span> </p>  -->
      @if( !Auth::check() )
	<p>
	  <a class="btn btn-primary btn-lg" href="/register">Register</a>
	</p>
      @endif
    </div>
  </div>
@stop

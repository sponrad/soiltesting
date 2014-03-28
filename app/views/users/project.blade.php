@extends('main')

@section('underheader')
  <link rel="stylesheet" href="js/jqfu9.5.7/css/jquery.fileupload.css">
  <link rel="stylesheet" href="js/jqfu9.5.7/css/jquery.fileupload-ui.css">
@stop

@section('underbody')

@stop

@section('content')
  <input type="text" placeholder="Search" style="float: right;" />
  <h3 style="margin-top:0px;">{{ Auth::user()->account->companyname }}</h3>

  <h3>{{ $project->name }}  </h3>

  <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="float: right;">Add a Test</button>

  <a href="/home/{{ $project->id}}-{{$project->name}}">Dashboard</a> | 
  <a href="/home/{{ $project->id}}-{{$project->name}}">Map</a> | 
  <a href="/home/{{ $project->id}}-{{$project->name}}">Tests</a> | 
  <a href="/home/{{ $project->id}}-{{$project->name}}">Pictures</a> | 
  <a href="/home/{{ $project->id}}-{{$project->name}}">Project Settings</a>

  <br>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
	<div class="modal-header">
	  <h2>New Test</h2>
	</div>
	<div class="modal-body">
	  {{ Form::open(array('url'=>'/home', 'class'=>'form-new-test')) }}
	  {{ Form::hidden('action', 'createtest') }}
	  {{ Form::text('testname', null, array('class'=>'input-block-level', 'placeholder'=>'Test Name')) }}
	  <br>
	  {{ Form::submit('Create', array('class'=>'btn btn-large btn-primary')) }}
	  {{ Form::close() }}
	</div>
      </div>
    </div>
  </div>
  
  <h3>Recent Tests</h3>
  
  @if (count($tests) > 0)
    <p>Link to view all tests</p>
  @else
    <p>No tests added yet.</p>
  @endif


  <h3>Proctors</h3>

  <button class="btn btn-primary" data-toggle="modal" data-target="#proctorModal">Add a Proctor</button>

  <br><br>
  
  @if (count($proctors) > 0)
    <table class="table">
      <tr>
	<th>Name</th>
	<th>Dry Density</th>
	<th>Percent Moisture</th>
	<th>Description</th>
      </tr>
    @foreach($proctors as $key => $proctor)
      <tr>
	<td>{{ $proctor->name }}</td>
	<td>{{ number_format($proctor->density_dry, 1) }}</td>
	<td>{{ number_format( $proctor->percent_moisture, 1) }}</td>
	<td>{{ $proctor->description }}</td>
      </tr>
    @endforeach
    </table>
  @else
    <p>No proctors for this project yet.</p>
  @endif

  <div class="modal fade" id="proctorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
	<div class="modal-header">
	  <h2>New Proctor</h2>
	  <div>{{ $project->name }}</div>
	</div>
	<div class="modal-body">
	  {{ Form::open(array('class'=>'form-new-test')) }}
	  {{ Form::hidden('action', 'createproctor') }}
	  {{ Form::text('name', null, array('class'=>'input-block-level', 'placeholder'=>'Name')) }}
	  {{ Form::text('description', null, array('class'=>'input-block-level', 'placeholder'=>'Description')) }}
	  {{ Form::text('date', null, array('class'=>'input-block-level', 'placeholder'=>'Date')) }}
	  <!--	  {{ Form::text('density_wet', null, array('class'=>'input-block-level', 'placeholder'=>'Wet Density')) }} --> 
	  {{ Form::text('density_dry', null, array('class'=>'input-block-level', 'placeholder'=>'Dry Density')) }}
	  {{ Form::text('percent_moisture', null, array('class'=>'input-block-level', 'placeholder'=>'Moisture %')) }}


	  <br>
	  {{ Form::submit('Add Proctor', array('class'=>'btn btn-large btn-primary')) }}

	  {{ Form::close() }}
	</div>
      </div>
    </div>
  </div>
  
  @if (count($tests) > 0)
    @foreach($tests as $key => $test)
      <br>
      <a href="/home/{{ $test->id }}-{{ $test->name }}">{{ $test->number }}</a>
    @endforeach
  @endif
@stop

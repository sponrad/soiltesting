@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/home">{{$project->name}}</a>
@stop

@section('underheader')
@stop

@section('underbody')

@stop

@section('content')
  <ul class="nav nav-tabs">
    <li class="active"><a href="/home/{{ $project->id}}-{{$project->name}}">Overview</a></li>
    <li class=""><a href="/home/{{ $project->id}}-{{$project->name}}/tests">Tests</a></li>
    <li class=""><a href="/home/{{ $project->id}}-{{$project->name}}/files">Files</a></li>
  </ul>

  <div class="row">
    <div class="col-md-6">
      <h3>Project Information</h3>
      <p>Project Name</p>
      <p>Contact Information</p>
      <p>Important notes</p>
      <a href="">Link to edit</a>
    </div>

    <div class="col-md-6">
      <h3>Recent Files <a href="/home/{{ $project->id}}-{{$project->name}}/files"><small>(see all)</small></a></h3>
      <p>No Files</p>
    </div>
  </div>

  <h3>Recent Tests <a href="/home/{{ $project->id}}-{{$project->name}}/tests"><small>(see all)</small></a></h3>

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

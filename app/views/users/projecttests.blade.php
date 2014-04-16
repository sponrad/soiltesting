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
    <li class=""><a href="/home/{{ $project->id}}-{{$project->name}}">Overview</a></li>
    <li class="active"><a href="/home/{{ $project->id}}-{{$project->name}}/tests">Tests</a></li>
    <li class=""><a href="/home/{{ $project->id}}-{{$project->name}}/files">Files</a></li>
  </ul>
  
  <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">New Test</button>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
	<div class="modal-header">
	  <h2>New Test</h2>
	</div>
	<div class="modal-body">	  
	  {{ Form::open(array('url'=>'/home/'.$project->id.'-'.$project->name.'/tests', 'class'=>'form-horizontal', 'role'=>'form')) }}	  
	  {{ Form::hidden('action', 'createtest') }}

	  <div class="form-group">
	    <label for="elevation" class="col-sm-3 control-label">Elevation</label>
	    <div class="col-sm-9">
	      {{ Form::text('elevation', null, array('class'=>'form-control', 'placeholder'=>'elevation')) }}
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="density_wet" class="col-sm-3 control-label">Wet Density</label>
	    <div class="col-sm-9">
	      {{ Form::text('density_wet', null, array('class'=>'form-control', 'placeholder'=>'density_wet')) }}
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="density_dry" class="col-sm-3 control-label">Dry Density</label>
	    <div class="col-sm-9">
	      {{ Form::text('density_dry', null, array('class'=>'form-control', 'placeholder'=>'density_dry')) }}
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="percent_moisture" class="col-sm-3 control-label">Moisture %</label>
	    <div class="col-sm-9">
	      {{ Form::text('percent_moisture', null, array('class'=>'form-control', 'placeholder'=>'percent_moisture')) }}
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="proctor" class="col-sm-3 control-label">Proctor</label>
	    <div class="col-sm-9">
	      <select class="form-control" name="proctor">
		@foreach($proctors as $key => $proctor)
		  <option id="{{$proctor->id}}" value="{{$proctor->id}}">{{ number_format($proctor->density_dry, 1) }} @ {{ number_format($proctor->percent_moisture, 1) }}% - {{$proctor->name}}</option>
		@endforeach
	      </select>
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="compaction_percent" class="col-sm-3 control-label">Compaction %</label>
	    <div class="col-sm-9">
	      {{ Form::text('compaction_percent', null, array('class'=>'form-control', 'placeholder'=>'compaction_percent')) }}
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="location" class="col-sm-3 control-label">Location</label>
	    <div class="col-sm-9">
	      {{ Form::text('location', null, array('class'=>'form-control', 'placeholder'=>'location')) }}
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-sm-offset-3 col-sm-9">
	      {{ Form::submit('Create', array('class'=>'btn btn-large btn-primary')) }}
	    </div>
	  </div>
	  
	  {{ Form::close() }}
	  
	</div>
      </div>
    </div>
  </div>
  
  @if (count($tests) > 0)
    <table class="table">
      <tr>
	<th>No.</th>
	<th>Dry Dens.</th>
	<th>m%</th>
	<th>rel. %</th>
	<th>Max.</th>
      </tr>
      @foreach($tests as $key => $test)
	<tr>
	  <td>{{ $key+1 }}</td>
	  <td>{{ number_format($test->density_dry, 1) }}</td>
	  <td>{{ number_format($test->percent_moisture, 1) }}</td>
	  <td>{{ number_format($test->compaction_percent, 1) }}</td>
	  <td>{{ number_format($test->proctor->density_dry, 1) }}</td>
	</tr>
    @endforeach
    </table>
  @else
    <p>No tests added yet.</p>
  @endif
@stop

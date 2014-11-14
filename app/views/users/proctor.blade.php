@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/home">{{$project->name}}</a>
@stop

@section('underheader')
@stop

@section('navmenu')
  <li><button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-check"></span> Record Test</button></li>
@stop

@section('underbody')
  @include('users.recordtestmodal')
@stop

@section('content')
  <ul class="nav nav-tabs">
    <li class=""><a href="/home/{{ $project->id}}-{{$project->name}}">Overview</a></li>
    <li class=""><a href="/home/{{ $project->id}}-{{$project->name}}/tests">Tests</a></li>
  </ul>

  <br>
  <div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <span>Caution-Editing numbers will affect tests referencing this Maximum Density</span>
  </div>

  <h1>{{ $editingproctor->name }}</h1>

  {{ Form::open(array('url'=>URL::route('postProctor', array($project->id, $project->name, $editingproctor->id )), 'class'=>'form-horizontal', 'role'=>'form')) }}	  
  {{ Form::hidden('action', 'editproctor') }}

  <div class="form-group">
    <label for="name" class="col-sm-4 control-label">Name</label>
    <div class="col-sm-8">
      {{ Form::text('name', $editingproctor->name, array('class'=>'input-block-level', 'placeholder'=>'Name')) }}
    </div>
  </div>
  <div class="form-group">
    <label for="description" class="col-sm-4 control-label">Description</label>
    <div class="col-sm-8">
      {{ Form::text('description', $editingproctor->description, array('class'=>'input-block-level', 'placeholder'=>'Description')) }}
    </div>
  </div>
<!--   <div class="form-group">
    <label for="date" class="col-sm-4 control-label">Date</label>
    <div class="col-sm-8">
      {{ Form::text('date', $editingproctor->date, array('class'=>'input-block-level', 'placeholder'=>'Date')) }}
    </div>
  </div> -->
  <!--	  {{ Form::text('density_wet', number_format($editingproctor->density_wet, 1), array('class'=>'input-block-level', 'placeholder'=>'Wet Density')) }} --> 
  <div class="form-group">
    <label for="density_dry" class="col-sm-4 control-label">Dry Density</label>
    <div class="col-sm-8">
      {{ Form::text('density_dry', number_format($editingproctor->density_dry, 1), array('class'=>'input-block-level', 'placeholder'=>'Dry Density')) }}
    </div>
  </div>
  <div class="form-group">
    <label for="percent_moisture" class="col-sm-4 control-label">Percent Moisture</label>
    <div class="col-sm-8">
      {{ Form::text('percent_moisture', number_format($editingproctor->percent_moisture, 1), array('class'=>'input-block-level', 'placeholder'=>'Moisture %')) }}
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      {{ Form::submit('Save Maximum Density', array('class'=>'btn btn-large btn-primary')) }}

      <a class="btn btn-default" href="/home/{{ $project->id}}-{{$project->name}}">Cancel</a>
    </div>
  </div>
  
  {{ Form::close() }}
@stop

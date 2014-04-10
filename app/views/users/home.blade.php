@extends('main')

@section('underheader')
  <link rel="stylesheet" href="js/jqfu9.5.7/css/jquery.fileupload.css">
  <link rel="stylesheet" href="js/jqfu9.5.7/css/jquery.fileupload-ui.css">
@stop

@section('underbody')

@stop

@section('content')
  <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="float: right;">New Project</button>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
	<div class="modal-header">
	  <h2>New Project</h2>
	</div>
	<div class="modal-body">
	  {{ Form::open(array('url'=>'/home', 'class'=>'form-new-project')) }}
	  {{ Form::hidden('action', 'createproject') }}
	  {{ Form::text('projectname', null, array('class'=>'input-block-level', 'placeholder'=>'Project Name')) }}
	  <br>
	  {{ Form::submit('Create', array('class'=>'btn btn-large btn-primary')) }}
	  {{ Form::close() }}
	</div>
      </div>
    </div>
  </div>
  
  @if (count($projects) > 0)
    @foreach($projects as $key => $project)
      <br>
      <a href="/home/{{ $project->id }}-{{ $project->name }}">{{ $project->name }}</a>
    @endforeach
  @endif
@stop

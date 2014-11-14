@extends('main')

@section('brandlink')
  <div class="navbar-brand">{{ Auth::user()->account->companyname }}</div>  
@stop

@section('underheader')
  <link rel="stylesheet" href="js/jqfu9.5.7/css/jquery.fileupload.css">
  <link rel="stylesheet" href="js/jqfu9.5.7/css/jquery.fileupload-ui.css">
@stop

@section('underbody')
  <style>
   .projectBox{
     text-align: center;
   }
   a.projectLink{
     color: black;
     display: inline-block;
     max-width: 150px;
     min-width: 50px; 
     width: 40%;
     height: 150px;
     padding: 15px;
     margin: 5px;
     border: solid 1px gray;
     background: #E0EAF4;
     float: left;
     position: relative;
     border-radius: 10px;
   }
   a.projectLink:hover{
     text-decoration: none;
     backround-color: #428bca;
     background: #428bca;
     color: white;    
   }
   a.projectLink:active{
     text-decoration: none;
     backround-color: #eeeeff;
     background: #eeeeff;
     color: white;    
   }
   .testDiv{     
     font-size: 85%;
   }
  </style>
@stop

@section('content')
  @if( Session::get('message') )
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{ Session::get('message') }}
    </div>
  @endif

  <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="">New Project</button> <br><br>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
	<div class="modal-header">
	  <h2>New Project</h2>
	</div>
	<div class="modal-body">
	  {{ Form::open(array('url'=>'/home', 'class'=>'form-new-project', 'role'=>'form')) }}
	  {{ Form::hidden('action', 'createproject') }}
	  <div class="form-group">
	    <label for="projectname">Project Name</label>
	    {{ Form::text('projectname', null, array('class'=>'input-block-level', 'placeholder'=>'Project Name')) }}
	  </div>
	  
	  <div class="form-group">
	    {{ Form::submit('Create', array('class'=>'btn btn-large btn-primary')) }}
	    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	  </div>
	  {{ Form::close() }}
	</div>
      </div>
    </div>
  </div>
  
  @if (count($projects) > 0)
    @foreach($projects as $key => $project)
      <div class="projectBox">
	<a class="projectLink" href="/home/{{ $project->id }}-{{ $project->name }}">
	  {{ $project->name}}
	  <br><br>
	  @if ($project->tests->count() > 0)
	  <p class="testDiv">{{ $project->tests->count()}} Tests</p>
	  <p class="testDiv">Latest: {{ $project->tests->last()->created_at->format('n/d/y')  }}</p>
	  @else
	  <p>No tests yet</p>
	  @endif
	</a>
      </div>
    @endforeach
  @endif
@stop

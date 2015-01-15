@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/home">{{$project->name}}</a>
@stop

@section('underheader')
  <style>
   #notes{
     border: dashed 2px #cc8;
     padding: 10px;
   }
   .editable-input {
     width: 200%;
   }
   .editableform .form-control {
     /*width: 400px;*/
     width: 100%;
   }
   #allTestsLink{
     color: #ccc;
   }

  </style>
@stop

@section('navmenu')
@stop

@section('underbody')
  @include('users.recordtestmodal')

  <script>
   $(document).ready( function(){
     $("#deleteProjectButton").click( function(event){
       event.preventDefault();
       if (confirm("Are you sure you want to delete this project?")){
	 $(event.target).parent().submit();
       }
       else {
       }
     })
     
     $.fn.editable.defaults.mode = 'popup'; //popup inline

     $('#notes').editable({
       type:  'textarea',
       pk:    {{ $project->id }},
       mode: 'inline',
       name:  'notes',
       emptytext: "Add notes here",
       params: {
	 action: 'projectnotes'
       },
       url:   '/editable',  
       title: 'Project Notes'
     });
   });
  </script>
@stop

@section('content')
  <ul class="nav nav-tabs">
    <li><a href="/home/{{ $project->id}}-{{$project->name}}/tests">Tests</a></li>
    <li><a href="/home/{{ $project->id}}-{{$project->name}}/proctors">Proctors</a></li>
    <li class="active"><a href="/home/{{ $project->id}}-{{$project->name}}">Other</a></li>
  </ul>

  <div class="row">

    @if( Session::get('message') )
      <br>
      <div class="col-md-12">
	<div class="alert alert-info alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  {{ Session::get('message') }}
	</div>
      </div>
    @endif

    <div class="col-md-5">
      <h3>Settings</h3>
      <br>

      <button class="btn btn-default" data-toggle="modal" data-target="#projectNameModal">Change Project Name</button>
      <br><br>

      <a class="btn btn-default" title="Download a file containing project information, proctors, and test data in CSV format" href="/home/{{ $project->id }}-{{ $project->name }}/export">CSV Export</a>      
      <br><br>

      {{ Form::open(array('class'=>'form-delete-project', 'role'=>'form')) }}
      <input type="hidden" name="action" value="deleteproject" />
      <input type="submit" value="Delete Project" class="btn btn-default" id="deleteProjectButton" title="You will be prompted for confirmation prior to deleting"></input>
      {{ Form::close() }}
    </div>

    <div class="col-md-7">
      <h3 id="informationHeading">Notes</h3>
      <div id="notes" title="Click or tap to edit" placeholder="Enter notes here">{{ $project->notes }}</div>
    </div>

  </div>





  <div class="modal fade" id="projectNameModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
	<div class="modal-header">
	  <h2>Change Project Name</h2>
	  <p>{{ $project->name }}</p>
	</div>
	<div class="modal-body">
	  {{ Form::open(array('class'=>'form-change-project-name', 'role'=>'form')) }}
	  {{ Form::hidden('action', 'changeprojectname') }}
	  <div class="form-group">
	    <label for="projectname">Project Name</label>
	    {{ Form::text('projectname', $project->name, array('class'=>'input-block-level', 'placeholder'=>$project->name)) }}
	  </div>
	  
	  <div class="form-group">
	    {{ Form::submit('Change', array('class'=>'btn btn-large btn-primary')) }}
	  </div>
	  {{ Form::close() }}
	</div>
      </div>
    </div>
  </div>
  
@stop

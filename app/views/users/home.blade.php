@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/home">{{ Auth::user()->account->companyname }}</a>  
@stop

@section('underheader')
  <link rel="stylesheet" href="js/jqfu9.5.7/css/jquery.fileupload.css">
  <link rel="stylesheet" href="js/jqfu9.5.7/css/jquery.fileupload-ui.css">
@stop

@section('underbody')
  <style>
   .table tbody > tr{
     cursor: pointer;
   }
  </style>
  <script>
   $(document).ready( function(){
     $('.table tbody > tr').click(function(e) {
       window.location.replace($(this).data("href"));
     });

     $('#myModal').on('shown.bs.modal', function () {
       $("#projectname").focus();
     })
   });
  </script>
@stop

@section('content')
  @if( Session::get('message') )
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{ Session::get('message') }}
    </div>
  @endif

  <button class="btn btn-primary" id="new-project" data-toggle="modal" data-target="#myModal" style="">New Project</button> <br><br>

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
	    {{ Form::text('projectname', null, array('class'=>'input-block-level', 'placeholder'=>'Project Name', 'id'=>'projectname')) }}
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
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Project</th>
          <th>Tests</th>
          <th>Last Tested</th>
        </tr>
      </thead>

      <tbody>
        @foreach($projects as $key => $project)
          <tr data-href="/home/{{ $project->id }}-{{ $project->name }}/tests">
            <td>{{ $project->updated_at }} {{ $project->name}}</td>
	    @if ($project->tests->count() > 0)
              <td>{{ $project->tests->count()}}</td>
              <td>{{ $project->tests->last()->created_at->format('n/d/y')  }}</td>
	    @else
              <td></td>
              <td></td>
	    @endif
        @endforeach
      </tbody>
    </table>

  @endif
@stop


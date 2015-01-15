@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/home">{{$project->name}}</a>
@stop

@section('underheader')
  <style>
   #informationHeading{
     background: none;
     border-bottom: 4px solid #ed9c28; 
     color: #333;
     padding: 4px;
     margin-bottom: 10px;
   }
   #testsHeading{
     background: none;
     border-bottom: 4px solid #d2322d;
     color: #333;
     padding: 4px;
     margin-bottom: 10px;
   }
   #proctorsHeading{
     background: none;
     border-bottom: 4px solid #39b3d7;
     color: #333;
     padding: 4px;
     margin-bottom: 10px;
   }
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
   .form-delete-project{
     display: inline;
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
    <li class="active"><a href="/home/{{ $project->id}}-{{$project->name}}/proctors">Proctors</a></li>
    <li><a href="/home/{{ $project->id}}-{{$project->name}}">Other</a></li>
  </ul>

  @if( Session::get('message') )
    <br>
    <div class="col-md-12">
      <div class="alert alert-info alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	{{ Session::get('message') }}
      </div>
    </div>
  @endif

  <br>

  <button class="btn btn-primary" data-toggle="modal" data-target="#proctorModal">Add a Maximum Density</button>

  <br><br>
  
  @if (count($proctors) > 0)
    <table class="table table-hover" id="proctorTable">
      <tr>
	<th>Name</th>
	<th>Max. Dry Density</th>
	<th>Percent Moisture</th>
	<th>Description</th>
      </tr>
    @foreach($proctors as $key => $proctor)
      <tr>
	<td>
	  <a href="{{ URL::route("getProctor", array($project->id, $project->name, $proctor->id) ) }}" class="glyphicon glyphicon-edit"></a>
	  {{ $proctor->name }}
	</td>
	<td>{{ number_format($proctor->density_dry, 1) }}</td>
	<td>{{ number_format( $proctor->percent_moisture, 1) }}</td>
	<td>{{ $proctor->description }}</td>
      </tr>
    @endforeach
    </table>
  @else
    <p>No maximum densities yet.</p>
  @endif

  <div class="modal fade" id="proctorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
	<div class="modal-body">
	  {{ Form::open(array('class'=>'form-new-test form-horizontal', 'role'=>'form')) }}
	  {{ Form::hidden('action', 'createproctor') }}
	  <div class="form-group">
	    <label for="name" class="col-sm-4 control-label">Name</label>
	    <div class="col-sm-8">
	      {{ Form::text('name', null, array('class'=>'input-block-level', 'placeholder'=>'Name')) }}
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="description" class="col-sm-4 control-label">Description</label>
	    <div class="col-sm-8">
	      {{ Form::text('description', null, array('class'=>'input-block-level', 'placeholder'=>'Description')) }}
	    </div>
	  </div>
<!-- 	  <div class="form-group">
	    <label for="date" class="col-sm-4 control-label">Date</label>
	    <div class="col-sm-8">
	      {{ Form::text('date', null, array('class'=>'input-block-level', 'placeholder'=>'Date')) }}
	    </div>
	  </div> -->
	  <!--	  {{ Form::text('density_wet', null, array('class'=>'input-block-level', 'placeholder'=>'Wet Density')) }} --> 
	  <div class="form-group">
	    <label for="density_dry" class="col-sm-4 control-label">Dry Density</label>
	    <div class="col-sm-8">
	      {{ Form::text('density_dry', null, array('class'=>'input-block-level', 'placeholder'=>'Dry Density')) }}
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="percent_moisture" class="col-sm-4 control-label">Percent Moisture</label>
	    <div class="col-sm-8">
	      {{ Form::text('percent_moisture', null, array('class'=>'input-block-level', 'placeholder'=>'Moisture %')) }}
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-4 col-sm-8">
	      {{ Form::submit('Add Maximum Density', array('class'=>'btn btn-large btn-primary')) }}
	      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	    </div>
	  </div>
	  {{ Form::close() }}
	</div>
      </div>
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

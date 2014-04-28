@extends('main')

@section('brandlink')
  <div class="navbar-brand">{{$project->name}}</div>
@stop

@section('underheader')
@stop

@section('navmenu')
  <li><button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-check"></span> Take Test</button></li>
@stop

@section('underbody')
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
	<div class="modal-body">	  
	  {{ Form::open(array('url'=>'/home/'.$project->id.'-'.$project->name.'/tests', 'class'=>'form-horizontal', 'role'=>'form')) }}	  
	  {{ Form::hidden('action', 'createtest') }}
	  {{ Form::hidden('notes', '') }}

	  <div class="form-group">
	    <label for="elevation" class="col-sm-4 ">Elevation</label>
	    <label for="density_wet" class="col-sm-4 col-sm-offset-2">Wet Density</label>

	    <div class="col-sm-4">
	      {{ Form::text('elevation', null, array('class'=>'form-control', 'placeholder'=>'elevation', 'id'=>'elevationInput')) }}
	    </div>
	    <div class="col-sm-4 col-sm-offset-2">
	      {{ Form::text('density_wet', null, array('class'=>'form-control', 'placeholder'=>'density_wet', 'id'=>'density_wet')) }}
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="density_dry" class="col-sm-4">Dry Density</label>
	    <label for="percent_moisture" class="col-sm-4 col-sm-offset-2">Moisture %</label>

	    <div class="col-sm-4">
	      {{ Form::text('density_dry', null, array('class'=>'form-control', 'placeholder'=>'density_dry', 'id'=>'density_dry')) }}
	    </div>
	    <div class="col-sm-4 col-sm-offset-2">
	      {{ Form::text('percent_moisture', null, array('class'=>'form-control', 'placeholder'=>'percent_moisture', 'id'=>'percent_moisture')) }}
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="proctor" class="col-sm-4">Maximum Density</label>
	    <label for="compaction_percent" class="col-sm-4 col-sm-offset-2">Compaction %</label>

	    <div class="col-sm-4">
	      <select class="form-control" name="proctor" id="proctorInput">
		@foreach($proctors as $key => $proctor)
		  <option id="{{ number_format($proctor->density_dry, 1) }}" value="{{$proctor->id}}">{{ number_format($proctor->density_dry, 1) }} @ {{ number_format($proctor->percent_moisture, 1) }}% - {{$proctor->name}}</option>
		@endforeach
	      </select>
	    </div>
	    <div class="col-sm-4 col-sm-offset-2">
	      {{ Form::text('compaction_percent', null, array('class'=>'form-control', 'placeholder'=>'compaction_percent', 'id'=>'compaction_percent', 'disabled')) }}
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="location" class="col-sm-3">Location</label>
	    <div class="col-sm-12">
	      {{ Form::textarea('location', null, array('class'=>'form-control', 'placeholder'=>'location', 'size'=>'50x1')) }}
	    </div>
	  </div>

	  <div class="form-group">
	    <div class="col-sm-offset-3 col-sm-9">
	      {{ Form::submit('Create', array('class'=>'btn btn-large btn-primary')) }}
	      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	    </div>
	  </div>
	  
	  {{ Form::close() }}
	  
	</div>
      </div>
    </div>
  </div>

  <script>

   $(document).ready( function(){
     $('#myModal').on('shown.bs.modal', function () {
       $('#elevationInput').focus();
     });

     //fires when wet, dry, or moisture have been changed.
     $("#density_wet, #density_dry, #percent_moisture").change(
       function(e){
	 //check if moisture has a val if not exit
	 if ( $("#percent_moisture").val() == ""){
	   //check if both wet and dry have a value
	   if( $("#density_dry").val() != "" && $("#density_wet").val() != "" ){
	     //calc the moisture
	     percent_moisture = ( $("#density_wet").val() /  $("#density_dry").val() - 1 ) * 100;
	     $("#percent_moisture").val(percent_moisture.toFixed(1));

	     compaction_percent = $("#density_dry").val() / $("#proctorInput").find(":selected").attr("id") * 100;
	     $("#compaction_percent").val(compaction_percent.toFixed(1));
	     return
	   }
	   else {
	     return
	   }
	 }
	 var proceed = false;
	 //check if wet or dry are calling this
	 if (e.target.id == "density_dry"){
	   proceed = true;
	   starter = "density_dry";
	 }
	 if (e.target.id == "density_wet"){
	   proceed = true;
	   starter = "density_wet";
	 }
	 if (e.target.id == "percent_moisture"){
	   if ($("#density_wet").val() != ""){
	     starter = "density_wet";
	     proceed = true;	     
	   }
	   else if ($("#density_dry").val() != ""){
	     starter = "density_dry";
	     proceed = true;
	   }
	 }
	 if (proceed){
	   //updates relative density, and one of wet or dry density (opposite of the one firing the event
	   if (starter == "density_wet"){
	     density_dry = $("#density_wet").val() / (1 + ( $("#percent_moisture").val() / 100 ));
	     $("#density_dry").val( density_dry.toFixed(1) );
	   }
	   else {
	     density_wet = $("#density_dry").val() * (1 + ( $("#percent_moisture").val() / 100 ));
	     $("#density_wet").val( density_wet.toFixed(1) );
	   }

	   compaction_percent = $("#density_dry").val() / $("#proctorInput").find(":selected").attr("id") * 100;
	   $("#compaction_percent").val(compaction_percent.toFixed(1));
	 }
       });

     $("#proctorInput").change( function(){
       compaction_percent = $("#density_dry").val() / $("#proctorInput").find(":selected").attr("id") * 100;
       $("#compaction_percent").val(compaction_percent.toFixed(1));
     });

   });
  </script>
@stop

@section('content')
  <ul class="nav nav-tabs">
    <li class=""><a href="/home/{{ $project->id}}-{{$project->name}}">Overview</a></li>
    <li class="active"><a href="/home/{{ $project->id}}-{{$project->name}}/tests">Tests</a></li>
  </ul>

  <h1>Test {{ $test->number }}</h1>

  {{ Form::open(array('url'=>URL::route('postTest', array($project->id, $project->name, $test->id )), 'class'=>'form-horizontal', 'role'=>'form')) }}	  
  {{ Form::hidden('action', 'edittest') }}

  <div class="form-group">
    <label for="elevation" class="col-sm-4 ">Elevation</label>
    <label for="density_wet" class="col-sm-4 col-sm-offset-2">Wet Density</label>

    <div class="col-sm-4">
      {{ Form::text('elevation', $test->elevation, array('class'=>'form-control', 'placeholder'=>'elevation', 'id'=>'elevationInput')) }}
    </div>
    <div class="col-sm-4 col-sm-offset-2">
      {{ Form::text('density_wet', number_format($test->density_wet,1), array('class'=>'form-control', 'placeholder'=>'density_wet', 'id'=>'density_wet')) }}
    </div>
  </div>

  <div class="form-group">
    <label for="density_dry" class="col-sm-4">Dry Density</label>
    <label for="percent_moisture" class="col-sm-4 col-sm-offset-2">Moisture %</label>

    <div class="col-sm-4">
      {{ Form::text('density_dry', number_format($test->density_dry,1), array('class'=>'form-control', 'placeholder'=>'density_dry', 'id'=>'density_dry')) }}
    </div>
    <div class="col-sm-4 col-sm-offset-2">
      {{ Form::text('percent_moisture', number_format($test->percent_moisture, 1), array('class'=>'form-control', 'placeholder'=>'percent_moisture', 'id'=>'percent_moisture')) }}
    </div>
  </div>

  <div class="form-group">
    <label for="proctor" class="col-sm-4">Maximum Density</label>
    <label for="compaction_percent" class="col-sm-4 col-sm-offset-2">Compaction %</label>

    <div class="col-sm-4">
      <select class="form-control" name="proctor" id="proctorInput">
	@foreach($proctors as $key => $proctor)
	  <option id="{{ number_format($proctor->density_dry, 1) }}" value="{{$proctor->id}}">{{ number_format($proctor->density_dry, 1) }} @ {{ number_format($proctor->percent_moisture, 1) }}% - {{$proctor->name}}</option>
	@endforeach
      </select>
    </div>
    <div class="col-sm-4 col-sm-offset-2">
      {{ Form::text('compaction_percent', number_format($test->percent_compaction(), 1), array('class'=>'form-control', 'placeholder'=>'compaction_percent', 'id'=>'compaction_percent', 'disabled')) }}
    </div>
  </div>

  <div class="form-group">
    <label for="location" class="col-sm-3">Location</label>
    <div class="col-sm-12">
      {{ Form::textarea('location', $test->location, array('class'=>'form-control', 'placeholder'=>'location', 'size'=>'50x1')) }}
    </div>
  </div>

  <div class="form-group">
    <label for="notes" class="col-sm-3">Notes</label>
    <div class="col-sm-12">
      {{ Form::textarea('notes', $test->notes, array('class'=>'form-control', 'placeholder'=>'notes', 'size'=>'50x1')) }}
    </div>
  </div>

  <div class="form-group">
    <label for="retest" class="col-sm-4">Retest of No:</label>
    <label for="date" class="col-sm-4 col-sm-offset-2">Date:</label>

    <div class="col-sm-4">
      {{ Form::text('retest', $test->retest_of_number ? $test->retest_of_number : "", array('class'=>'form-control', 'placeholder'=>'retest', 'id'=>'retest')) }}
    </div>
    <div class="col-sm-4 col-sm-offset-2">
      {{ Form::text('date', $test->created_at->format('m/d/Y H:i'), array('class'=>'form-control', 'placeholder'=>'date', 'id'=>'date')) }}
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
      {{ Form::submit('Save', array('class'=>'btn btn-large btn-primary')) }}
      <a class="btn btn-default" href="/home/{{ $project->id}}-{{$project->name}}/tests#{{ $test->id }}">Cancel</a>
    </div>
  </div>
  
  {{ Form::close() }}
@stop
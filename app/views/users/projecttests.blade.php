@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/home">{{$project->name}}</a>
@stop

@section('underheader')
  <style>
   .hiddenRow {
     padding: 0 !important;
   }
   tr.noborder td{
     border-top: none !important;
   }
   #tableHead th{
     background: #ffcfcb;
     border-bottom: 2px solid black;
   }
   tr.even td {
     background: #dddfbd;
   }
  </style>
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
	  {{ Form::hidden('notes', ' ') }}

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
	    <label for="proctor" class="col-sm-4">Proctor</label>
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
	   return
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
     })

   });
  </script>
@stop

@section('content')
  <ul class="nav nav-tabs">
    <li class=""><a href="/home/{{ $project->id}}-{{$project->name}}">Overview</a></li>
    <li class="active"><a href="/home/{{ $project->id}}-{{$project->name}}/tests">Tests</a></li>
    <!-- <li class=""><a href="/home/{{ $project->id}}-{{$project->name}}/files">Files</a></li> -->
  </ul>
  <br>
  @if (count($tests) > 0)
    <table class="table">
      <tr id="tableHead">
	<th>No.</th>
	<th>Location</th>
	<th>Dry Dens.</th>
	<th>m%</th>
	<th>Max.</th>
	<th>rel. %</th>
      </tr>
      @foreach($tests as $key => $test)
	@if ($key % 2 == 0)
	<tr data-toggle="collapse" data-target="#demo{{$key}}" class="accordion-toggle">
	@else
	<tr data-toggle="collapse" data-target="#demo{{$key}}" class="accordion-toggle even">	
	@endif
	  <td>{{ $test->number }}</td>
	  <td>{{ $test->location }}</td>
	  <td>{{ number_format($test->density_dry, 1) }}</td>
	  <td>{{ number_format($test->percent_moisture, 1) }}</td>
	  <td>{{ number_format($test->proctor->density_dry, 1) }}</td>
	  <td>{{ number_format($test->percent_compaction(), 1) }}</td>
	</tr>
	<tr class="noborder">
          <td colspan="6" class="hiddenRow">
	    <div class="accordian-body collapse" id="demo{{$key}}">
	      <p>Demo {{$key }} Other things to edit will need to go here</p>
	      <p>Notes</p>
	      <p>Test taker</p>
	      <p>Test Method</p>
	      <button class="btn btn-danger">Delete</button>
	    </div>
	  </td>
        </tr>
    @endforeach
    </table>
  @else
    <p>No tests yet.</p>
  @endif
@stop

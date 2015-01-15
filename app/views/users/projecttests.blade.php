@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/home">{{$project->name}}</a>
@stop

@section('underheader')
  <style>
   .hiddenRow {
     padding: 0 !important;
   }
   tr {

   }
   tr td:first-child{
     border-left: gray 1px solid;
   }
   tr td:last-child{
     border-right: gray 1px solid;
   }
   tr.noborder td{
     border-top: none !important;
     border-bottom: 1px solid gray;
     padding: 0px 5px 0px 5px !important;
   }
   #tableHead th{
     border-top: gray 1px solid;
     background: none;
   }
   #tableHead th:first-child{
     border-left: gray 1px solid;
   }
   #tableHead th:last-child{
     border-right: gray 1px solid;
   }
   tr.odd td {
     background: #fafafa;
   }
   tr.even td {
     background: #f7f7f7;
   }
   tr.even:hover, tr.odd:hover{
     cursor: pointer;
   }
   tr.even:hover td, tr.odd:hover td{
   }
   tr.noborder{
     background: white;
   }
   .notes {
     border: dashed 2px #cc8;
     padding: 10px;
   }
   .editable-input {
     /*width: 400px;*/
     width: 200%;
   }
   .editableform .form-control {
     /*width: 400px;*/
     width: 100%;
   }
   .testExpand{
     padding: 5px;
   }
   .testButtonDiv{
     padding: 10px;
   }
  </style>
@stop

@section('navmenu')
@stop

@section('underbody')
  @include('users.recordtestmodal')
  
  <script>
   $(document).ready( function(){

     $.fn.editable.defaults.mode = 'popup'; //popup inline

     $('.notes').each( function(){
       $(this).editable({
	 type:  'textarea',
	 mode: 'inline',
	 name:  'notes',
         emptytext: "Add notes here",
	 params: {
	   action: 'testnotes',
	 },
	 url:   '/editable',  
	 title: 'Test Notes'
       });     
     });
   });
  </script>
@stop

@section('content')
  <ul class="nav nav-tabs">
    <li class="active"><a href="/home/{{ $project->id}}-{{$project->name}}/tests">Tests</a></li>
    <li><a href="/home/{{ $project->id}}-{{$project->name}}/proctors">Proctors</a></li>    
    <li><a href="/home/{{ $project->id}}-{{$project->name}}">Other</a></l>
  </ul>

  @if( Session::get('message') )
    <br>
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{ Session::get('message') }}
    </div>
  @endif

  <br>

  @if($project->proctors->isEmpty())
    <div class="alert alert-warning alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span>Add a maximum density on the Proctors tab before taking a test</span>
    </div>
  @else
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-check"></span> Record Test</button>
  @endif

  <br><br>
  @if (count($tests) > 0)
    <table class="table table-hover table-striped">
      <tr id="tableHead">
	<th> #</th>
	<th title="Location of Test">Loc.</th>
	<th title="Dry Density">Dry Dens.</th>
	<th title="Percent Moisture">m%</th>
	<th title="Maximum Dry Density">Max.</th>
	<th title="Relative Percent Compaction">rel. %</th>
      </tr>
      @foreach($tests as $key => $test)
	@if ($key % 2 == 0)
	<tr name="test{{$test->number}}" data-toggle="collapse" data-target="#demo{{$key}}" class="accordion-toggle" title="Click or tap to see more details">
	@else
	<tr data-toggle="collapse" data-target="#demo{{$key}}" class="accordion-toggle even" title="Click or tap to see more details">
	@endif
	  <td><b id="expand{{ $test->number }}" class="glyphicon glyphicon-expand"> {{ $test->number }}</b></td>
	  <td>{{ $test->location }}</td>
	  <td class="densityDryTd">{{ number_format($test->density_dry, 1) }}</td>
	  <td>{{ number_format($test->percent_moisture, 1) }}</td>
	  <td>{{ number_format($test->proctor->density_dry, 1) }}</td>
	  <td>{{ number_format($test->percent_compaction(), 1) }}</td>
	</tr>
	<tr class="noborder">
          <td colspan="7" class="hiddenRow">
	    <div class="accordian-body collapse" id="demo{{$key}}">
	      <p class="testExpand">
		Elevation: {{ $test->elevation }} | 
		Wet Density: {{ number_format($test->density_wet, 1) }} | 
		Date: {{ $test->created_at->format('m/d/Y H:i') }}
	      </p>
	      <p>Notes:</p>

	      <div id="notes" title="Click or tap to edit" class="notes" data-pk={{ $test->id }}>{{ $test->notes }}</div>

	      <div class="testButtonDiv">
		<a class="btn btn-info pull-right editButton" href="{{ URL::route('getTest', array($project->id, $project->name, $test->id)) }}"><span class="glyphicon glyphicon-edit"></span> Edit</a>
		<div style="clear: both;"></div>
	      </div>
	    </div>
	  </td>
        </tr>
    @endforeach
    </table>
  @else
    <p>No tests yet.</p>
  @endif
@stop

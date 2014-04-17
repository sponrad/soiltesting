@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/home">{{$project->name}}</a>
@stop

@section('underheader')
  <link rel="stylesheet" href="/js/jqfu9.5.7/css/jquery.fileupload.css">
  <link rel="stylesheet" href="/js/jqfu9.5.7/css/jquery.fileupload-ui.css">
@stop

@section('navmenu')
  <li><button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-check"></span> Take Test</button></li>

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
@stop

@section('underbody')
  <script src="/js/jqfu9.5.7/js/vendor/jquery.ui.widget.js"></script>
  <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
  <script src="/js/jqfu9.5.7/js/jquery.iframe-transport.js"></script>
  <!-- The basic File Upload plugin -->
  <script src="/js/jqfu9.5.7/js/jquery.fileupload.js"></script>
  <script>
   /*jslint unparam: true */
   /*global window, $ */
   $(function () {
     'use strict';
     // Change this to the location of your server-side upload handler:
     var url = '/upload/{{ $project->id }}';
     $('#fileupload').fileupload({
       url: url,
       dataType: 'json',
       acceptFileTypes: /(\.|\/)(gif|jpe?g|png|bmp)$/i,
       done: function (e, data) {
         $.each(data.result.files, function (index, file) {
           //$('<p/>').text(file.name).appendTo('#files');
	   $("<img />").attr("src", file.name).appendTo("#files");
         });
       },
       progressall: function (e, data) {
         var progress = parseInt(data.loaded / data.total * 100, 10);
         $('#progress .progress-bar').css(
           'width',
           progress + '%'
         );
       }
     }).prop('disabled', !$.support.fileInput)
				   .parent().addClass($.support.fileInput ? undefined : 'disabled');
   });
  </script>
@stop

@section('content')
  <ul class="nav nav-tabs">
    <li class=""><a href="/home/{{ $project->id}}-{{$project->name}}">Overview</a></li>
    <li class=""><a href="/home/{{ $project->id}}-{{$project->name}}/tests">Tests</a></li>
    <!-- <li class="active"><a href="/home/{{ $project->id}}-{{$project->name}}/files">Files</a></li> -->
  </ul>

  <h3>Upload</h3>
  <input id="fileupload" type="file" name="files[]" multiple>
  <!-- The global progress bar -->
  <div id="progress" class="progress">
    <div class="progress-bar progress-bar-success"></div>
  </div>
  <!-- The container for the uploaded files -->
  <div id="files" class="files"></div> 

  <h3>Pictures</h3>
  <p>None</p>

  <h3>Other Files</h3>
  <p>None</p>
  
@stop

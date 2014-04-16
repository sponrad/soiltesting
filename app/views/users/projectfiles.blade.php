@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/home">{{$project->name}}</a>
@stop

@section('underheader')
  <link rel="stylesheet" href="/js/jqfu9.5.7/css/jquery.fileupload.css">
  <link rel="stylesheet" href="/js/jqfu9.5.7/css/jquery.fileupload-ui.css">@stop

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

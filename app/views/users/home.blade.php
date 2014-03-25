@extends('main')

@section('underheader')
  <link rel="stylesheet" href="js/jqfu9.5.7/css/jquery.fileupload.css">
  <link rel="stylesheet" href="js/jqfu9.5.7/css/jquery.fileupload-ui.css">
@stop

@section('underbody')

@stop

@section('content')
  <input type="text" placeholder="Search" style="float: right;" />
  <h3 style="margin-top:0px;">{{ Auth::user()->account->companyname }}</h3>  

  <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="float: right;">New Project</button>

  <a href="/home">Home</a><br>
  
  <p>List projects here</p>
  
@stop

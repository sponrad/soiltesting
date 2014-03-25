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

  <h3>{{ $project->name }}  </h3>

  <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="float: right;">New Test</button>

  <a href="/home">Home</a><br>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
	<div class="modal-header">
	  <h2>New Test</h2>
	</div>
	<div class="modal-body">
	  {{ Form::open(array('url'=>'/home', 'class'=>'form-new-test')) }}
	  {{ Form::hidden('action', 'createtest') }}
	  {{ Form::text('testname', null, array('class'=>'input-block-level', 'placeholder'=>'Test Name')) }}
	  <br>
	  {{ Form::submit('Create', array('class'=>'btn btn-large btn-primary')) }}
	  {{ Form::close() }}
	</div>
      </div>
    </div>
  </div>
  
  @if (count($tests) > 0)
    @foreach($tests as $key => $test)
      <br>
      <a href="/home/{{ $test->id }}-{{ $test->name }}">{{ $test->number }}</a>
    @endforeach
  @endif
@stop

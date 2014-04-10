@extends('main')

@section('underheader')
@stop

@section('underbody')

@stop

@section('content')
  <h2>{{ $project->name }}</h2>

  <ul class="nav nav-tabs">
    <li class=""><a href="/home/{{ $project->id}}-{{$project->name}}">Overview</a></li>
    <li class="active"><a href="/home/{{ $project->id}}-{{$project->name}}/tests">Tests</a></li>
    <li class=""><a href="/home/{{ $project->id}}-{{$project->name}}/files">Files</a></li>
  </ul>
  
  <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">New Test</button>

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
    <p>Link to view all tests</p>
  @else
    <p>No tests added yet.</p>
  @endif
  
  @if (count($tests) > 0)
    @foreach($tests as $key => $test)
      <br>
      <a href="/home/{{ $test->id }}-{{ $test->name }}">{{ $test->number }}</a>
    @endforeach
  @endif
@stop

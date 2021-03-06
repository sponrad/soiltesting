@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/">DensityPro</a>
@stop

@section('content') 
  <div class="row">
    @if( Session::get('message') )
      <div class="alert alert-warning alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{ Session::get('message') }}
      </div>
    @endif
    <div class="col-md-6 col-md-offset-2">
      {{ Form::open(array('url'=>'/login', 'class'=>'form-signin', 'role'=>'form')) }}
      <h2 class="form-signin-heading">Please Sign In</h2>
      
      <div class="form-group">
	<label for="email">Email Address</label>
	{{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}
      </div>
      <div class="form-group">
	<label for="password">Password</label>
	{{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
      </div>
      
      {{ Form::submit('Sign In', array('class'=>'btn btn-large btn-primary btn-block'))}}
      {{ Form::close() }}
    </div>
  </div>
@stop

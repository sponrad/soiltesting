@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/">DensityPro</a>  
@stop

@section('content')
  <div class="row">
    <div class="col-md-6 col-md-offset-2">
      {{ Form::open(array('url'=>'/register', 'class'=>'form-signup', 'role'=>'form')) }}
      <h2 class="form-signup-heading">Please Register</h2>

      <ul>
	@foreach($errors->all() as $error)
	  <li>{{ $error }}</li>
	@endforeach
      </ul>

      <div class="form-group">
	<label for="companyname">Company Name</label>
	{{ Form::text('companyname', null, array('class'=>'input-block-level', 'placeholder'=>'Company Name')) }}
      </div>
      <div class="form-group">
	<label for="email">Email Address</label>
	{{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Your Email Address')) }}
      </div>
      <div class="form-group">
	<label for="password">Password</label>
	{{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
      </div>
      <div class="form-group">
	<label for="password_confirmation">Confirm Password</label>
	{{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) }}
      </div>

      {{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
      {{ Form::close() }}
    </div>
  </div>
@stop

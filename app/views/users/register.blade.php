@extends('main')

@section('content')
  {{ Form::open(array('url'=>'/register', 'class'=>'form-signup')) }}
  <h2 class="form-signup-heading">Please Register</h2>

  <ul>
    @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>

  {{ Form::text('companyname', null, array('class'=>'input-block-level', 'placeholder'=>'Company Name')) }}
  {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Your Email Address')) }}
  {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
  {{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) }}

  {{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
  {{ Form::close() }}
@stop

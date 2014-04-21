@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/home">{{ Auth::user()->account->companyname }}</a>  
@stop

@section('content')
  <h2>Settings</h2>

  <h4>{{ Auth::user()->email }}</h4>

  {{ Form::open(array('url'=>'/settings', 'class'=>'form-signup', 'role'=>'form')) }}
    <div class="form-group">
      <label for="password">Change Password</label>
      <input type="password" name="password" class="form-control">
      <input type="password" name="password_confirmation" class="form-control">
    </div>
    
    <div class="form-group">
      <p>Billing</p>
    </div>
    {{ Form::submit('Save', array('class'=>'btn btn-large btn-primary btn-block'))}}
    {{ Form::close() }}
@stop

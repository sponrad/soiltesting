@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/home">{{ Auth::user()->account->companyname }}</a>  
@stop

@section('underbody')
  <style>
   
  </style>
@stop

@section('content')
  @if( Session::has('message'))
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{ Session::get('message') }}
    </div>
  @endif

  <h2>Settings</h2>

  <h4>{{ Auth::user()->email }}</h4>

  {{ Form::open(array('url'=>'/settings', 'class'=>'form-signup', 'role'=>'form')) }}
    <div class="form-group">
      <p>Change Password</p>
      <input type="password" name="password" class="form-control" placeholder="Password"> 
      <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
    </div>
    
    <div class="form-group">
      <p>Billing</p>
    </div>
    {{ Form::submit('Save', array('class'=>'btn btn-large btn-primary btn-block'))}}
    {{ Form::close() }}
@stop

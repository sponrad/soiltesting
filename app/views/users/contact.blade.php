@extends('main')

@section('brandlink')
  <a class="navbar-brand" href="/">DensityPro</a>
@stop

@section('underbody') 
  <script>
   $(document).ready(function(){
     $("#email_address").hide();
   });
  </script>
@stop

@section('content') 
  <div class="row">
    @if( Session::get('message') )
      <div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{ Session::get('message') }}
      </div>
    @endif
    <div class="col-md-6 col-md-offset-2">
      {{ Form::open(array('url'=>'/contact', 'class'=>'form-signin', 'role'=>'form')) }}
      <h2 class="form-signin-heading">Contact Form</h2>
      
      <div class="form-group">
	<label for="email">Your Email Address</label>
        @if(Auth::check())
	{{ Form::text('email', Auth::user()->email, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}
	@else
	{{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}
	@endif
      </div>

      <input type="text" name="email_address" id="email_address" title=""/>

      <div class="form-group">
	<label for="mess">Message</label>
	{{ Form::textarea('mess', null, array('class'=>'input-block-level', 'placeholder'=>'Message')) }}
      </div>
      
      {{ Form::submit('Contact', array('class'=>'btn btn-large btn-primary btn-block'))}}
      {{ Form::close() }}
    </div>
  </div>
@stop

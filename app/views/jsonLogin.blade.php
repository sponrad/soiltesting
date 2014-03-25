@extends('main')

@section('content') 
  <form action="/json/login" method="post" id="loginForm" class="form-signin">
  <h2 class="form-signin-heading">Please Login</h2>
  
  {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}
  {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
  
  {{ Form::submit('Login', array('id'=>'submit', 'class'=>'btn btn-large btn-primary btn-block'))}}
  </form>
@stop


@section('underbody')
  <script>
    $(document).ready(function(){
     $("#submit").click( function(e){
       e.preventDefault();
       dataToSend = $("#loginForm").serialize();
       console.log( dataToSend);
       $.ajax({
	 url: "/json/login",
	 dataType: "json",
	 data: dataToSend,
	 type: "POST",
	 success: function(data){
	   console.log(data);
	 }
       });
     });
   });
  </script>
@stop

@extends('app')

@section('content')
	<div style="text-align:center;">
	@if($action==='signup')
		{{Form::open(["url"=>"/home/do_signup", "method"=>"post"])}}
	@elseif($action==='login')
		{{Form::open(["url"=>"/home/do_login", "method"=>"post"])}}
	@endif
			<!-- label("label_for", "label_value",array('class' => 'class','style' => 'style'))}}  -->
			<!-- text("text_id/name", "text_value",array('class' => 'class','style' => 'style'))}}  -->
		    {{Form::label("帳號", "帳號",array('class' => '','style' => ''))}}<br>
		    {{Form::text("name", "",array('class' => '','style' => ''))}}<br>
		    {!! $errors->first('name', '<p>:message</p>') !!}
		    {{Form::label("密碼", "密碼",array('class' => '','style' => ''))}}<br>
		    {{Form::password("password", "",array('class' => '','style' => ''))}}<br>
     	 	{!! $errors->first('password', '<p>:message</p>') !!}
			@if($action==='signup')
				{{Form::submit("註冊會員")}}
			@elseif($action==='login')
				{{Form::submit("登入")}}
			@endif
	    {{Form::close()}}
	</div>
@stop

@section('script')

@stop
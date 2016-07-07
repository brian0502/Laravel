@extends('app')

@section('content')
	<div style="text-align:center;">
		{{Form::open(["url"=>"/home/do_add_note", "method"=>"post"])}}
			<!-- label("label_for", "label_value",array('class' => 'class','style' => 'style'))}}  -->
			<!-- text("text_id/name", "text_value",array('class' => 'class','style' => 'style'))}}  -->
		    {{Form::label("標題", "標題",array('class' => '','style' => ''))}}<br>
		    {{Form::text("title", "",array('class' => '','style' => ''))}}<br>
		    {!! $errors->first('title', '<p>:message</p>') !!}
		    {{Form::label("內容", "內容",array('class' => '','style' => ''))}}<br>
		    {{Form::textarea("content", "",array('class' => '','style' => ''))}}<br>
		    {!! $errors->first('content', '<p>:message</p>') !!}
			{{Form::submit("新增筆記")}}
	    {{Form::close()}}
	</div>
@stop

@section('script')

@stop
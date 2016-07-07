@extends('app')

@section('content')
	<div style="text-align:center;">
		{{Form::open(["url"=>"/home/do_add_note", "method"=>"post"])}}
			<!-- label("label_for", "label_value",array('class' => 'class','style' => 'style'))}}  -->
			<!-- text("text_id/name", "text_value",array('class' => 'class','style' => 'style'))}}  -->
		    {{Form::label("標題", "標題",array('class' => '','style' => ''))}}<br>
		    {{Form::text("title", "",array('class' => '','style' => ''))}}<br>
		    {{Form::label("內容", "內容",array('class' => '','style' => ''))}}<br>
		    {{Form::textarea("content", "",array('class' => '','style' => ''))}}<br>
				{{Form::submit("新增筆記")}}
	    {{Form::close()}}
	</div>
	@if (count($errors) > 0)
	    <div class="alert alert-danger" style="text-align:center;">
	        <ul>
	            @foreach ($errors->all() as $error)
	        <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
@stop

@section('script')

@stop
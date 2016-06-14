@extends('app')

@section('content')
	<div style="text-align:center;">
		<p>{{ !empty($content)? $content:'Default Content' }}</p>
	</div>
@stop
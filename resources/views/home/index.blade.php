@extends('app')

@section('content')
	@if (count($data) > 0)
		@foreach($data as $key => $val)
			<a href="../home/note_info/{{ $val['note_id'] }}" class="a1">
				<div>
					<h1>{{ $val['title'] }}</h1>
			        <div id="github-icons"></div>
			       	{!! $val['content'] !!}
				</div>
			</a>
			</br>
		@endforeach
	@endif
@stop
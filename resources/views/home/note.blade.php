@extends('app')

@section('content')
	@if (count($data) > 0)
		@foreach($data as $key => $val)
			@if ($request_url != 'note_info')
				<a href="/home/note_info/{{ $val['note_id'] }}" class="a1">
			@endif
					<div>
						<h1>{{ $val['title'] }}</h1>
				        <div id="github-icons"></div>
				       	{!! $val['content'] !!}
					</div>
			@if ($request_url != 'note_info')
				</a>
			@endif
		@endforeach
	@endif
@stop
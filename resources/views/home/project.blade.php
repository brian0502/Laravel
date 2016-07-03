@extends('app')

@section('content')
		@if (count($data) > 0)
		<div id="theGrid" class="main">
			<section class="grid">
				@foreach($data as $key => $val)
					<a class="grid__item" href="{{ $val['project_url'] }}" target="_blank">
						<?php echo empty($val['project_img'])? '':'<img src="/project_img/'.$val['project_img'].'" style="width: 100%;">';?>
						<!-- <h2 class="title title--preview">{{ $val['project_name'] }}</h2> -->
						<div class="loader"></div>
						<span class="category">{{ $val['project_name'] }}</span>
						<!-- <div class="meta meta--preview">
							<img class="meta__avatar" src="<?php echo '/project_img/'.$val['project_img'];?>" alt="author01" />
						</div> -->
					</a>
				@endforeach
			</section>
		</div>
		@endif
@stop
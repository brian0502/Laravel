@extends('app')

@section('content')
		@if (count($data) > 0)
		<div id="theGrid" class="main">
			<section class="grid">
				@foreach($data as $key => $val)
					<a class="grid__item" href="{{ $val['url'] }}" target="_blank">
						<?php echo empty($val['img'])? '':'<img src="/project_img/'.$val['img'].'" style="width: 100%;">';?>
						<!-- <h2 class="title title--preview">{{ $val['name'] }}</h2> -->
						<div class="loader"></div>
						<span class="category">{{ $val['name'] }}</span>
						<!-- <div class="meta meta--preview">
							<img class="meta__avatar" src="<?php echo '/project_img/'.$val['img'];?>" alt="author01" />
						</div> -->
					</a>
				@endforeach
			</section>
		</div>
		@endif
@stop
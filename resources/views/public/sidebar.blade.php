<button id="mm-menu-toggle" class="mm-menu-toggle">Brian Menu</button>
<nav id="mm-menu" class="mm-menu">
	<div class="mm-menu__header">
		<h2 class="mm-menu__title">Brian Menu</h2>
	</div>
	<ul class="mm-menu__items">
		@foreach($sidebar as $key => $val)
			<li class="mm-menu__item">
				<a class="mm-menu__link" href="{{ $val['url'] }}">
				<span class="mm-menu__link-text"><i class="md md-home"></i> {{ $val['name'] }}</span>
				</a>
			</li>
		@endforeach
	</ul>
</nav><!-- /nav -->
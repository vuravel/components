<div class="vl-nav-html {{ $component->class() }}"
	@include('vuravel::partials.IdStyle')>

	@include('vuravel::partials.ItemContent', [
		'component' => $component
	])
	
</div>
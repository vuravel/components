<div class="vl-nav-html {{ $component->class() }}"
	@include('vuravel::partials.IdStyle')>

	@include('vuravel::menus.components', [ 'components' => $component->components ])
	
</div>
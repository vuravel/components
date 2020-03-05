@foreach($components as $component)
	@include('vuravel::navitems.'.$component->menuComponent, [
		'component' => $component
	])
@endforeach
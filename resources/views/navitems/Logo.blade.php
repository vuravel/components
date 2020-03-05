<a class="vl-logo vl-nav-item {{ $component->class() }}" 
	href="{{ $component->href }}"
	@include('vuravel::partials.IdStyle')>

	@if($component->imageUrl)
		<img src="{{ $component->imageUrl }}" 
			style="width:{{ $component->imageWidth }};height:{{ $component->imageHeight }}" 
			class="vlInlineBlock {{$component->data('imageClass')}}" alt="">
	@endif

	@include('vuravel::partials.ItemContent', [
		'component' => $component
		])

</a>
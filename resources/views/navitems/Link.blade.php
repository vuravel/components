@if($component->hasTriggers())

	<vl-link class="vl-nav-item {{ $component->class() }} {{ $component->data('active') }}"
		@include('vuravel::partials.IdStyle')
		:vcomponent="{{ $component }}" >

		@include('vuravel::partials.ItemContent', [
			'component' => $component
		])
			
	</vl-link>

@else

	<a class="vl-nav-item {{ $component->class() }} {{ $component->data('active') }}" 
		@include('vuravel::partials.IdStyle')
		@include('vuravel::partials.HrefTarget')>

		@include('vuravel::partials.ItemContent', [
			'component' => $component
		])
			
	</a>

@endif
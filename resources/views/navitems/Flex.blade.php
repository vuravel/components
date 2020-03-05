<div class="vlFlex {{ $component->data('justifyClass') }} {{ $component->data('alignClass') }} 
	{{ $component->class() }}"
	@include('vuravel::partials.IdStyle')>

    @include('vuravel::menus.components', [ 'components' => $component->components ])

</div>
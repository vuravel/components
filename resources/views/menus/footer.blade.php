@if($Footer)
<footer class="vl-footer {{ $Footer->class() }}" 
	@include('vuravel::partials.IdStyle', [ 'component' => $Footer ])>

    @include('vuravel::menus.components', [ 
    	'vuravelid' => $Footer->id,
    	'components' => $Footer->components 
    ])

</footer>
@endif
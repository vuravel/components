@if($Sidebar)

<div class="vlHidden vlFlexLg" id="{{ $Sidebar->data('menuType') }}-container">

	<aside @include('vuravel::partials.IdStyle', ['component' => $Sidebar ])
		class="{{ $Sidebar->data('menuType') }} {{ $Sidebar->class }}">

	    @include('vuravel::menus.components', [ 
	    	'vuravelid' => $Sidebar->id,
	    	'components' => $Sidebar->components 
	    ])

	</aside>

</div>

<vl-panel class="vlHidden vlFlexLg" id="{{ $Sidebar->data('menuType') }}-panel"></vl-panel>

@endif
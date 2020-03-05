<div class="vl-navbar-toggler vl-nav-item"
    onclick="toggleMenu(this, true)"
 	aria-label="Open menu"
 	aria-expanded="false">
 	{!! $component->label ? : '&#9776;' !!}
 </div>
 	
<div class="vl-collapse-on-mobile-menu vl-menu-closed {{ $component->class() }}" 
	@include('vuravel::partials.IdStyle')>
	
	<div class="vl-nav-left">
		@if(count($component->leftMenu))
			@include('vuravel::menus.components', [ 'components' => $component->leftMenu ])
		@endif
	</div>
	<div class="vl-nav-right">
		@if(count($component->rightMenu))
			@include('vuravel::menus.components', [ 'components' => $component->rightMenu ])
		@endif
	</div>

	@if(isset($HasAnySidebar) && $HasAnySidebar)
	<div class="vlBlock vlHiddenLg">
		@if($LeftSidebar)
			<div id="{{ $LeftSidebar->data('menuType') }}-mobile"></div>
		@endif
		@if($RightSidebar)
			<div id="{{ $RightSidebar->data('menuType') }}-mobile"></div>
		@endif
	</div>
	@endif
    
</div>
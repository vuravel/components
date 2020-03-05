<?php 
    $vlCollapseOpen = $component->data('expandByDefault') || 
        ($component->data('expandIfActive') && $component->data('active') ); 
?>
<div 
    @include('vuravel::partials.IdStyle') 
    class="vl-collapse vl-nav-item {{ $component->class() }} {{ $component->data('active') }}">
    
    <div class="vl-collapse-toggler {{ $vlCollapseOpen ? '' : 'vl-toggler-closed' }}" 
        onclick="toggleMenu(this)">

        <a @include('vuravel::partials.HrefTarget') >

            @include('vuravel::partials.ItemContent', ['component' => $component])
        
        </a>
        <div>
            <i class="icon-down"></i>
        </div>
    </div>
    
    <div class="vl-collapse-menu {{ $vlCollapseOpen ? '' : 'vl-menu-closed' }}">
        
        @include('vuravel::menus.components', [ 'components' => $component->submenu ])
    
    </div>

</div>
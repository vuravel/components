<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<?php 

$Navbar = isset($Navbar) ? $Navbar : false;
$Footer = isset($Footer) ? $Footer : false;
$LeftSidebar = isset($LeftSidebar) ? 
    $LeftSidebar->data(['menuType' => 'vl-sidebar-l']) : false;
$RightSidebar = isset($RightSidebar) ? 
    $RightSidebar->data(['menuType' => 'vl-sidebar-r']) : false;

$HasAnySidebar = $LeftSidebar || $RightSidebar;
$VlHasAnyTopSidebar = optional($LeftSidebar)->isTop() || optional($RightSidebar)->isTop();
$VlFooterOutside = optional($Footer)->isOut();


$centered = ($HasAnySidebar || $Navbar) ? '' : (($neverCenter ?? false) ? '' : 'justify-center items-center');

?>

<head>
    @include('vuravel::header')
</head>

<body>
    <div id="vl-mobile-indicator" class="vlBlock vlHiddenLg"></div>

    <div id="app">

        @includeWhen(!$VlHasAnyTopSidebar, 'vuravel::menus.nav')

        <vl-alerts></vl-alerts>

        <div class="vlFlex vlWFull">

            @include('vuravel::menus.sidebar', ['Sidebar' => $LeftSidebar])

            <div id="vl-wrapper" class="vlWFull">
                
                @includeWhen($VlHasAnyTopSidebar, 'vuravel::menus.nav')

                <main id="vl-main" class="vlFlexCol {{ $centered }}">
                    
                    <vl-panel id="vl-main-panel"></vl-panel>

                    <div id="vl-content">
                        @yield('content')
                    </div>

                </main>

                @includeWhen(!$VlFooterOutside, 'vuravel::menus.footer')

            </div>

            @include('vuravel::menus.sidebar', ['Sidebar' => $RightSidebar])

        </div>

        @includeWhen($VlFooterOutside,'vuravel::menus.footer')

        <vl-modal name="vlDefaultModal"></vl-modal>

    </div>

    @include('vuravel::scripts')

</body>
</html>

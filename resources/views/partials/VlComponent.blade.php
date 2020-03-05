<?php 
	$vueComponent = 'vl-'.str_replace('_', '-', \Illuminate\Support\Str::snake($component->component));
?>

<{{$vueComponent}} :vcomponent="{{$component}}"	vuravelid="{{$vuravelid}}"></{{$vueComponent}}>
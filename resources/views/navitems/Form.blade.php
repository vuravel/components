<div class="vl-nav-form vl-nav-item {{ $component->class() }} {{ $component->data('active') }}"
	@include('vuravel::partials.IdStyle')>
	<vl-form :vcomponent="{{ $component }}" />
</div>
<!-- Scripts -->
@if(isset($VlScripts))
	
	@foreach( (is_array($VlScripts) ? $VlScripts : [$VlScripts]) as $k => $script)
		<script id="vl-js-{{ $k + 1 }}" src="{{ $script }}"></script>
	@endforeach

@else
	
	@if(file_exists(public_path('js/manifest.js')))
	
		<script src="{{ mix('js/manifest.js') }}"></script>
		
		@if(file_exists(public_path('js/vendor.js')))
			<script src="{{ mix('js/vendor.js') }}"></script>
		@endif

		@if(file_exists(public_path('js/app.js')))
			<script src="{{ mix('js/app.js') }}"></script>
		@endif

	@else

		@includeIf('vuravel.scripts')

	@endif

@endif



@include('vuravel::layout-scripts')
@include('vuravel::keep-session-active-script')

@stack('scripts')
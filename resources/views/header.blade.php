<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- IE compatibility - prefer edge -->
<meta http-equiv="x-ua-compatible" content="IE=edge">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Styles -->
@if(isset($VlStyles))
	
	@foreach( (is_array($VlStyles) ? $VlStyles : [$VlStyles]) as $k => $style)
		<link id="vl-css-{{ $k + 1 }}" href="{{ $style }}" rel="stylesheet">
	@endforeach

@else
	
	@if(file_exists(public_path('css/app.css')) && file_exists(public_path('js/manifest.js')))
		
		<link id="vl-css-1" href="{{ mix('css/app.css') }}" rel="stylesheet">

	@else

		@includeIf('vuravel.styles')

	@endif

@endif

<!-- Header -->
@stack('header')

@hasSection('metaTags')
	@yield('metaTags')
@else
	<title>{{ config('app.name', 'Laravel') }}</title>
@endif

@include('vuravel::favicon')

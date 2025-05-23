<!DOCTYPE html>
<html lang="{{ LANGUAGE_PREF }}" dir="{{ DIRECTION }}">
	<head>
		<meta charset="utf-8" />
		<title>{{config('modules.site_configs.app_name_'.LANGUAGE_PREF)}} | @yield('title')</title>
		<meta name="description" content="#" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		@yield('extra-metas')
		@include('frontend.Layouts.head')
	</head>
	<!--end::Head-->
	
	<body class="header-one">
		
		<!-- Preloader Start -->
	    <div class="preloader">
	        <div class="utf-preloader">
	            <span></span>
	            <span></span>
	            <span></span>
	        </div>
	    </div>
	    <!-- Preloader End -->

	    <!-- Wrapper -->
   	 	<div id="main_wrapper">
			@include('frontend.Layouts.header')
			<div class="clearfix"></div>
			@yield('content')
		</div>

		@include('frontend.Layouts.footer')
		@include('frontend.Layouts.scripts')
        @include('frontend.Partials.notf_messages')
	</body>
	<!--end::Body-->
</html>
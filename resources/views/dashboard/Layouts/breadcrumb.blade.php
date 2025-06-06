<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<h5 class="text-dark font-weight-bold my-1 mr-5">@yield('pageName')</h5>
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					@foreach($breadcrumbs as $one)
					<li class="breadcrumb-item">
						<a href="{{$one['url']}}" class="text-muted">{{$one['title']}}</a>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
<!--end::Subheader-->
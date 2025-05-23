<link rel="shortcut icon" href="{{asset(config('modules.site_configs.app_favicon'))}}">
<link rel="stylesheet" href="{{asset('assets/frontend/css/mmenu.css')}}">
@if(DIRECTION == 'rtl')
<link rel="stylesheet" href="{{asset('assets/frontend/css/style-ar.css')}}">
@else
<link rel="stylesheet" href="{{asset('assets/frontend/css/style-en.css')}}">
@endif
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&amp;display=swap&amp;subset=latin-ext,vietnamese" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700,800" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/dashboard/css/toastr.min.css') }}" rel="stylesheet" type="text/css">

<!-- third party css -->
<style>
    @media (max-width: 400px) {
        .mm-menu.mm-offcanvas{
            z-index: 9999;
            @if(locale() == 'ar')
            right: unset !important;
            @endif
        }

    }
</style>
@stack('css')
<!-- third party css end -->
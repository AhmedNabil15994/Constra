@php
    $currentTime = (int) date('H');
    $text = '';
    if($currentTime >= 6 && $currentTime <= 11){
        $text = trans('Dashboard::dashboard.morning');
    }else if($currentTime >= 12 && $currentTime <= 17){
        $text = trans('Dashboard::dashboard.afternoon');
    }else if($currentTime >= 18 || $currentTime <= 5){
        $text = trans('Dashboard::dashboard.evening');
    }
@endphp
<!--begin::Header-->
<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Topbar-->
        <div class="topbar">
            <!--begin::User-->
            <div class="topbar-item w-100">
                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                    <span class="text-muted font-weight-bold font-size-base d-inline mr-1">{{$text}} </span>
                    <span class="text-dark-50 font-weight-bolder font-size-base d-inline mr-3"> {{ ucwords(NAME) }}</span>
                </div>
            </div>

            <div class="topbar-item d-xs-inline-block d-sm-inline-block d-lg-none">
                <!--begin::Languages-->
                <div class="dropdown">
                    <!--begin::Toggle-->
{{--                    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">--}}
{{--                        @php--}}
{{--                            $text = '107-kwait.svg';--}}
{{--                            $disableOtherLang = 'ar';--}}
{{--                            if(\Session::has('locale') && \Session::get('locale') == 'en'){--}}
{{--                                $text = '226-united-states.svg';--}}
{{--                                $disableOtherLang = 'en';--}}
{{--                            }--}}
{{--                        @endphp--}}
{{--                        <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">--}}
{{--                            <img class="h-20px w-20px rounded-sm" src="{{asset('assets/dashboard/media/svg/flags/'. $text)}}" alt="" />--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!--end::Toggle-->--}}
{{--                    <!--begin::Dropdown-->--}}
{{--                    <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">--}}
{{--                        <!--begin::Nav-->--}}
{{--                        <ul class="navi navi-hover py-4">--}}
{{--                            @if($disableOtherLang != 'en')--}}
{{--                            <!--begin::Item-->--}}
{{--                            <li class="navi-item">--}}
{{--                                <a href="{{URL::to('/dashboard/changeLang?lang=en')}}" class="navi-link">--}}
{{--                                    <span class="symbol symbol-20 mr-3">--}}
{{--                                        <img src="{{asset('assets/dashboard/media/svg/flags/226-united-states.svg')}}" alt="" />--}}
{{--                                    </span>--}}
{{--                                    <span class="navi-text">{{trans('Dashboard::dashboard.english')}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <!--end::Item-->--}}
{{--                            @endif--}}
{{--                            @if($disableOtherLang != 'ar')--}}
{{--                            <!--begin::Item-->--}}
{{--                            <li class="navi-item active">--}}
{{--                                <a href="{{URL::to('/dashboard/changeLang?lang=ar')}}" class="navi-link">--}}
{{--                                    <span class="symbol symbol-20 mr-3">--}}
{{--                                        <img src="{{asset('assets/dashboard/media/svg/flags/107-kwait.svg')}}" alt="" />--}}
{{--                                    </span>--}}
{{--                                    <span class="navi-text">{{trans('Dashboard::dashboard.arabic')}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <!--end::Item-->--}}
{{--                            @endif--}}
{{--                        </ul>--}}
{{--                        <!--end::Nav-->--}}
{{--                    </div>--}}
                    <!--end::Dropdown-->
                </div>
                <!--end::Languages-->
            </div>
            <!--end::User-->
        </div>
        <!--end::Topbar-->
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default mt-3">
                <!--begin::Languages-->
                <div class="dropdown">
                    <!--begin::Toggle-->
{{--                    <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">--}}
{{--                        @php--}}
{{--                            $text = '107-kwait.svg';--}}
{{--                            $disableOtherLang = 'ar';--}}
{{--                            if(\Session::has('locale') && \Session::get('locale') == 'en'){--}}
{{--                                $text = '226-united-states.svg';--}}
{{--                                $disableOtherLang = 'en';--}}
{{--                            }--}}
{{--                        @endphp--}}
{{--                        <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">--}}
{{--                            <img class="h-20px w-20px rounded-sm" src="{{asset('assets/dashboard/media/svg/flags/'. $text)}}" alt="" />--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <!--end::Toggle-->--}}
{{--                    <!--begin::Dropdown-->--}}
{{--                    <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">--}}
{{--                        <!--begin::Nav-->--}}
{{--                        <ul class="navi navi-hover py-4">--}}
{{--                            @if($disableOtherLang != 'en')--}}
{{--                            <!--begin::Item-->--}}
{{--                            <li class="navi-item">--}}
{{--                                <a href="{{URL::to('/dashboard/changeLang?lang=en')}}" class="navi-link">--}}
{{--                                    <span class="symbol symbol-20 mr-3">--}}
{{--                                        <img src="{{asset('assets/dashboard/media/svg/flags/226-united-states.svg')}}" alt="" />--}}
{{--                                    </span>--}}
{{--                                    <span class="navi-text">{{trans('Dashboard::dashboard.english')}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <!--end::Item-->--}}
{{--                            @endif--}}
{{--                            @if($disableOtherLang != 'ar')--}}
{{--                            <!--begin::Item-->--}}
{{--                            <li class="navi-item active">--}}
{{--                                <a href="{{URL::to('/dashboard/changeLang?lang=ar')}}" class="navi-link">--}}
{{--                                    <span class="symbol symbol-20 mr-3">--}}
{{--                                        <img src="{{asset('assets/dashboard/media/svg/flags/107-kwait.svg')}}" alt="" />--}}
{{--                                    </span>--}}
{{--                                    <span class="navi-text">{{trans('Dashboard::dashboard.arabic')}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <!--end::Item-->--}}
{{--                            @endif--}}
{{--                        </ul>--}}
{{--                        <!--end::Nav-->--}}
{{--                    </div>--}}
                    <!--end::Dropdown-->
                </div>
                <!--end::Languages-->
            </div>
            <!--end::Header Menu-->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Header-->
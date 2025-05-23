<header id="header_part" class="fullwidth">
    <div id="header">
        <div class="container">
            <div class="utf_left_side">
                <div id="logo">
                    <a href="{{URL::to('/')}}">
                        <img src="{{asset(config('modules.site_configs.app_logo'))}}" alt="">
                    </a>
                </div>
                <div class="mmenu-trigger">
                    <button class="hamburger utfbutton_collapse" type="button">
                        <span class="utf_inner_button_box">
                            <span class="utf_inner_section"></span>
                        </span>
                    </button>
                </div>
                <nav id="navigation" class="style_one">
                    <ul id="responsive">
                        @foreach($menus as $one)
                            <li>
                                <a href="{{$one->prefix == '/' ? URL::to('/') : URL::to('/'.$one->prefix)}}">
                                    {{ $one->{'name_'.LANGUAGE_PREF} }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
                <div class="clearfix"></div>
            </div>
            <div class="utf_right_side">
                <div class="header_widget">
{{--                    @php--}}
{{--                        $next = 'en';--}}
{{--                        if(\Session::has('locale') && \Session::get('locale') == 'en'){--}}
{{--                            $next = 'ar';--}}
{{--                        }--}}
{{--                    @endphp--}}
{{--                    <a href="{{URL::to('/dashboard/changeLang?lang='.$next)}}" class="button "><i class="fa fa-language"></i> {{trans('Frontend::home.locale_'.$next)}}</a>--}}
                    <a href="{{URL::to('/ebook')}}" class="button border sign-in"><i class="fa fa-book"></i> {{trans('Frontend::home.begin_structure')}}</a>
                </div>
            </div>
        </div>
    </div>
    </header>
<!-- Footer -->
<div id="footer" class="footer_sticky_part ">
    <div class="container">
        <div class="row list-depart">
            <div class="col col-sm-4 col-xs-12">
                <img src="{{asset(config('modules.site_configs.app_logo'))}}" alt="">
                <p>{{  config('modules.site_configs.app_desc_'.LANGUAGE_PREF) }}</p>
            </div>
            <div class="col col-sm-3 col-xs-6">
                <h4>{{trans('Frontend::home.main_links')}}</h4>
                <ul class="social_footer_link">
                    @foreach($menus as $one)
                        @if(in_array($one->id, [1,2,6]))
                        <li><a href="{{$one->prefix == '/' ? URL::to('/') : URL::to('/'.$one->prefix)}}">{{ $one->{'name_'.LANGUAGE_PREF} }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="col col-sm-3 col-xs-6">
                <h4>{{trans('Frontend::home.main_categories')}}</h4>
                <ul class="social_footer_link">
                    @foreach($menus as $one)
                        @if(!in_array($one->id, [1,2,6]))
                        <li><a href="{{$one->prefix == '/' ? URL::to('/') : URL::to('/'.$one->prefix)}}">{{ $one->{'name_'.LANGUAGE_PREF} }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="footer_copyright_part"> © {{date('Y')}} 
                    {{trans('Frontend::home.rights_p1')}} 
                    <a href="https://www.tocaan.com/">{{trans('Frontend::home.rights_p2')}} </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="bottom_backto_top">
    <a href="#"></a>
</div>

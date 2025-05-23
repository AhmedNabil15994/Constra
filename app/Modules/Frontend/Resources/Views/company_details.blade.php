@extends('frontend.Layouts.master')
@section('title','نساعدك في البناء')
@section('content')
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $company->{'name_'.LANGUAGE_PREF} }}</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{URL::to('/')}}">{{ $pages[0]->{'name_'.LANGUAGE_PREF} }}</a></li>
                        <li><a href="{{URL::to('/'.$pages[1]->prefix)}}">{{ $pages[1]->{'name_'.LANGUAGE_PREF} }}</a></li>
                        <li>{{ $company->{'name_'.LANGUAGE_PREF} }}</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>


<section class="details-list">
    <div class="container">
        <div class="row utf_sticky_main_wrapper justify-content-center">
            <div class="col-lg-12 col-md-12">
                <div id="titlebar" class="utf_listing_titlebar">
                    <div class="utf_listing_titlebar_title">
                        <h2>{{ $company->{'name_'.LANGUAGE_PREF} }}</h2>
                        <p class="category">{{ $company->category_name }}</p>
                        <span>
                            <a href="#utf_listing_location" class="listing-address">
                                <i class="sl sl-icon-location"></i> {{$company->location}}
                            </a>
                        </span>
                        <div class="utf_listing_prige_block">
                            <span class="utf_meta_listing_price"><img src="{{asset(config('modules.site_configs.app_logo'))}}" /></span>
                        </div>
                        <span class="call_now"><i class="sl sl-icon-phone"></i> {{$company->phone}}</span>
                          <ul class="utf_social_icon rounded">
                            <li><a class="facebook" href="{{$company->facebook}}" target="_blank"><i class="icon-facebook"></i></a></li>
                            <li><a class="twitter" href="{{$company->twitter}}" target="_blank"><i class="icon-twitter"></i></a></li>
                            <li><a class="linkedin" href="{{$company->linkedin}}" target="_blank"><i class="icon-linkedin"></i></a></li>
                            <li><a class="instagram" href="{{$company->instagram}}" target="_blank"><i class="icon-instagram"></i></a></li>            
                          </ul>
                        <div id="utf_listing_tags" class="utf_listing_section listing_tags_section margin-bottom-10 margin-top-0">
                            <a href="#"><i class="sl sl-icon-phone" aria-hidden="true"></i> {{$company->whatsapp}}</a>
                            <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{$company->email}}</a>
                            <a href="#"><i class="sl sl-icon-globe" aria-hidden="true"></i> {{$company->website}}</a>
                        </div>
                    </div>
                </div>
                <div id="utf_listing_overview" class="utf_listing_section">
                    <h3 class="utf_listing_headline_part margin-top-30 margin-bottom-30">{{trans('Frontend::home.company_info')}}</h3>
                    <p>{{ $company->{'description_'.LANGUAGE_PREF} }}</p>

                    <div id="utf_listing_tags" class="utf_listing_section listing_tags_section margin-bottom-10 margin-top-0">
                        <a href="#"><i class="sl sl-icon-phone" aria-hidden="true"></i> +{{$company->whatsapp}}</a>
                        <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> {{$company->email}}</a>
                        <a href="#"><i class="sl sl-icon-globe" aria-hidden="true"></i> {{$company->website}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
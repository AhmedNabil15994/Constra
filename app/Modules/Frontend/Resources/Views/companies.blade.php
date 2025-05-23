@extends('frontend.Layouts.master')
@section('title','نساعدك في البناء')
@section('content')
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $category->{'name_'.LANGUAGE_PREF} }}</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{URL::to('/')}}">{{ $pages[0]->{'name_'.LANGUAGE_PREF} }}</a></li>
                        <li><a href="{{URL::to('/'.$pages[1]->prefix)}}">{{ $pages[1]->{'name_'.LANGUAGE_PREF} }}</a></li>
                        <li>{{ $category->{'name_'.LANGUAGE_PREF} }}</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="guide-list">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 listing_grid_item">
                <div class="row">
                    @foreach($data->data as $company)
                    <div class="col-lg-4 col-md-12">
                        <a href="{{URL::to('companies',['id'=>$company->id])}}" class="utf_listing_item-container" data-marker-id="1">
                            <div class="utf_listing_item">
                                <img src="{{ $company->image_url }}" alt="">
                                <span class="featured_tag">مميزة</span>
                                <div class="utf_listing_prige_block">
                                    <span class="utf_meta_listing_price"><img src="{{asset(config('modules.site_configs.app_logo'))}}" /></span>
                                </div>
                                <div class="utf_listing_item_content">
                                    <h3>{{ $company->{'name_'.LANGUAGE_PREF} }}</h3>
                                    <span><i class="fa fa-map-marker"></i> {{$company->location}}</span>
                                    <span><i class="fa fa-phone"></i> {{$company->phone}}</span>
                                </div>
                            </div>
                            <div class="utf_star_rating_section" data-rating="{{$company->rate}}">
                                <span class="utf_view_count"><i class="fa fa-eye"></i> {{$company->views}}+</span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="utf_pagination_container_part margin-top-20 margin-bottom-70">
                            @include('frontend.Partials.pagination')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


@endsection
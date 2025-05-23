@extends('frontend.Layouts.master')
@section('title','نساعدك في البناء')
@section('content')

@if(!empty($homeSliders))
<div id="utf_rev_slider_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="classicslider1" style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
    <div id="utf_rev_slider_block" class="rev_slider home fullwidthabanner" style="display:none;" data-version="5.0.7">
        <ul>
            @php $counter = 1; @endphp
            @foreach($homeSliders as $slider)
            <li data-index="rs-{{$counter}}" data-transition="fade" data-slotamount="default" data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="1000" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="800" data-fsslotamount="7" data-saveperformance="off">
                <img src="{{$slider->image_url}}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina data-kenburns="on" data-duration="12000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="112" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0">
                <div class="tp-caption centered utf_custom_caption tp-shape tp-shapewrapper tp-resizeme rs-parallaxlevel-0" id="utf_slide_layer_item_one" data-x="['center','center','center','center']" data-hoffset="['0']" data-y="['150','150','150','200']" data-voffset="['0']" data-width="['900','620', 640','420','320']" data-height="auto" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:0;opacity:0;s:1000;e:Power2.easeOutExpo;s:400;e:Power2.easeOutExpo" data-transform_out="" data-mask_in="x:0px;y:[20%];s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-responsive_offset="on">
                    <div class="utf_item_title margin-bottom-15" id="utf_slide_layer_detail_one" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['20','20','20','20']" data-voffset="['-40','-40','-20','-80']" data-fontsize="['46','36','20','24','13']" data-lineheight="['70','60','34','30','25']" data-width="['960','620', 640','420','320']" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="y:-50px;sX:2;sY:2;opacity:0;s:1000;e:Power4.easeOut;" data-transform_out="opacity:0;s:300;" data-start="600" data-splitin="none" data-splitout="none" data-basealign="slide" data-responsive_offset="off" data-responsive="off" style="z-index:6;color:#fff;letter-spacing:0px;font-weight:600;">{{ $slider->{'title_'.LANGUAGE_PREF} }}</div>
                    <div class="utf_rev_description_text">{{ $slider->{'description_'.LANGUAGE_PREF} }}</div>
                </div>
                <div class="main_popular_categories">
                    <ul class="main_popular_categories_list">
                        <li> <a href="{{URL::to('/ebook')}}">
                                <div class="utf_box"> <i class="fa fa-book"></i>
                                    <p>{{trans('Frontend::home.begin_structure')}}</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @php $counter++; @endphp
            @endforeach
        </ul>
        <div class="tp-static-layers"></div>
    </div>
</div>
@endif


@if(!empty($homeSections) && isset($homeSections[0]) && !empty($homeSections[0]) && $homeSections[0]->id == 1)
<section class="about-us padding-bottom-70 margin-top-70">
    <div class="container ">
        <div class="row">
            <div class="col-md-5 col-sm-6 col-xs-12">
                <a href="{{URL::to('/about')}}" class="img-box" data-background-image="{{$homeSections[0]->image_url}}">
                    <div class="utf_img_content_box visible">
                        <span><i class="fa fa-book"></i></span>
                        <h4>{{config('modules.site_configs.app_name_'.LANGUAGE_PREF)}}</h4>
                    </div>
                </a>
            </div>
            <div class="col-md-7 col-sm-6 col-xs-12">
                <span class="about">{{trans('Frontend::home.whoUs')}}</span>
                <h3 class="headline_part margin-bottom-15">
                    {{ $homeSections[0]->{'title_'.LANGUAGE_PREF} }}
                </h3>
                <p>{{ $homeSections[0]->{'description_'.LANGUAGE_PREF} }}</p>
                <a href="{{URL::to('/about')}}" class="button medium">{{trans('Frontend::home.readMore')}}</a>
            </div>
        </div>
    </div>
</section>
@endif
<section class="fullwidth_block departs color-bg padding-bottom-75">
    <div class="container">
        @if(!empty($homeSections) && isset($homeSections[1]) && !empty($homeSections[1]) && $homeSections[1]->id == 2)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h2 class="headline_part centered margin-top-80">{{ $homeSections[1]->{'title_'.LANGUAGE_PREF} }}
                    <span class="margin-top-10">{{ $homeSections[1]->{'description_'.LANGUAGE_PREF} }}</span>
                </h2>
            </div>
        </div>
        @endif

        <div class="row container_icon list-depart">
            @php
                $msgs = [
                    3 => trans('Frontend::home.begin_structure'),
                    4 => trans('Frontend::home.contact_companies'),
                    5 => trans('Frontend::home.order_request'),
                ];
                $icons = [
                    3 => 'Books',
                    4 => 'Building',
                    5 => 'Address-Book',
                ];
            @endphp
            @foreach($menus as $one)
                @if(!in_array($one->id, [1,2,6]))
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="box_icon_two box_icon_with_line"> <i class="im im-icon-{{$icons[$one->id]}}"></i>
                        <h3>{{ $one->{'name_'.LANGUAGE_PREF} }}</h3>
                        <a href="{{$one->prefix == '/' ? URL::to('/') : URL::to('/'.$one->prefix)}}" class="button medium">{{$msgs[$one->id]}}</a>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@if(!empty($homeSections) && isset($homeSections[2]) && !empty($homeSections[2]) && $homeSections[2]->id == 3)
<section class="fullwidth_block padding-top-75 padding-bottom-75" data-background-color="#ffffff">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="headline_part centered margin-bottom-50"> 
                    {{ $homeSections[2]->{'title_'.LANGUAGE_PREF} }} 
                    <span>{{ $homeSections[2]->{'description_'.LANGUAGE_PREF} }}</span>
                </h3>
            </div>
        </div>
        @if(!empty($homeBlogs))
        <div class="row">
            @foreach($homeBlogs as $blog)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="utf_blog_post">
                    <a href="{{URL::to('/blogs',['id'=>$blog->id])}}" class="utf_post_img"> <img src="{{$blog->image_url}}" alt=""> </a>
                    <div class="utf_post_content">
                        <h3><a href="{{URL::to('/blogs',['id'=>$blog->id])}}">{{ $blog->{'title_'.LANGUAGE_PREF} }}</a></h3>
                        <ul class="utf_post_text_meta">
                            <li dir="ltr">{{date('d M Y / H:i A',strtotime($blog->date))}}</li>
                        </ul>
                        <p>{{ mb_substr($blog->{'description_'.LANGUAGE_PREF}, 0, 300) }}.....<a href="{{URL::to('/blogs',['id'=>$blog->id])}}"></a></p>
                        <a href="{{URL::to('/blogs',['id'=>$blog->id])}}" class="read-more">{{trans('Frontend::home.readMore')}} <i class="fa fa-angle-left"></i></a>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-md-12 centered_content"> <a href="{{URL::to('/blogs')}}" class="button border margin-top-20">{{trans('Frontend::home.viewMore')}}</a> </div>
        </div>
        @endif
    </div>
</section>
@endif

@endsection
@extends('frontend.Layouts.master')
@section('title','نساعدك في البناء')
@section('content')
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $pages[1]->{'name_'.LANGUAGE_PREF} }}</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{URL::to('/')}}">{{ $pages[0]->{'name_'.LANGUAGE_PREF} }}</a></li>
                        <li>{{ $pages[1]->{'name_'.LANGUAGE_PREF} }}</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>


@if(!empty($sections))
@foreach($sections as $section)
<section class="about-us padding-bottom-70 margin-top-70">
    <div class="container ">
        <div class="row">
            <div class="col-md-5 col-sm-6 col-xs-12">
                <a href="about.php" class="img-box" data-background-image="{{$section->image_url}}">
                    <div class="utf_img_content_box visible">
                        <span><i class="fa fa-book"></i></span>
                        <h4>{{config('modules.site_configs.app_name_'.LANGUAGE_PREF)}}</h4>
                    </div>
                </a>
            </div>
            <div class="col-md-7 col-sm-6 col-xs-12">
                <span class="about">{{ $pages[1]->{'name_'.LANGUAGE_PREF} }}</span>
                <h3 class="headline_part margin-bottom-15">
                    {{ $section->{'title_'.LANGUAGE_PREF} }}
                </h3>
                <p>{{ $section->{'description_'.LANGUAGE_PREF} }}</p>
            </div>
        </div>
    </div>
</section>
@endforeach
@endif



@endsection
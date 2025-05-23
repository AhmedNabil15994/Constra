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


<section class="company fullwidth_block padding-bottom-75" data-background-color="#ffffff">
    <div class="container">
        <div class="row">
            @foreach($categories as $category)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="utf_blog_post">
                    <a href="{{URL::to('/categories',['id'=>$category->id])}}" class="utf_post_img"> <img src="{{$category->image_url}}" alt=""> </a>
                    <div class="utf_post_content">
                        <h3><a href="{{URL::to('/categories',['id'=>$category->id])}}">{{ $category->{'name_'.LANGUAGE_PREF} }}</a></h3>
                        <a href="{{URL::to('/categories',['id'=>$category->id])}}" class="read-more">{{trans('Frontend::home.viewCompanies')}} <i class="fa fa-angle-left"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>



@endsection
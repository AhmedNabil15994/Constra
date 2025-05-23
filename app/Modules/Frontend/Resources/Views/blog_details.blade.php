@extends('frontend.Layouts.master')
@section('title','نساعدك في البناء')
@section('content')
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $blog->{'title_'.LANGUAGE_PREF} }}</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{URL::to('/')}}">{{ $pages[0]->{'name_'.LANGUAGE_PREF} }}</a></li>
                        <li><a href="{{URL::to('/'.$pages[1]->prefix)}}">{{ $pages[1]->{'name_'.LANGUAGE_PREF} }}</a></li>
                        <li>{{ $blog->{'title_'.LANGUAGE_PREF} }}</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="blog-page-details">
    <div class="container">
        <div class="blog-page">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12">
                    <div class="utf_blog_post utf_single_post">
                        <img class="utf_post_img" src="{{$blog->image_url}}" alt="">
                        <div class="utf_post_content">
                            <h3>{{ $blog->{'title_'.LANGUAGE_PREF} }}</h3>
                            <ul class="utf_post_text_meta">
                                <li dir="ltr">{{date('d M Y / H:i A')}}</li>
                            </ul>
                            <p>{{ $blog->{'description_'.LANGUAGE_PREF} }}</p>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                </div>
            </div>
        </div>
    </div>
</section>



@endsection
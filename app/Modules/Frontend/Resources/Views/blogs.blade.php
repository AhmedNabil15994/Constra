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


<section class="fullwidth_block  padding-bottom-75" data-background-color="#ffffff">
    <div class="container">
        <div class="row">
            @foreach($data->data as $blog)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="utf_blog_post">
                    <a href="{{URL::to('/blogs',['id'=>$blog->id])}}" class="utf_post_img"> <img src="{{$blog->image_url}}" alt=""> </a>
                    <div class="utf_post_content">
                        <h3><a href="{{URL::to('/blogs',['id'=>$blog->id])}}">{{ $blog->{'name_'.LANGUAGE_PREF} }}</a></h3>
                        <ul class="utf_post_text_meta">
                            <li dir="ltr">{{date('d M Y / H:i A',strtotime($blog->date))}}</li>
                        </ul>
                        <p>{{ mb_substr($blog->{'description_'.LANGUAGE_PREF}, 0, 400) }}...<a href="blog_detail.php"></a></p>
                        <a href="{{URL::to('/blogs',['id'=>$blog->id])}}" class="read-more">{{trans('Frontend::home.readMore')}} <i class="fa fa-angle-left"></i></a>
                    </div>
                </div>
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
</section>


@endsection
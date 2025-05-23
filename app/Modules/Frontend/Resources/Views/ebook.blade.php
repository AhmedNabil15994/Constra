@extends('frontend.Layouts.master')
@section('title','نساعدك في البناء')
@push('css')
<style>
    html {
        scroll-behavior: smooth;
    }
    .mb-5{
        margin-bottom: 25px !important;
    }
    .utf_single_post p{
        margin:0;
    }
    /*.utf_dashboard_navigation ul li.active ul{*/
    /*    max-height: 400px !important;*/
    /*}*/
    @media (max-width: 1919px) {
        .utf_dashboard_navigation_inner_block{
            width: 100%;
        }
    }
    .utf_dashboard_navigation ul li a:after{
        content: " " !important;
    }
</style>
@endpush
@section('content')
<!-- Dashboard -->
<div id="dashboard">
    <a href="#" class="utf_dashboard_nav_responsive"><i class="fa fa-reorder"></i> خطوات البناء</a>
    <div class="utf_dashboard_navigation js-scrollbar">
        <div class="utf_dashboard_navigation_inner_block">
            <ul>
                @foreach($data as $category)
                <li class="active">
                    <a href="#category{{$category->id}}"><i class="sl sl-icon-layers"></i> {{ $category->{'name_'.LANGUAGE_PREF} }}</a>
                    <ul>
                        @foreach($category->blogs()->orderBy('sort')->get() as $blog)
                        <li><a href="#blog{{$blog->id}}"><i class="sl sl-icon-docs"></i> {{ $blog->{'title_'.LANGUAGE_PREF} }} </a></li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="utf_dashboard_content">
        @foreach($data as $category)
        <div id="titlebar category{{$category->id}}" class="dashboard_gradient">
            <div class="row">
                <div class="col-md-12">
                    <h2>{{ $category->{'name_'.LANGUAGE_PREF} }}</h2>
                </div>
            </div>
        </div>
        @foreach($category->blogs()->orderBy('sort')->get() as $blog)
        <div class="row" id="blog{{$blog->id}}">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="utf_blog_post utf_single_post card" id="ebook1">
                    {{-- <div class="watermark"></div> --}}
                    <div class="utf_post_content">
                        <h3 class="mb-5">{{ $blog->{'title_'.LANGUAGE_PREF} }}</h3>
                        @if($blog->image != '')
                        <img class="utf_post_img mb-5" src="{{$blog->image_url}}" alt="">
                        @endif
                        {!! $blog->{'description_'.LANGUAGE_PREF} !!}
                        @if($blog->date != '')
                        <ul class="utf_post_text_meta">
                            <li>{{date('d M Y / H:i A',strtotime($blog->date))}}</li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endforeach
    </div>
</div>
@endsection
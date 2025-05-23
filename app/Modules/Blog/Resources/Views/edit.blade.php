{{-- Extends layout --}}
@extends('dashboard.Layouts.master')
@section('title',$designElems['mainData']['title'])
@section('pageName',$designElems['mainData']['title'])

@section('styles')
<link href="{{asset('ckeditor5/css/ckeditor.css')}}" rel="stylesheet" id="style_components" type="text/css" />
<style type="text/css">
    .checkbox-single{
        width: 50px;
    }
    html[dir="rtl"] .form:not(.main) input[type="checkbox"]{
        right: 20px;
    }
    .form p.data{
        display: inline-block;
        margin-bottom: 0;
        font-weight: bold;
    }
</style>
@endsection

@section('breadcrumbs')
@include('dashboard.Layouts.breadcrumb',[
    'breadcrumbs' => [
        [
            'title' => trans('Dashboard::dashboard.menu'),
            'url' => \URL::to('/dashboard')
        ],
        [
            'title' => trans($designElems['mainData']['modelName'].'::'.lcfirst($designElems['mainData']['nameOne']).'.title'),
            'url' => \URL::to('/'.$designElems['mainData']['url'])
        ],
        [
            'title' => $blog->{'title_'.LANGUAGE_PREF},
            'url' => \URL::current()
        ],
    ]
])
@endsection

{{-- Content --}}

@section('content')
<div class="card card-custom formNumbers">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="{{ $designElems['mainData']['icon'] }} text-primary"></i>
            </span>
            <h3 class="card-label"> {{$designElems['mainData']['title']}}</h3>
        </div>
    </div>
    <form class="form" method="post" action="{{ URL::to($designElems['mainData']['url'].'/update/'.$blog->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <ul class="nav nav-tabs nav-success nav-pills" id="myTab" role="tablist">
                @foreach($available_locales as $key => $lang)
                <li class="nav-item">
                    <a class="nav-link {{$lang['prefix'] == LANGUAGE_PREF? 'active' : ''}}" id="home-tab-{{$key+1}}" data-toggle="tab" href="#home-{{$key+1}}">
                        <span class="nav-icon">
                            <img src="{{ asset($lang['flag']) }}" alt="{{$lang['name']}}">
                        </span>
                        <span class="nav-text"> {{$lang['name']}}</span>
                    </a>
                </li>
                @endforeach
            </ul>
            <div class="tab-content mt-5" id="myTabContent">
                @foreach($available_locales as $key => $lang)
                <div class="tab-pane fade {{$lang['prefix'] == LANGUAGE_PREF? 'active show' : ''}}" id="home-{{$key+1}}" role="tabpanel" aria-labelledby="home-tab-{{$key+1}}">
                    <div class="form-group row p-0 m-0 mb-5 pt-5">
                        <div class="col-3">
                            <label for="inputEmail3">{{ trans('Section::section.form.title_'.$lang['prefix']) }} :</label>                        
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" name="title_{{$lang['prefix']}}" value="{{ $blog->{'title_'.$lang['prefix']} }}" placeholder="{{ trans('Section::section.form.title_'.$lang['prefix']) }}">
                        </div>
                    </div>
                    <div class="form-group row p-0 m-0 mb-5 pt-5">
                        <div class="col-3">
                            <label for="inputEmail3">{{ trans('Section::section.form.description_'.$lang['prefix']) }} :</label>                        
                        </div>
                        <div class="col-9">
                            <textarea  class="form-control ckeditor5" name="description_{{$lang['prefix']}}" placeholder="{{ trans('Section::section.form.description_'.$lang['prefix']) }}" cols="30" rows="10">{{ $blog->{'description_'.$lang['prefix']} }}</textarea>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="form-group row p-0 m-0 mb-5 pt-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Blog::blog.form.sort') }} :</label>                        
                </div>
                <div class="col-9">
                    <input type="number" class="form-control" name="sort" value="{{$blog->sort}}" placeholder="{{ trans('Blog::blog.form.sort') }}">
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Blog::blog.form.date') }} :</label>
                </div>
                <div class="col-9">
                    <div class="input-group date" id="kt_datetimepicker_1" data-target-input="nearest">
                        <input type="text" name="date" value="{{ date('m/d/Y H:i A',strtotime($blog->date)) }}" class="form-control datetimepicker-input" placeholder="{{ trans('Blog::blog.form.date') }}" data-target="#kt_datetimepicker_1"/>
                        <div class="input-group-append" data-target="#kt_datetimepicker_1" data-toggle="datetimepicker">
                            <span class="input-group-text">
                                <i class="ki ki-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Blog::blog.form.category') }} :</label>
                </div>
                <div class="col-9">
                    <select name="category_id" class="form-control" data-toggle="select2">
                        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$category->id == $blog->category_id ? 'selected' : ''}} >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Section::section.form.status') }} :</label>
                </div>
                <div class="col-9">
                    <span class="switch switch-icon">
                        <label>
                            <input type="checkbox" value="1" name="status" {{$blog->status  == 1 ? 'checked' : ''}}/>
                            <span></span>
                        </label>
                    </span>
                </div>
            </div>
            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label>{{trans('Section::section.form.image')}}</label>
                </div>
                <div class="col-9">
                    <div class="image-input image-input-outline" id="kt_image_5" style="background-image: url({{ $blog->image ? $blog->image_url : asset(config('modules.site_configs.default_upload_img'))  }})">
                        <div class="image-input-wrapper"></div>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{trans('Section::section.form.change_image_p')}}">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="image"/>
                            <input type="hidden" name="image_remove"/>
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Background"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right mt-10">
                <button type="submit" class="btn btn-primary mr-2">{{trans('Dashboard::dashboard.edit')}}</button>
                <a href="{{ URL::to('/'.$designElems['mainData']['url']) }}" class="btn btn-secondary">{{trans('Dashboard::dashboard.back')}}</a>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="{{asset('ckeditor5/js/ckeditor.js')}}"></script>
<script src="{{asset('ckeditor5/js/ckEditorScripts.js')}}"></script>
<script src="{{asset('assets/dashboard/components/blogs.js')}}"></script>
@endsection

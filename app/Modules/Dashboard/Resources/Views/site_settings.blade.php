{{-- Extends layout --}}
@extends('dashboard.Layouts.master')
@section('title',$designElems['mainData']['title'])
@section('pageName',$designElems['mainData']['title'])

@section('styles')
<style type="text/css">

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
            'title' => $designElems['mainData']['title'],
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
    <form class="form" method="post" action="{{ URL::current() }}" enctype="multipart/form-data">
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
                <div class="tab-pane fade  {{$lang['prefix'] == LANGUAGE_PREF? 'active show' : ''}}" id="home-{{$key+1}}" role="tabpanel" aria-labelledby="home-tab-{{$key+1}}">
                    <div class="form-group row p-0 m-0 mb-5 pt-5">
                        <div class="col-3">
                            <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.app_name_'.$lang['prefix']) }} :</label>                        
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" name="app_name_{{$lang['prefix']}}" 
                            value="{{ isset($data['app_name_'.$lang['prefix']]) && !empty($data['app_name_'.$lang['prefix']]) ? $data['app_name_'.$lang['prefix']] : old('app_name_'.$lang['prefix']) }}" 
                            placeholder="{{ trans('Dashboard::dashboard.setting.app_name_'.$lang['prefix']) }}">
                        </div>
                    </div>
                    <div class="form-group row p-0 m-0 mb-5 pt-5">
                        <div class="col-3">
                            <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.app_desc_'.$lang['prefix']) }} :</label>                        
                        </div>
                        <div class="col-9">
                            <textarea  class="form-control" name="app_desc_{{$lang['prefix']}}" placeholder="{{ trans('Dashboard::dashboard.setting.app_desc_'.$lang['prefix']) }}" cols="30" rows="10">{{ isset($data['app_desc_'.$lang['prefix']]) && !empty($data['app_desc_'.$lang['prefix']]) ? $data['app_desc_'.$lang['prefix']] : old('app_desc_'.$lang['prefix']) }}</textarea>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.limitted_size') }} :</label>
                </div>
                <div class="col-9">
                    <input type="text" id="kt_touchspin_1" min="1" class="form-control" name="limitted_size" value="{{ isset($data['limitted_size']) && !empty($data['limitted_size']) ? $data['limitted_size'] : old('limitted_size') }}" placeholder="{{ trans('Dashboard::dashboard.setting.limitted_size') }}">
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.pagination') }} :</label>
                </div>
                <div class="col-9">
                    <input type="text" id="kt_touchspin_2" min="1" class="form-control" name="pagination" value="{{ isset($data['pagination']) && !empty($data['pagination']) ? $data['pagination'] : old('pagination') }}" placeholder="{{ trans('Dashboard::dashboard.setting.pagination') }}">
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label>{{ trans('Dashboard::dashboard.setting.app_logo') }}</label>
                </div>
                <div class="col-9">
                    <div class="image-input image-input-empty image-input-outline" id="kt_image_5" style="background-image: url({{ asset( (isset($data['app_logo']) && !empty($data['app_logo']) ? $data['app_logo'] : 'assets/dashboard/images/logo.png') )  }})">
                        <div class="image-input-wrapper"></div>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{trans('User::user.form.change_image_p')}}">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="app_logo"/>
                            <input type="hidden" name="app_logo_remove"/>
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Background"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label>{{ trans('Dashboard::dashboard.setting.app_favicon') }}</label>
                </div>
                <div class="col-9">
                    <div class="image-input image-input-empty image-input-outline" id="kt_image_6" style="background-image: url({{ asset( (isset($data['app_favicon']) && !empty($data['app_favicon']) ? $data['app_favicon'] : 'assets/dashboard/images/logo.png') )  }})">
                        <div class="image-input-wrapper"></div>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{trans('User::user.form.change_image_p')}}">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="app_favicon"/>
                            <input type="hidden" name="app_favicon_remove"/>
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Background"><i class="ki ki-bold-close icon-xs text-muted"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label>{{ trans('Dashboard::dashboard.setting.default_upload_img') }}</label>
                </div>
                <div class="col-9">
                    <div class="image-input image-input-empty image-input-outline" id="kt_image_7" style="background-image: url({{ asset( (isset($data['default_upload_img']) && !empty($data['default_upload_img']) ? $data['default_upload_img'] : 'assets/dashboard/images/logo.png') )  }})">
                        <div class="image-input-wrapper"></div>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{trans('User::user.form.change_image_p')}}">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="default_upload_img"/>
                            <input type="hidden" name="default_upload_remove"/>
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
<script src="{{asset('assets/dashboard/components/settings.js')}}"></script>
@endsection

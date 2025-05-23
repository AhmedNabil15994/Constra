{{-- Extends layout --}}
@extends('dashboard.Layouts.master')
@section('title',$designElems['mainData']['title'])
@section('pageName',$designElems['mainData']['title'])

@section('styles')
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
    .form{
        background: #EEF0F8;
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
            'title' => $company->{'name_'.LANGUAGE_PREF},
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
    <form class="form" method="post" action="{{ URL::to($designElems['mainData']['url'].'/update/'.$company->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <ul class="navi navi-border card">
                        <li class="navi-item">
                            <a class="navi-link active" data-toggle="tab" href="#kt_tab_pane_1">
                                <span class="navi-icon"><i class="flaticon2-list"></i></span>
                                <span class="navi-text">{{trans('Company::company.form.basic_data')}}</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a class="navi-link" data-toggle="tab" href="#kt_tab_pane_2">
                                <span class="navi-icon"><i class="flaticon2-user"></i></span>
                                <span class="navi-text">{{ trans('Company::company.form.contact_info') }}</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a class="navi-link" data-toggle="tab" href="#kt_tab_pane_3">
                                <span class="navi-icon"><i class="flaticon2-chat-1"></i></span>
                                <span class="navi-text">{{trans('Company::company.form.social_links')}}</span>
                            </a>
                         </li>
                    </ul>
                </div>
                <div class="col-9 card py-5">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_1">
                            <ul class="nav nav-tabs nav-success nav-pills" id="myTab" role="tablist">
                                @foreach($available_locales as $key => $lang)
                                <li class="nav-item">
                                    <a class="nav-link {{$lang['prefix'] == LANGUAGE_PREF? 'active' : ''}}" id="homes-tab-{{$key+1}}" data-toggle="tab" href="#homes-{{$key+1}}">
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
                                <div class="tab-pane fade  {{$lang['prefix'] == LANGUAGE_PREF? 'active show' : ''}}" id="homes-{{$key+1}}" role="tabpanel" aria-labelledby="homes-tab-{{$key+1}}">
                                    <div class="form-group row p-0 m-0 mb-5 pt-5">
                                        <div class="col-3">
                                            <label for="inputEmail3">{{ trans('Company::company.form.name_'.$lang['prefix']) }} :</label>                        
                                        </div>
                                        <div class="col-9">
                                            <input type="text" class="form-control" name="name_{{$lang['prefix']}}" value="{{ $company->{'name_'.$lang['prefix']} }}" placeholder="{{ trans('Company::company.form.name_'.$lang['prefix']) }}">
                                        </div>
                                    </div>
                                    <div class="form-group row p-0 m-0 mb-5 pt-5">
                                        <div class="col-3">
                                            <label for="inputEmail3">{{ trans('Company::company.form.description_'.$lang['prefix']) }} :</label>                        
                                        </div>
                                        <div class="col-9">
                                            <textarea  class="form-control" name="description_{{$lang['prefix']}}" placeholder="{{ trans('Company::company.form.description_'.$lang['prefix']) }}" cols="30" rows="10">{{ $company->{'description_'.$lang['prefix']} }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="form-group row p-0 m-0 mb-5">
                                <div class="col-3">
                                    <label for="inputEmail3">{{ trans('Blog::blog.form.category') }} :</label>
                                </div>
                                <div class="col-9">
                                    <select name="category_id" class="form-control" data-toggle="select2">
                                        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$category->id == $company->category_id ? 'selected' : ''}} >{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row p-0 m-0 mb-5">
                                <div class="col-3">
                                    <label for="inputEmail3">{{ trans('Company::company.form.rate') }} :</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" id="kt_touchspin_1" min="1" max="5" class="form-control" name="rate" value="{{$company->rate}}" placeholder="{{ trans('Company::company.form.rate') }}">
                                </div>
                            </div>
                            <div class="form-group row p-0 m-0 mb-5">
                                <div class="col-3">
                                    <label for="inputEmail3">{{ trans('Company::company.form.views') }} :</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" id="kt_touchspin_2" min="1"  class="form-control" name="views" value="{{$company->views}}" placeholder="{{ trans('Company::company.form.views') }}">
                                </div>
                            </div>
                            
                            <div class="form-group row p-0 m-0 mb-5">
                                <div class="col-3">
                                    <label for="inputEmail3">{{ trans('Section::section.form.status') }} :</label>
                                </div>
                                <div class="col-9">
                                    <span class="switch switch-icon">
                                        <label>
                                            <input type="checkbox" value="1" name="status" {{ $company->status  == 1 ? 'checked' : ''}}/>
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
                                    <div class="image-input image-input-outline" id="kt_image_5" style="background-image: url({{ $company->image ? $company->image_url : asset(config('modules.site_configs.default_upload_img'))  }})">
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
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                            <div class="form-group row p-0 m-0 mb-5">
                                <div class="col-3">
                                    <label for="inputEmail3">{{ trans('Company::company.form.location') }} :</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control" name="location" value="{{$company->location}}" placeholder="{{ trans('Company::company.form.location') }}">
                                </div>
                            </div>
                            <div class="form-group row p-0 m-0 mb-5">
                                <div class="col-3">
                                    <label for="inputEmail3">{{ trans('Company::company.form.phone') }} :</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control" name="phone" value="{{$company->phone}}" placeholder="{{ trans('Company::company.form.phone') }}">
                                </div>
                            </div>
                            <div class="form-group row p-0 m-0 mb-5">
                                <div class="col-3">
                                    <label for="inputEmail3">{{ trans('Company::company.form.whatsapp') }} :</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control" name="whatsapp" value="{{$company->whatsapp}}" placeholder="{{ trans('Company::company.form.whatsapp') }}">
                                </div>
                            </div>
                            <div class="form-group row p-0 m-0 mb-5">
                                <div class="col-3">
                                    <label for="inputEmail3">{{ trans('Company::company.form.email') }} :</label>
                                </div>
                                <div class="col-9">
                                    <input type="email" class="form-control" name="email" value="{{$company->email}}" placeholder="{{ trans('Company::company.form.email') }}">
                                </div>
                            </div>
                            <div class="form-group row p-0 m-0 mb-5">
                                <div class="col-3">
                                    <label for="inputEmail3">{{ trans('Company::company.form.website') }} :</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control" name="website" value="{{$company->website}}" placeholder="{{ trans('Company::company.form.website') }}">
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
                            <div class="form-group row p-0 m-0 mb-5">
                                <div class="col-3">
                                    <label for="inputEmail3">{{ trans('Company::company.form.facebook') }} :</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control" name="facebook" value="{{$company->facebook}}" placeholder="{{ trans('Company::company.form.facebook') }}">
                                </div>
                            </div>
                            <div class="form-group row p-0 m-0 mb-5">
                                <div class="col-3">
                                    <label for="inputEmail3">{{ trans('Company::company.form.twitter') }} :</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control" name="twitter" value="{{$company->twitter}}" placeholder="{{ trans('Company::company.form.twitter') }}">
                                </div>
                            </div>
                            <div class="form-group row p-0 m-0 mb-5">
                                <div class="col-3">
                                    <label for="inputEmail3">{{ trans('Company::company.form.instagram') }} :</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control" name="instagram" value="{{$company->instagram}}" placeholder="{{ trans('Company::company.form.instagram') }}">
                                </div>
                            </div>
                            <div class="form-group row p-0 m-0 mb-5">
                                <div class="col-3">
                                    <label for="inputEmail3">{{ trans('Company::company.form.linkedin') }} :</label>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control" name="linkedin" value="{{$company->linkedin}}" placeholder="{{ trans('Company::company.form.linkedin') }}">
                                </div>
                            </div>
                        </div>
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
<script src="{{asset('assets/dashboard/components/companies.js')}}"></script>
@endsection

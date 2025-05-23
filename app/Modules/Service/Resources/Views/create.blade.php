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
            'title' => trans($designElems['mainData']['addOne']),
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
    <form class="form" method="post" action="{{ URL::to($designElems['mainData']['url'].'/create') }}" enctype="multipart/form-data">
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
                <div class="tab-pane fade {{$key == 0 ? 'active show' : '' }}" id="home-{{$key+1}}" role="tabpanel" aria-labelledby="home-tab-{{$key+1}}">
                    <div class="form-group row p-0 m-0 mb-5 pt-5">
                        <div class="col-3">
                            <label for="inputEmail3">{{ trans('Role::role.form.name_'.$lang['prefix']) }} :</label>                        
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" name="name_{{$lang['prefix']}}" value="{{old('name_'.$lang['prefix'])}}" placeholder="{{ trans('Role::role.form.name_'.$lang['prefix']) }}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Service::service.form.icon') }} :</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" name="icon" value="{{old('icon')}}" placeholder="{{ trans('Service::service.form.icon') }}">
                </div>
            </div>
            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Role::role.form.status') }} :</label>
                </div>
                <div class="col-9">
                    <span class="switch switch-icon">
                        <label>
                            <input type="checkbox" value="1" name="status" checked />
                            <span></span>
                        </label>
                    </span>
                </div>
            </div>
            <div class="card-footer text-right mt-10">
                <button type="submit" class="btn btn-primary mr-2">{{trans('Dashboard::dashboard.add')}}</button>
                <a href="{{ URL::to('/'.$designElems['mainData']['url']) }}" class="btn btn-secondary">{{trans('Dashboard::dashboard.back')}}</a>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
@endsection
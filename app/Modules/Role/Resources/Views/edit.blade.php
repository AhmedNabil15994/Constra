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
            'title' => $role->id,
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
    <form class="form" method="post" action="{{ URL::to($designElems['mainData']['url'].'/update/'.$role->id) }}" enctype="multipart/form-data">
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
                            <label for="inputEmail3">{{ trans('Role::role.form.name_'.$lang['prefix']) }} :</label>                        
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" name="name_{{$lang['prefix']}}" value="{{ $role->{'name_'.$lang['prefix']} }}" placeholder="{{ trans('Role::role.form.name_'.$lang['prefix']) }}">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Role::role.form.status') }} :</label>
                </div>
                <div class="col-9">
                    <span class="switch switch-icon">
                        <label>
                            <input type="checkbox" value="1" name="status" {{$role->status  == 1 ? 'checked' : ''}}/>
                            <span></span>
                        </label>
                    </span>
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label>{{ trans('Role::role.form.permissions') }}</label>
                </div>
                <div class="col-9">
                    <select class="form-control" data-toggle="select2" id="kt_select2_3" data-placeholder="{{trans('Dashboard::dashboard.choose')}}" name="permissions[]" multiple="multiple">
                        @foreach($permissions as $key => $permission)
                        @php 
                            $module = str_replace('Controller','',$key);
                            $rolePerms = $role->permissions != null ? unserialize($role->permissions) : [];
                        @endphp 
                        <optgroup label="{{ trans($module.'::'.lcfirst($module).'.title') }}">
                            @foreach($permission as $one => $onePerm)
                            @php 
                                $perm = '';
                                $permArr = explode('.', $onePerm['perm_title']); 
                                if(isset($permArr) && isset($permArr[1])){
                                    $perm = ucwords(str_replace('-',' ',$permArr[1]));
                                }
                            @endphp 

                            <option value="{{ $onePerm['perm_name'] }}" {{in_array($onePerm['perm_name'],$rolePerms) ? 'selected' : ''}}>{{ $perm }}</option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
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
@endsection

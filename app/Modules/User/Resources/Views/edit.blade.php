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
            'title' => ucwords($user->name),
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
    <form class="form" method="post" action="{{ URL::to($designElems['mainData']['url'].'/update/'.$user->id) }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('User::user.form.first_name') }} :</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" placeholder="{{ trans('User::user.form.first_name') }}">
                </div>
            </div>
            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('User::user.form.last_name') }} :</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" placeholder="{{ trans('User::user.form.last_name') }}">
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('User::user.form.email') }} :</label>
                </div>
                <div class="col-9">
                    <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="{{ trans('User::user.form.email') }}">
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('User::user.form.password') }} :</label>
                </div>
                <div class="col-9">
                    <input type="password" class="form-control" name="password" placeholder="{{ trans('User::user.form.password') }}">
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('User::user.form.password_confirmation') }} :</label>
                </div>
                <div class="col-9">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="{{ trans('User::user.form.password_confirmation') }}">
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('User::user.form.role') }} :</label>
                </div>
                <div class="col-9">
                    <select name="role_id" class="form-control" data-toggle="select2">
                        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}" {{$role->id == $user->role_id ? 'selected' : ''}} >{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label>{{ trans('User::user.form.extra_permissions') }}</label>
                </div>
                <div class="col-9">
                    <select class="form-control" data-toggle="select2" id="kt_select2_3" data-placeholder="{{trans('Dashboard::dashboard.choose')}}" name="extra_permissions[]" multiple="multiple">
                        @foreach($permissions as $key => $permission)
                        @php 
                            $module = str_replace('Controller','',$key);
                            $userPerms = $user->extra_permissions != null ? unserialize($user->extra_permissions) : [];
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

                            <option value="{{ $onePerm['perm_name'] }}" {{in_array($onePerm['perm_name'],$userPerms) ? 'selected' : ''}}>{{ $perm }}</option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label>{{trans('User::user.form.image')}}</label>
                </div>
                <div class="col-9">
                    <div class="image-input image-input-outline" id="kt_image_5" style="background-image: url({{ $user->image ? $user->image_url : asset(config('modules.site_configs.default_upload_img'))  }})">
                        <div class="image-input-wrapper"></div>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{trans('User::user.form.change_image_p')}}">
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
<script src="{{asset('assets/dashboard/components/users.js')}}"></script>
@endsection

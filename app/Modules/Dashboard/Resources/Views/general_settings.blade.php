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
            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.phone') }} :</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" name="phone" value="{{ isset($data['phone']) && !empty($data['phone']) ? $data['phone'] : old('phone') }}" placeholder="{{ trans('Dashboard::dashboard.setting.phone') }}">
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.email') }} :</label>
                </div>
                <div class="col-9">
                    <input type="email" class="form-control" name="email" value="{{ isset($data['email']) && !empty($data['email']) ? $data['email'] : old('email') }}" placeholder="{{ trans('Dashboard::dashboard.setting.email') }}">
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.location') }} :</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" name="location" value="{{ isset($data['location']) && !empty($data['location']) ? $data['location'] : old('location') }}" placeholder="{{ trans('Dashboard::dashboard.setting.location') }}">
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.enable_emails') }} :</label>
                </div>
                <div class="col-9">
                    <span class="switch switch-icon">
                        <label>
                            <input type="checkbox" value="1" name="enable_emails" {{ !isset($data['enable_emails']) ? (old('enable_emails') == 1 ? 'checked' : '') : ($data['enable_emails'] == 1 ? 'checked' : '') }}/>
                            <span></span>
                        </label>
                    </span>
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.sender_email') }} :</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" name="sender_email" value="{{ isset($data['sender_email']) && !empty($data['sender_email']) ? $data['sender_email'] : old('sender_email') }}" placeholder="{{ trans('Dashboard::dashboard.setting.sender_email') }}">
                </div>
            </div>

            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Dashboard::dashboard.setting.sender_name') }} :</label>
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" name="sender_name" value="{{ isset($data['sender_name']) && !empty($data['sender_name']) ? $data['sender_name'] : old('sender_name') }}" placeholder="{{ trans('Dashboard::dashboard.setting.sender_name') }}">
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

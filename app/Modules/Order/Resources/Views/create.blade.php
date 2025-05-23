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
            <div class="form-group row p-0 m-0 mb-5 pt-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Order::order.form.name') }} :</label>                     
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="{{ trans('Order::order.form.name') }}">
                </div>
            </div>
            <div class="form-group row p-0 m-0 mb-5 pt-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Order::order.form.email') }} :</label>                     
                </div>
                <div class="col-9">
                    <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="{{ trans('Order::order.form.email') }}">
                </div>
            </div>
            <div class="form-group row p-0 m-0 mb-5 pt-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Order::order.form.phone') }} :</label>                     
                </div>
                <div class="col-9">
                    <input type="text" class="form-control" name="phone" value="{{old('phone')}}" placeholder="{{ trans('Order::order.form.phone') }}">
                </div>
            </div>
            <div class="form-group row p-0 m-0 mb-5 pt-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Order::order.form.message') }} :</label>                     
                </div>
                <div class="col-9">
                    <textarea  class="form-control" name="message" placeholder="{{ trans('Order::order.form.message') }}" cols="30" rows="10">{{ old('message') }}</textarea>
                </div>
            </div>
            <div class="form-group row p-0 m-0 mb-5">
                <div class="col-3">
                    <label for="inputEmail3">{{ trans('Order::order.form.service') }} :</label>
                </div>
                <div class="col-9">
                    <select name="service_id" class="form-control" data-toggle="select2">
                        <option value="">{{trans('Dashboard::dashboard.choose')}}</option>
                        @foreach($services as $service)
                        <option value="{{$service->id}}" {{$service->id == old('service_id') ? 'selected' : ''}} >{{$service->name}}</option>
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
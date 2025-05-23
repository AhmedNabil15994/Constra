@extends('frontend.Layouts.master')
@section('title','نساعدك في البناء')
@push('css')
<style>
  .utf_category_small_box_part{
    cursor: pointer;
  }
</style>
@endpush
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

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3 class="headline_part centered "> {{trans('Frontend::home.helper_services')}}</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="container_categories_box margin-top-5 margin-bottom-75"> 
        @foreach($services as $service)
        <span  class="utf_category_small_box_part" data-area="{{$service->id}}"> 
          <i class="{{$service->icon}}"></i>
		      <h4>{{ $service->{'name_'.LANGUAGE_PREF} }}</h4>
        </span> 
        @endforeach
	    </div>
    </div>
    <div class="col-md-12">
      <section id="contact" class="margin-bottom-70">
        <form id="contactform" method="post" action="{{URL::current()}}">
          @csrf
          <div class="row">
            <div class="col-md-12">  
  		        <input name="name" type="text" value="{{old('name')}}" placeholder="{{trans('Frontend::home.name')}}" required />                
            </div>
            
            <div class="col-md-6">                
                <input name="email" type="email" value="{{old('email')}}" placeholder="{{trans('Frontend::home.email')}}" required />                
            </div>
            <div class="col-md-6">
                <input name="phone" type="text" value="{{old('phone')}}" placeholder="{{trans('Frontend::home.phone')}}" required />              
            </div>
              <div class="col-md-12">
                <div class="intro-search-field utf-chosen-cat-single">
      					  <select class="selectpicker default" name="service_id" data-selected-text-format="count" required data-size="7" title="{{trans('Frontend::home.services')}}">
                    @foreach($services as $service)
        						<option value="{{$service->id}}" {{old('service_id') == $service->id ? 'selected' : ''}} >{{ $service->{'name_'.LANGUAGE_PREF} }}</option>
                    @endforeach
      					  </select>
      				  </div>
              </div>
      			  <div class="col-md-12">
      				  <textarea name="message" cols="40" rows="2" id="comments" placeholder="{{trans('Frontend::home.message')}}" required>{{old('message')}}</textarea>
      			  </div>
          </div>            
          <input type="submit" class="submit button" id="submit" value="{{trans('Frontend::home.message')}}" />
        </form>
      </section>
    </div>
  </div>
</div>
@endsection
@push('js')
  <script type="text/javascript">
    $(function(){
      $('.utf_category_small_box_part').on('click',function(){
          let val = $(this).data('area');
          $('select[name="service_id"]').val(val).trigger('change');
      });
    });
  </script>
@endpush
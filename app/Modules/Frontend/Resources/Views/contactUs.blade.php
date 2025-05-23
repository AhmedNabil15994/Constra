@extends('frontend.Layouts.master')
@section('title','نساعدك في البناء')
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
        <div class="col-md-8">
            <section id="contact" class="margin-bottom-70">
                <h4><i class="sl sl-icon-phone"></i> {{ trans('Frontend::home.contactUs') }}</h4>          
                <form id="contactform" method="post" action="{{URL::current()}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">  
        			        <input name="name" value="{{old('name')}}" type="text" placeholder="{{trans('Frontend::home.name')}}" required />                
                        </div>
                        <div class="col-md-6">                
                            <input name="email" value="{{old('email')}}" type="email" placeholder="{{trans('Frontend::home.email')}}" required />                
                        </div>
                        <div class="col-md-6">
                            <input name="phone" value="{{old('phone')}}" type="text" placeholder="{{trans('Frontend::home.phone')}}" required />              
                        </div>
            		    <div class="col-md-12">
            			    <textarea name="message" cols="40" rows="2" id="comments" placeholder="{{trans('Frontend::home.message')}}" required>{{old('message')}}</textarea>
            		    </div>
                    </div>            
                    <input type="submit" class="submit button" id="submit" value="{{trans('Frontend::home.send_message')}}" />
                </form>
            </section>
        </div>
    
        <div class="col-md-4">
    	    <div class="utf_box_widget margin-bottom-70">
    		    <h3><i class="sl sl-icon-map"></i> {{trans('Frontend::home.mainBranch')}}</h3>
		        <div class="utf_sidebar_textbox">
		            <ul class="utf_contact_detail">
			            <li><strong>{{trans('Frontend::home.phone')}}:-</strong> <span dir="ltr">+ {{config('modules.general_configs.phone')}}</span></li>
			            <li><strong>{{trans('Frontend::home.email')}}:-</strong> <span><a href="mailto:{{config('modules.general_configs.email')}}">{{config('modules.general_configs.email')}}</a></span></li>
			            <li><strong>{{trans('Frontend::home.location')}}:-</strong> <span>{{{config('modules.general_configs.email')}}}}</span></li>
		            </ul>
		        </div>	
           </div>
    	</div>
    </div>
</div>
@endsection
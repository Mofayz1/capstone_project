@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-100 pb-100">
    <div class="container">
        <div class="row">
          	<div class="col-lg-8">
            	<div class="doctor-details-header rounded-3">
	              	<div class="thumb  rounded-3">
	                	<img src="{{getImage('assets/images/doctor/'. $doctor->image, '352x396')}}" alt="@lang('image')" class="w-100">
	              	</div>
	              	<div class="content">
	                	<h3 class="name">{{__($doctor->name)}}</h3>
		                <ul class="doctor-info-list mt-3">
		                  	<li>
		                    	<i class="las la-pen-alt"></i>
		                    	<span>{{__($doctor->qualification)}}</span>
		                  	</li>
		                  	<li>
		                    	<i class="las la-hospital"></i> 
		                    	<span>{{__($doctor->present_work)}}</span>
		                  	</li>
		                  	<li>
		                    	<i class="las la-business-time"></i>
		                    	<span>@lang('Available') : {{$doctor->start_time}} - {{$doctor->end_time}}</span> 
		                  	</li>

		                  	<li>
                                <i class="las la-phone-volume"></i>
                                <span>@lang('Appoinment') : {{$doctor->appoinment}}</span> 
                            </li>

                            <li>
                                <i class="las la-location-arrow"></i>
                                <span>@lang('Location') : {{$doctor->location->name}} - {{$doctor->location->city->name}}</span> 
                            </li>
		                </ul>
	              	</div>
	            </div>


		        <div class="doctor-details-content mt-5">
		            <h5 class="mb-3">@lang('Doctor overview')</h5>
		              	<ul class="caption-list-two">
			                <li>
			                  	<span class="caption">@lang('Qualifications')</span>
			                  	<span class="value">{{__($doctor->qualification)}}</span>
			                </li>

			                <li>
			                  	<span class="caption">@lang('Specialty')</span>
			                  	<span class="value">{{__($doctor->specialty)}}</span>
			                </li>

			                <li>
			                  	<span class="caption">@lang('Designation')</span>
			                  	<span class="value">{{__($doctor->designation)}}</span>
			                </li>
			                <li>
			                  	<span class="caption">@lang('Institute')</span>
			                  	<span class="value">{{__($doctor->institute)}}</span>
			                </li>

			                 <li>
			                  	<span class="caption">@lang('Email')</span>
			                  	<span class="value">{{__($doctor->email)}}</span>
			                </li>

			                 <li>
			                  	<span class="caption">@lang('Phone')</span>
			                  	<span class="value">{{__($doctor->phone)}}</span>
			                </li>
		              	</ul>

						@php 
                           echo advertisements("992x204")
                        @endphp

		              	<h5 class="mt-5 mb-3">@lang('Doctor Chember List')</h5>
			            <div class="row gy-4">
			            	@foreach($doctor->chember as $chem)
				                <div class="col-lg-12">
				                  	<div class="chember-single rounded-3">
				                    	<ul class="caption-list"> 
						                    <li>
						                        <span class="caption d-flex align-items-center"><i class="las la-keyboard fs-4 me-2 text--base"></i> @lang('Chamber Name')</span>
						                        <span class="value">{{__($chem->name)}}</span>
						                    </li>
						                    <li>
						                        <span class="caption d-flex align-items-center"><i class="las la-clock fs-4 me-2 text--base"></i> @lang('Visiting Hour')</span>
						                        <span class="value">{{$chem->start_time}} - {{$chem->end_time}}</span>
						                    </li>
						                    <li>
						                        <span class="caption d-flex align-items-center"><i class="las la-phone-volume fs-4 me-2 text--base"></i> @lang('Appoinment')</span>
						                        <span class="value">{{__($chem->appoinment)}}</span>
						                    </li>
						                    <li>
						                        <span class="caption d-flex align-items-center"><i class="las la-envelope fs-4 me-2 text--base"></i> @lang('Email Address')</span>
						                        <span class="value">{{__($chem->email)}}</span>
						                    </li>
						                    <li>
						                        <span class="caption d-flex align-items-center"><i class="las la-map-marked-alt fs-4 me-2 text--base"></i> @lang('Location')</span>
						                        <span class="value">{{__($chem->location->name)}} - {{__($chem->location->city->name)}}</span>
						                    </li>
						                </ul>
						            </div>
				                </div>
				            @endforeach
			            </div>
          			</div>
        		</div>

        		<div class="col-lg-4 ps-lg-5 mt-lg-0 mt-5">
		            <div class="doctor-sidebar">
		              <div class="doctor-widget">
		                <h5 class="mb-4 text-white">@lang('Contact with the doctor')</h5>
			                <form action="{{route('contact.doctor')}}" method="POST">
			                	@csrf
			                	<input type="hidden" name="doctor_id" value="{{$doctor->id}}">
			                  	<div class="form-group">
			                    	<input type="text" name="name" class="form--control" value="{{old('name')}}" placeholder="@lang('Enter full name')" required="">
			                  	</div>
			                  	<div class="form-group">
			                    	<input type="email" name="email" class="form--control" value="{{old('email')}}" placeholder="@lang('Enter email address')" required="">
			                  	</div>
			                  	<div class="form-group">
			                    	<textarea name="message" class="form--control" placeholder="@lang('Write message')" required="">{{old('message')}}</textarea>
			                  	</div>
			                  	<div class="text-end">
			                    	<button type="submit" class="btn btn--base">@lang('Send Message')</button>
			                  	</div>
			                </form>
		              	</div>
						
						@php 
                           echo advertisements("509x511")
                        @endphp
		            </div>
		        </div>
      		</div>
      	</div>
    </section>
 @endsection
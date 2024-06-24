
@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
   $doctor = getContent('doctor.content', true);
@endphp
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-lg-0 mb-3">
                <button class="action-sidebar-open"><i class="las la-sliders-h"></i> @lang('Filter')</button>
                    <div class="action-sidebar">
                        <button class="action-sidebar-close"><i class="las la-times"></i></button>
                        <form action="{{route('doctor.search.filter')}}" method="GET">
                            <div class="action-widget mt-4">
                                <h4 class="action-widget__title">@lang('Filter by Location')</h4>
                                <div class="action-widget__body">
                                    @foreach($locations as $location)
                                        <div class="form-check custom--checkbox">
                                            <input class="form-check-input doctorLocation" name="location_id[]" type="checkbox" value="{{$location->id}}" id="{{$location->id}}.'location'"
                                                @if(!empty($locationData))
                                                    @foreach($locationData as $val)
                                                        @if($val == $location->id)
                                                            checked
                                                        @endif
                                                    @endforeach
                                                @endif
                                            >
                                            <label class="form-check-label" for="{{$location->id}}.'location'">{{__($location->name)}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            @php 
                                echo advertisements("509x511")
                            @endphp

                            <div class="action-widget mt-4">
                                <h4 class="action-widget__title">@lang('Filter by City')</h4>
                                <div class="action-widget__body">
                                    @foreach($citys as $city)
                                        <div class="form-check custom--checkbox">
                                            <input class="form-check-input doctorCity" type="checkbox" name="city_id[]" value="{{$city->id}}" id="{{$city->id}}.'city'"
                                                @if(!empty($cityData))
                                                    @foreach($cityData as $cityVal)
                                                        @if($cityVal == $city->id)
                                                            checked
                                                        @endif
                                                    @endforeach
                                                @endif
                                            >
                                            <label class="form-check-label" for="{{$city->id}}.'city'">{{__($city->name)}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            @php 
                                echo advertisements("380x550")
                            @endphp

                            <div class="action-widget mt-4">
                                <h6 class="action-widget__title">@lang('Filter by Department')</h6>
                                <div class="action-widget__body">
                                    @foreach($departments as $department)
                                        <div class="form-check custom--checkbox">
                                            <input class="form-check-input doctorDepartment" type="checkbox" name="department_id[]" value="{{$department->id}}" id="{{$department->id}}"
                                            @if(!empty($departmentData))
                                                @foreach($departmentData as $departVal)
                                                    @if($departVal == $department->id)
                                                        checked
                                                    @endif
                                                @endforeach
                                            @endif
                                            >
                                            <label class="form-check-label" for="{{$department->id}}">{{__($department->name)}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                             @php 
                                echo advertisements("462x463")
                            @endphp

                        </form>
                    </div>
                </div>

              <div class="col-lg-9">
                <div class="row align-items-center mb-4">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <p>@lang('Showing page'): {{$doctors->firstItem()}} of {{$doctors->lastPage()}}</p>
                    </div>
                    <div class="col-lg-6 col-sm-3 col-7 ms-auto">
                        <form method="GET" action="{{route('doctor.search.filter')}}" class="doctor-list-search">
                            <input type="text" name="search" class="form--control form-control-sm" placeholder="@lang('Search here')">
                            <button><i class="las la-search"></i></button>
                        </form>
                    </div>
                    <div class="col-md-2 col-sm-3 col-5 ms-auto">
                        <div class="card-view-btn-area">
                            <button class="list-view-btn"><i class="las la-bars"></i></button>
                            <button class="grid-view-btn active"><i class="las la-th-large"></i></button>
                        </div>
                    </div>
                </div>

                <div class="row gy-4 card-view-area grid-view">
                    @foreach($doctors as $doctor)
                        <div class="col-xl-4 col-md-6 card-view">
                            <div class="doctor-card">
                                <div class="doctor-card__thumb">
                                    <img src="{{getImage('assets/images/doctor/'. $doctor->image, '352x396')}}" alt="@lang('image')" class="rounded-3">
                                </div>
                                <div class="doctor-card__content">
                                    <div class="details">
                                        <h5 class="name"><a href="{{route('doctor.details', [slug($doctor->name), encrypt($doctor->id)])}}">{{__($doctor->name)}}</a></h5>
                                        <ul class="doctor-info-list">
                                            <li>
                                                <i class="las la-pen-alt"></i>
                                                <span class="text--truncate-1">{{__($doctor->qualification)}}</span>
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
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-5">
                    <div class="col-lg-12">
                        {{$doctors->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection



@push('script')
<script>
    'use strict';
    $('.doctorLocation').on('click', function(){
        this.form.submit();
    });
    $('.doctorCity').on('click', function(){
        this.form.submit();
    });

    $('.doctorDepartment').on('click', function(){
        this.form.submit();
    });
</script>
@endpush
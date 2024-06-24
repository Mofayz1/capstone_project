@extends($activeTemplate.'layouts.frontend')
@section('content')
@php     
    $banner = getContent('banner.content', true); 
@endphp
    <section class="hero bg_img" style="background-image: url({{getImage('assets/images/frontend/banner/'. @$banner->data_values->background_image, '1920x1280')}});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center">
                    <h2 class="hero__title">{{__(@$banner->data_values->heading)}}</h2>
                    <p class="hero__description mt-3">{{__(@$banner->data_values->sub_heading)}}</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="hero-search-wrapper">
                        <form action="{{route('doctor.search')}}" method="GET" class="hero-search-form row align-items-end">
                            <div class="col-lg-3 mt-lg-0 mt-3">
                                <label>@lang('Location')</label>
                                <select class="select2-basic" name="location_id">
                                    <option value="">@lang('Select One')</option>
                                    @foreach($locations as $location)
                                        <option value="{{$location->id}}">{{__($location->name)}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-3 mt-lg-0 mt-3">
                                <label>@lang('City')</label>
                                <select class="select2-basic" name="city_id">
                                    <option value="">@lang('Select One')</option>
                                    @foreach($citys as $city)
                                        <option value="{{$city->id}}">{{__($city->name)}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-4 mt-lg-0 mt-3">
                                <label>@lang('Department')</label>
                                <select class="select2-basic" name="department_id">
                                    <option value="">@lang('Select One')</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{__($department->name)}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-2 text-end mt-lg-0 mt-3">
                                <button type="submit" class="btn btn--base px-xxl-4 px-2">@lang('Search') <i class="las la-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="category-slider">
                        @foreach($departments as $department)
                            <div class="single-slide">
                                <div class="category-card has--link">
                                    <a href="{{route('doctor.department', [slug($department->name), $department->id])}}" class="item--link"></a>
                                    <img src="{{getImage('assets/images/department/'. $department->image, '512x512')}}" alt="@lang('image')">
                                    <h6 class="title">{{__($department->name)}}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @if($sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif
@endsection

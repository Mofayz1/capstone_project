@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $contact = getContent('contact_us.content', true);
@endphp
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-100 pb-100 position-relative z-index">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-lg-0 mt-5">
                <form action="{{route('apply.doctor.store')}}" method="POST" class="contact-form p-sm-5 p-3 section--bg rounded-3 position-relative box--border box--shadow" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>@lang('Name') <sup class="text--danger">*</sup></label>
                            <input type="text" name="name" placeholder="@lang('Full name')" autocomplete="off" value="{{old('name')}}" class="form--control" required="">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>@lang('Appoinment') <sup class="text--danger">*</sup></label>
                            <input type="text" name="appoinment" autocomplete="off" placeholder="@lang('Enter Appoinment Number')" value="{{old('appoinment')}}" class="form--control" required="">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>@lang('Department') <sup class="text--danger">*</sup></label>
                            <select class="form--control" name="department">
                                <option value="" selected="" disabled="">@lang('Select One')</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{__($department->name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label>@lang('Qualification') <sup class="text--danger">*</sup></label>
                            <input type="text" name="qualification" autocomplete="off" value="{{old('qualification')}}" placeholder="@lang('Enter Qualification')" class="form--control" required="">
                        </div>

                        <div class="form-group col-lg-6">
                            <label> @lang('City') <sup class="text--danger">*</sup></label>
                            <select name="city" class="form--control" required="">
                                <option value="" selected="" disabled="">@lang('Select One')</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}" data-locations="{{ json_encode($city->locations) }}">{{__($city->name)}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label> @lang('Location') <sup class="text--danger">*</sup></label>
                            <select name="location" class="form--control" required="">
                                <option value="" selected="" disabled="">@lang('Select One')</option>
                            </select>
                        </div>

                         <div class="form-group col-lg-6">
                            <label>@lang('Email') <sup class="text--danger">*</sup></label>
                            <input type="email" name="email" autocomplete="off" value="{{old('email')}}" placeholder="@lang('Enter Email')" class="form--control" required="">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>@lang('Phone') <sup class="text--danger">*</sup></label>
                            <input type="text" name="phone" autocomplete="off" value="{{old('phone')}}" placeholder="@lang('Enter Phone Number')" class="form--control" required="">
                        </div>

                     

                        <div class="form-group col-lg-12">
                            <label>@lang('Currently Work') <sup class="text--danger">*</sup></label>
                            <input type="text" name="currently_work" autocomplete="off" value="{{old('currently_work')}}" placeholder="@lang('Enter Currently Work')" class="form--control" required="">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>@lang('Specialty') <sup class="text--danger">*</sup></label>
                            <input type="text" name="specialty" autocomplete="off" placeholder="@lang('Enter Specialty')" value="{{old('specialty')}}" class="form--control" required="">
                        </div>


                        <div class="form-group col-lg-6">
                            <label>@lang('Designation') <sup class="text--danger">*</sup></label>
                            <input type="text" name="designation" autocomplete="off" placeholder="@lang('Enter Designation')" value="{{old('designation')}}" class="form--control" required="">
                        </div>

                         <div class="form-group col-lg-6">
                            <label>@lang('Start Time') <sup class="text--danger">*</sup></label>
                            <input type="text" id="timePicker" name="start_time" autocomplete="off" placeholder="@lang('Enter Start Time')" value="{{old('start_time')}}" class="form--control" required="">
                        </div>

                          <div class="form-group col-lg-6">
                            <label>@lang('End Time') <sup class="text--danger">*</sup></label>
                            <input type="text" id="endTimePicker" name="end_time" autocomplete="off" placeholder="@lang('Enter End Time')" value="{{old('end_time')}}" class="form--control" required="">
                        </div>

                         <div class="form-group col-lg-6">
                            <label>@lang('Institute') <sup class="text--danger">*</sup></label>
                            <input type="text" name="institute" autocomplete="off" placeholder="@lang('Enter Institute')" value="{{old('institute')}}" class="form--control" required="">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>@lang('image') <sup class="text--danger">*</sup></label>
                            <input type="file" name="image" class="form--control custom-file-upload" required="">
                        </div>

                        <div class="col-lg-12">
                            <button type="submit" class="btn btn--base">@lang('Submit Now')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'frontend/css/jquery-timepicky.css')}}">
@endpush
@push('script-lib')
    <script src="{{asset($activeTemplateTrue.'frontend/js/jquery-timepicky.js')}}"></script>
@endpush
@push('style')
<style>
    select.form--control{
        border-color: #d8d8d8;
    }
</style>
@endpush


@push('script')
    <script>
        (function($){
            "use strict";
            $("#timePicker").timePicky();
            $("#endTimePicker").timePicky();

            $('select[name=city]').on('change',function() {
                $('select[name=location]').html('<option value="" selected="" disabled="">@lang('Select One')</option>');
                var locations = $('select[name=city] :selected').data('locations');
                var html = '';
                locations.forEach(function myFunction(item, index) {
                    html += `<option value="${item.id}">${item.name}</option>`
                });
                $('select[name=location]').append(html);
            })

        })(jQuery)
    </script>
@endpush



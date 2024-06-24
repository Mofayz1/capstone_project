@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-body">
                	<form action="{{route('admin.doctor.store')}}" method="POST" enctype="multipart/form-data">
                		@csrf
                		<div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview" style="background-image: url({{getImage(imagePath()['doctor']['path'],imagePath()['doctor']['size'])}})">
                                                    <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1" class="bg--success">@lang('Upload Image')</label>
                                                <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg')</b>. @lang('Image will be resized into') {{imagePath()['doctor']['size']}}@lang('px'). </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

	                		<div class="col-lg-8">
		                		<div class="form-group">
		                			<label for="name" class="font-weight-bold">@lang('Name')</label>
		                			<input type="text" name="name" value="{{old('name')}}" class="form-control form-control-lg" placeholder="@lang('Enter Full Name')" maxlength="60" required="">
		                		</div>

                                 <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Department')</label>
                                    <select name="department" class="form-control form-control-lg" required="">
                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{__($department->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('City')</label>
                                    <select name="city" class="form-control form-control-lg" required="">
                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" data-locations="{{ json_encode($city->locations) }}">{{__($city->name)}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                 <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Location')</label>
                                    <select name="location" class="form-control form-control-lg" required="">
                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Appoinment')</label>
                                    <input type="text" name="appoinment" value="{{old('appoinment')}}" class="form-control form-control-lg" placeholder="@lang('Appoinment Number')" maxlength="60" required="">
                                </div>
		                	</div>
		                </div>


                        <div class="row">
                            <div class="col-lg-6">
                               <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Phone')</label>
                                    <input type="text" name="phone" value="{{old('phone')}}" class="form-control form-control-lg" placeholder="@lang('Enter Phone')" maxlength="40" required="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Email')</label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control form-control-lg" placeholder="@lang('Enter Email')" maxlength="60" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Qualification')</label>
                                    <input type="text" name="qualification" value="{{old('qualification')}}" class="form-control form-control-lg" placeholder="@lang('Enter Qualification')" maxlength="255" required="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Currently Work')</label>
                                    <input type="text" name="currently_work" value="{{old('currently_work')}}" class="form-control form-control-lg" placeholder="@lang('Currently work')" maxlength="255" required="">
                                </div>
                            </div>
                        </div>

                         <div class="row">
                             <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Specialty')</label>
                                    <input type="text" name="specialty" value="{{old('specialty')}}" class="form-control form-control-lg" placeholder="@lang('Enter Specialty')" maxlength="255" required="">
                                </div>
                            </div>

                             <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Designation')</label>
                                    <input type="text" name="designation" value="{{old('designation')}}" class="form-control form-control-lg" placeholder="@lang('Enter Designation')" maxlength="60" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Start Time')</label>
                                    <input type="text" id="timePicker" name="start_time" value="{{old('start_time')}}" class="form-control form-control-lg" placeholder="@lang('Enter Start Time')" required="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('End Time')</label>
                                    <input type="text" id="endTimePicker" name="end_time" value="{{old('end_time')}}" class="form-control form-control-lg" placeholder="@lang('Enter End Time')" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Institute')</label>
                                    <input type="text" name="institute" value="{{old('institute')}}" class="form-control form-control-lg" placeholder="@lang('Enter Institute')" maxlength="255" required="">
                                </div>
                            </div>

                             <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('Status') </label>
                                    <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                        data-toggle="toggle" data-on="@lang('Active')" data-off="@lang('Banned')" name="status">
                                </div>
                            </div>
                        </div>

                       	<div class="form-group">
                            <button type="submit" class="btn btn--primary btn-block btn-lg"><i class="fa fa-fw fa-paper-plane"></i> @lang('Create Doctor')</button>
                        </div>
                	</form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <a href="{{route('admin.doctor.index')}}" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="las la-angle-double-left"></i>@lang('Go Back')</a>
@endpush
@push('script-lib')
    <script src="{{asset('assets/admin/js/vendor/jquery-timepicky.js')}}"></script>
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


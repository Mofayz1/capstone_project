@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 mb-30">
            <div class="card">
                <div class="card-body">
                	<form action="{{route('admin.doctor.update', $doctor->id)}}" method="POST" enctype="multipart/form-data">
                		@csrf
                		<div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview" style="background-image: url({{getImage('assets/images/doctor/'. $doctor->image, imagePath()['doctor']['size'])}})">
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
		                			<input type="text" name="name" value="{{__($doctor->name)}}" class="form-control form-control-lg" maxlength="60" required="">
		                		</div>

                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Department')</label>
                                    <select name="department" class="form-control form-control-lg" required="">
                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                        @foreach($departments as $department)
                                            @if($department->id == $doctor->department_id)
                                                <option value="{{$department->id}}" selected="">{{__($department->name)}}</option>
                                            @else
                                                <option value="{{$department->id}}">{{__($department->name)}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('City')</label>
                                    <select name="city" class="form-control form-control-lg" required="">
                                        <option value="" selected="" disabled="">@lang('Select One')</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" data-locations="{{ json_encode($city->locations) }}" @if($city->id == $doctor->city_id) selected @endif>{{__($city->name)}}</option>
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
                                    <input type="text" name="appoinment" value="{{__($doctor->appoinment)}}" class="form-control form-control-lg" maxlength="60" required="">
                                </div>
		                	</div>
		                </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone" class="font-weight-bold">@lang('Phone')</label>
                                    <input type="text" name="phone" value="{{__($doctor->phone)}}" class="form-control form-control-lg" maxlength="40" required="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="font-weight-bold">@lang('Email')</label>
                                    <input type="email" name="email" id="email" value="{{__($doctor->email)}}" class="form-control form-control-lg" maxlength="60" required="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Qualification')</label>
                                    <input type="text" name="qualification" value="{{__($doctor->qualification)}}" class="form-control form-control-lg" maxlength="255" required="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Currently Work')</label>
                                    <input type="text" name="currently_work" value="{{__($doctor->present_work)}}" class="form-control form-control-lg" maxlength="255" required="">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                             <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Specialty')</label>
                                    <input type="text" name="specialty" value="{{__($doctor->specialty)}}" class="form-control form-control-lg" maxlength="255" required="">
                                </div>
                            </div>

                             <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Designation')</label>
                                    <input type="text" name="designation" value="{{__($doctor->designation)}}" class="form-control form-control-lg" maxlength="60" required="">
                                </div>
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Start Time')</label>
                                    <input type="text" id="timePicker" name="start_time" value="{{__($doctor->start_time)}}" class="form-control form-control-lg" required="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('End Time')</label>
                                    <input type="text" id="endTimePicker" name="end_time"  value="{{__($doctor->end_time)}}" class="form-control form-control-lg" required="">
                                </div>
                            </div>
                        </div>

                        

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">@lang('Institute')</label>
                                    <input type="text" name="institute" value="{{__($doctor->institute)}}" class="form-control form-control-lg" maxlength="255" required="">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('Status') </label>
                                    <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                        data-toggle="toggle" data-on="@lang('Active')" @if($doctor->status == 1) checked @endif data-off="@lang('Banned')" name="status">
                                </div>
                            </div>
                        </div>

                       	<div class="form-group">
                            <button type="submit" class="btn btn--primary btn-block btn-lg"><i class="fa fa-fw fa-paper-plane"></i> @lang('Update Doctor')</button>
                        </div>
                	</form>
                </div>
            </div>
        </div>
    </div>

@push('breadcrumb-plugins')
    <a href="{{route('admin.doctor.index')}}" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="las la-angle-double-left"></i>@lang('Go Back')</a>
@endpush

@endsection

@push('script-lib')
    <script src="{{asset('assets/admin/js/vendor/jquery-timepicky.js')}}"></script>
@endpush

@push('script')
    <script>
        (function($){
            "use strict";
            $("#timePicker").timePicky();
            $("#endTimePicker").timePicky();

            $('select[name=city]').change(function() {
                $('select[name=location]').html('<option value="" selected="" disabled="">@lang('Select One')</option>');
                var locations = $('select[name=city] :selected').data('locations');
                var html = '';
                locations.forEach(function myFunction(item, index) {
                    if (item.id == {{ $doctor->location_id }}) {
                        html += `<option value="${item.id}" selected>${item.name}</option>`
                    }else{
                        html += `<option value="${item.id}">${item.name}</option>`
                    }
                });
                $('select[name=location]').append(html);
            }).change();

        })(jQuery)
    </script>
@endpush


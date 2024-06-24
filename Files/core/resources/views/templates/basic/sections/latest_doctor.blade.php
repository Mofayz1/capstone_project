@php
  $doctor = getContent('latest_doctor.content', true);
  $doctors = App\Models\Doctor::where('status', 1)->orderby('id', 'DESC')->limit(12)->get();
@endphp

<section class="pt-100 pb-100 bg_img" style="background-image: url({{getImage('assets/images/frontend/latest_doctor/'. @$doctor->data_values->background_image, '1920x960')}});">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-header">
                    <h2 class="section-title">{{__(@$doctor->data_values->heading)}}</h2>
                    <p class="mt-2">{{__(@$doctor->data_values->sub_heading)}}</p>
                </div>
            </div>
        </div>

        <div class="doctor-slider">
            @foreach($doctors as $doctor)
                <div class="single-slide">
                    <div class="doctor-card">
                        <div class="doctor-card__thumb rounded-3">
                            <img src="{{getImage('assets/images/doctor/'. $doctor->image, '352x396')}}" alt="@lang('image')">
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
                                </ul>
                            </div>
                        </div>
                    </div>
              </div>
            @endforeach
        </div>
        <div class="row mt-5">
            <div class="col-lg-12 text-center">
                <a href="{{route('doctor')}}" class="btn btn--base">@lang('Browse All Doctors')</a>
            </div>
        </div>
    </div>
</section>

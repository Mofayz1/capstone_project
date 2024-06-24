@extends($activeTemplate.'layouts.frontend')
@section('content')
@php
    $contact = getContent('contact_us.content', true);
@endphp
@include($activeTemplate . 'partials.breadcrumb')
<section class="pt-100 pb-100 position-relative z-index">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="single-info d-flex flex-wrap align-items-center">
                    <div class="single-info__icon text-white d-flex justify-content-center align-items-center rounded-3">
                        <i class="las la-map-marked-alt"></i>
                    </div>
                    <div class="single-info__content">
                        <h4 class="title">@lang('Our Address')</h4>
                        <p class="mt-2">{{__($contact->data_values->contact_address)}}</p>
                    </div> 
                </div>
            </div>

            <div class="col-lg-4">
                <div class="single-info d-flex flex-wrap align-items-center">
                    <div class="single-info__icon text-white d-flex justify-content-center align-items-center rounded-3">
                        <i class="las la-envelope"></i>
                    </div>
                    <div class="single-info__content">
                        <h4 class="title">@lang('Email Address')</h4>
                        <p class="mt-2"><a href="mailto:{{__($contact->data_values->email_address)}}" class="text--secondary">{{__($contact->data_values->email_address)}}</a></p>
                    </div> 
                </div>
            </div>

            <div class="col-lg-4">
                <div class="single-info d-flex flex-wrap align-items-center">
                    <div class="single-info__icon text-white d-flex justify-content-center align-items-center rounded-3">
                        <i class="las la-phone-volume"></i>
                    </div>
                    <div class="single-info__content">
                        <h4 class="title">@lang('Phone Number')</h4>
                        <p class="mt-2"><a href="tel:{{__($contact->data_values->contact_phone)}}" class="text--secondary">{{__($contact->data_values->contact_phone)}}</a></p>
                    </div> 
                </div>
            </div>
        </div>
        <div class="row justify-content-center pt-100">
            <div class="col-lg-6">
                <div class="section-header text-center">
                    <span class="subtitle fw-bold text--base font-size--18px border-left">@lang('Contact with us')</span>
                    <h2 class="section-title">{{__($contact->data_values->heading)}}</h2>
                </div>
            </div>
        </div>
        <div class="row gy-4">
            <div class="col-lg-6">
                <div class="contact-map">
                    <iframe src = "https://maps.google.com/maps?q={{__($contact->data_values->latitude)}},{{__($contact->data_values->longitude)}}&hl=es;z=14&amp;output=embed"></iframe>
                </div>
            </div>
            <div class="col-lg-6">
                <form class="contact-form rounded-3 position-relative box--border" action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>@lang('Name') <sup class="text--danger">*</sup></label>
                            <input type="text" name="name" placeholder="@lang('Full name')" autocomplete="off" class="form--control" required="">
                        </div>
                        <div class="form-group col-lg-12">
                            <label>@lang('Email') <sup class="text--danger">*</sup></label>
                            <input type="email" name="email" autocomplete="off" placeholder="@lang('Email address')" class="form--control" required="">
                        </div>
                        <div class="form-group col-lg-12">
                            <label>@lang('Subject') <sup class="text--danger">*</sup></label>
                            <input type="text" name="subject" autocomplete="off" placeholder="@lang('Enter Subject')" class="form--control" required="">
                        </div>

                        <div class="form-group col-lg-12">
                            <label>@lang('Message') <sup class="text--danger">*</sup></label>
                            <textarea name="message" placeholder="@lang('Your message')" class="form--control" required=""></textarea>
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

@if($sections->secs != null)
    @foreach(json_decode($sections->secs) as $sec)
        @include($activeTemplate.'sections.'.$sec)
    @endforeach
@endif
@endsection



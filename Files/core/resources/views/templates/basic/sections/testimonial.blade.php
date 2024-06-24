@php
    $testimonial = getContent('testimonial.content', true);
    $testimonialElements = getContent('testimonial.element', false);
@endphp
<section class="pt-100 pb-100 section--bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-header text-center">
                    <h2 class="section-title">{{__(@$testimonial->data_values->heading)}}</h2>
                    <p class="mt-3">{{__(@$testimonial->data_values->sub_heading)}}</p>
                </div>
            </div> 
        </div>

        <div class="testimonial-slider">
            @foreach($testimonialElements as $value)
                <div class="single-slide">
                    <div class="testimoninal-card">
                        <div class="testimoninal-card__content">
                            <p class="description">{{__($value->data_values->testimonial)}}</p>
                        </div>
                        <div class="testimoninal-card__footer d-flex flex-wrap">
                            <div class="left">
                                <h6 class="name mt-2 text-white">{{__($value->data_values->name)}}</h6>
                                <p class="designation fst-italic text-white">{{__($value->data_values->designation)}}</p>
                            </div>
                            <div class="thumb">
                                <img src="{{getImage('assets/images/frontend/testimonial/'. $value->data_values->client_image, '257x303')}}" alt="@lang('Client Image')">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
    
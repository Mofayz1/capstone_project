@php
    $cta = getContent('cta.content', true);
@endphp

<section class="cta-section bg_img" style="background-image: url({{getImage('assets/images/frontend/cta/'. @$cta->data_values->background_image, '1920x550')}});">
    <div class="container">
        <div class="cta-wrapper">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6 text-lg-start text-center">
                    <h2 class="title">{{__(@$cta->data_values->heading)}}</h2>
                    <p class="mt-3">{{__(@$cta->data_values->sub_heading)}}</p>
                </div>
                <div class="col-lg-4 text-lg-end text-center mt-lg-0 mt-4">
                    <a href="{{url(@$cta->data_values->button_url)}}" class="btn btn--base">{{__(@$cta->data_values->button_name)}}</a>
                </div>
            </div>
        </div>
    </div>
</section>
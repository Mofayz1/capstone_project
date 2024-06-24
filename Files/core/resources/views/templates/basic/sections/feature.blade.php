@php
    $features = getContent('feature.element', false);
@endphp
<section class="pt-100 pb-100 feature-section">
    <div class="container">
        <div class="row gy-5 justify-content-center">
            @foreach($features as $feature)
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-card__icon">
                            <img src="{{getImage('assets/images/frontend/feature/'. $feature->data_values->feature_image, '128x128')}}" alt="@lang('Feature Image')">
                        </div>
                        <div class="feature-card__content mt-4">
                            <h4 class="title mb-3">{{__($feature->data_values->heading)}}</h4>
                            <p>{{__($feature->data_values->sub_heading)}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

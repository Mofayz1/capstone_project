@php
    $work = getContent('how_to_work.content', true);
    $workElements = getContent('how_to_work.element', false, null, true);
@endphp

<section class="pt-100 pb-100 ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-header text-center">
                    <h2 class="section-title">{{__(@$work->data_values->heading)}}</h2>
                    <p class="mt-2">{{__(@$work->data_values->sub_heading)}}</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center gy-5">
            @foreach($workElements as $value)
                <div class="col-lg-4 col-sm-6 work-card-item">
                    <div class="work-card text-center">
                        <div class="work-card__icon">
                            <img src="{{getImage('assets/images/frontend/how_to_work/'. $value->data_values->work_image, '128x128')}}" alt="@lang('Image')">
                            <span class="step">{{$loop->iteration}}</span>
                        </div>
                        <div class="work-card__content">
                            <h4 class="title">{{__($value->data_values->heading)}}</h4>
                            <p>{{__($value->data_values->sub_heading)}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div> 
</section>

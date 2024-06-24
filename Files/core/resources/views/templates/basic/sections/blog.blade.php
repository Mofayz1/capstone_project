@php
    $blog = getContent('blog.content', true);
    $blogElements = getContent('blog.element', false, 3, true);
@endphp

<section class="pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-header text-center">
                    <h2 class="section-title">{{__(@$blog->data_values->heading)}}</h2>
                    <p class="mt-3">{{__(@$blog->data_values->sub_heading)}}</p>
                </div>
            </div> 
        </div>

        <div class="row gy-4 justify-content-center">
            @foreach($blogElements as $value)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                    <div class="post-card">
                        <div class="post-card__thumb">
                            <img src="{{getImage('assets/images/frontend/blog/'. $value->data_values->blog_image, '626x430')}}" alt="@lang('Blog Image')">
                            <span class="post-card__date"><i class="las la-calendar"></i> {{showDateTime($value->created_at, 'd M Y')}}</span>
                        </div>
                        <div class="post-card__content">
                            <h5 class="post-card__title mb-3"> 
                                <a href="{{ route('blog.details',[$value->id,slug($value->data_values->title)]) }}">{{__($value->data_values->title)}}</a></h5>
                            <p>{{str_limit(strip_tags($value->data_values->description_nic), 80)}}</p>
                            <a href="{{ route('blog.details',[$value->id,slug($value->data_values->title)]) }}" class="read-more mt-2">@lang('Read More')</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
    
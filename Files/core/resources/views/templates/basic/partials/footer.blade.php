
@php
    $footer = getContent('footer.content', true);
    $footer_menu = getContent('policy_pages.element', false);
    $socialIcons = getContent('social_icon.element', false);
    $contact = getContent('contact_us.content', true);
    $cookie = App\Models\Frontend::where('data_keys','cookie.data')->first();
@endphp
{{--
@if(@$cookie->data_values->status && !session('cookie_accepted'))
    <div class="cookie__wrapper ">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-between">
            <p class="txt my-2">
               @php echo @$cookie->data_values->description @endphp
              <a href="{{ @$cookie->data_values->link }}" target="_blank">@lang('Read Policy')</a>
            </p>
              <a href="javascript:void(0)" class="btn btn--base my-2 policy">@lang('Accept')</a>
          </div>
        </div>
    </div>
 @endif --}}

<footer class="footer bg_img" style="background-image: url({{getImage('assets/images/frontend/footer/'. @$footer->data_values->background_image, '1920x768')}});">
    <div class="footer__top">
        <div class="container">
            <div class="footer-action-wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-action-single text-md-start text-center">
                            <h4 class="title mb-3">@lang('Need help')?</h4>
                            <div class="call-item">
                                <div class="icon">
                                    <i class="las la-phone-volume"></i>
                                </div>
                                <div class="content text-start">
                                    <p>@lang('Call Us')</p>
                                    <a href="tel:{{__(@$contact->data_values->contact_phone)}}" class="number">{{__(@$contact->data_values->contact_phone)}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-md-0 mt-4">
                        <div class="footer-action-single">
                            <h4 class="title mb-3 text-md-start text-center">{{__($footer->data_values->title)}}</h4>
                            <form class="subscribe-form">
                                <input type="email" name="email" id="emailSub" placeholder="@lang('Enter email address')" autocomplete="off" class="form--control">
                                <button type="button" class="subscribe-btn"><i class="las la-envelope"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row gy-5 justify-content-between">
                <div class="col-lg-4 col-md-6 orde-1">
                    <div class="footer-widget">
                        <a href="{{route('home')}}">Footer</a>
                        <p class="mt-3">{{__($footer->data_values->heading)}}</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 order-lg-2 order-3">
                    <div class="footer-widget">
                        <h4 class="footer-widget__title">@lang('Short Links')</h4>
                        <ul class="link-list">
                            @foreach($pages as $k => $data)
                                <li><a href="{{route('pages',[$data->slug])}}">{{__($data->name)}}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- footer-widget end -->
                </div>
                <div class="col-lg-2 col-md-6 order-lg-3 order-4">
                    <div class="footer-widget">
                        <h4 class="footer-widget__title">@lang('Help Link')</h4>
                        <ul class="link-list">
                            <li><a href="{{route('apply.doctor')}}">@lang('Apply as a Doctor')</a></li>
                            @foreach($footer_menu as $value)
                                <li>
                                    <a href="{{route('footer.menu', [slug($value->data_values->title), $value->id])}}">{{__($value->data_values->title)}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div><!-- footer-widget end -->
                </div>

                <div class="col-lg-3 col-md-6 order-lg-4 order-2">
                    <div class="footer-widget">
                        <h4 class="footer-widget__title">@lang('Contact Information')</h4>
                        <p><b>@lang('Office Address')</b> : {{__(@$contact->data_values->contact_address)}}</p>
                        <ul class="social-link-list mt-3">
                           @foreach($socialIcons as $socialIcon)
                                <li>
                                    <a href="{{$socialIcon->data_values->url}}" target="__blank">@php echo $socialIcon->data_values->social_icon @endphp</a>
                                </li>
                            @endforeach
                        </ul>
                    </div><!-- footer-widget end -->
                </div>
            </div><!-- row end -->
        </div>
    </div><!-- footer__top end -->
    <div class="footer__bottom">
        <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
            <p>@lang('Copyrights') © {{Carbon\Carbon::now()->format('Y')}} by <a href="{{route('home')}}" class="text--base">Developer</a>. @lang('All Rights Reserved').</p>
        </div>
    </div>
</div>
</div>
</footer>

@push('script')
<script>
    (function () {
        'use strict';
        $(document).on('click','.subscribe-btn' , function(){
            var email = $("#emailSub").val();
            if(email){
                $.ajax({
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}",},
                    url:"{{ route('subscribe') }}",
                    method:"POST",
                    data:{email:email},
                    success:function(response)
                    {
                        if(response.success) {
                            notify('success', response.success);
                            $("#emailSub").val('');
                        }else{
                            $.each(response, function (i, val) {
                                notify('error', val);
                            });
                        }
                    }
                });
            }
            else{
                notify('error', "Please Input Your Email");
            }
        });

        $('.policy').on('click',function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.get('{{route('cookie.accept')}}', function(response){
                $('.cookie__wrapper').addClass('d-none');
                iziToast.success({message: response, position: "topRight"});
            });
        });
    })();
</script>
@endpush
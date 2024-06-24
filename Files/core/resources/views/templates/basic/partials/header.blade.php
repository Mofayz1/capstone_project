@php
     $contact = getContent('contact_us.content', true);
@endphp
 <header class="header">
    <div class="header__top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-sm-10">
                    <ul class="header-info-list justify-content-sm-start justify-content-center">
                        <li>
                            <a href="tel:{{__(@$contact->data_values->contact_phone)}}"><i class="las la-phone-volume"></i>{{__(@$contact->data_values->contact_phone)}}</a>
                        </li>
                        <li>
                            <a href="mailto:{{__($contact->data_values->email_address)}}"><i class="las la-envelope"></i> {{__($contact->data_values->email_address)}}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-2 mt-sm-0 mt-2">
                    <div class="d-flex flex-wrap align-items-center justify-content-sm-end justify-content-center">
                        <select name="site-language" class="language-select langSel">
                            @foreach($language as $item)
                                <option value="{{$item->code}}" @if(session('lang') == $item->code) selected  @endif>{{ __($item->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header__bottom">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-xl p-0 align-items-center justify-content-between">
                <a class="site-logo site-title" href="{{route('home')}}">Logo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="menu-toggle"></span>
                </button>
                <div class="collapse navbar-collapse mt-xl-0 mt-3" id="navbarSupportedContent">
                    <ul class="navbar-nav main-menu ms-auto">
                        <li><a href="{{route('home')}}">@lang('Home')</a></li>
                        @foreach($pages as $k => $data)
                            <li><a href="{{route('pages',[$data->slug])}}">{{__($data->name)}}</a></li>
                        @endforeach
                    </ul>
                    <div class="nav-right">
                        <a href="{{route('apply.doctor')}}" class="btn btn-md btn--base">@lang('Apply as a Doctor')</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>
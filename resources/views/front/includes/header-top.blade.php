<div class="header-top hidden-sm-down">
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="header-top-left col-lg-6 col-md-6 d-flex justify-content-start align-items-center">
                    <div class="detail-email d-flex align-items-center justify-content-center">
                        @auth()
                            <p> {{__('site/auth.name')}} : </p>
                            <span>
                            <a class="text-bold-800 grey darken-2" href=""> &nbsp; {{auth()->user()->name}}</a>
                        @endauth
                </span>
                    </div>
                    <div class="detail-call d-flex align-items-center justify-content-center">
                        <i class="icon-deal"></i>
                        <p> &nbsp; {{__('site/home.today deals')}}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 d-flex justify-content-end align-items-center header-top-right">
                    <div class="register-out">
                        <i class="zmdi zmdi-account"></i>
                        @guest()
                            <a class="register" href="{{route('register')}}"
                               data-link-action="display-register-form">
                                &nbsp; {{__('site/auth.register')}}
                            </a>
                            <span class="or-text">{{__('site/home.or')}}</span>
                            <a class="login" href="{{route('login')}}" rel="nofollow"
                               title="Log in to your customer account">{{__('site/auth.sign in')}}</a>
                        @endguest
                        @auth()


                            <a href="{{route('logout')}}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                &nbsp; {{__('site/auth.logout')}}
                            </a>

                            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                        @endauth
                    </div>
                    <div id="_desktop_currency_selector"
                         class="currency-selector groups-selector hidden-sm-down currentcy-selector-dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                             role="main">
                            <span class="expand-more">GBP</span>
                        </div>
                        <div class="currency-list dropdown-menu">
                            <div class="currency-list-content text-left">
                                <div class="currency-item current flex-first">
                                    <a title="British Pound" rel="nofollow"
                                       href="index-1.htm?home=home_3&amp;SubmitCurrency=1&amp;id_currency=1">£ GBP</a>
                                </div>
                                <div class="currency-item">
                                    <a title="US Dollar" rel="nofollow"
                                       href="index-2.htm?home=home_3&amp;SubmitCurrency=1&amp;id_currency=2">$ USD</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="_desktop_language_selector"
                         class="language-selector groups-selector hidden-sm-down language-selector-dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                             role="main">
                            <span class="expand-more">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                        </div>
                        <div class="language-list dropdown-menu">
                            <div class="language-list-content lang_text_direction">
                                <div class="language-item current flex-first">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        @if($localeCode == 'ar')
                                            <hr> @endif
                                        <div class="current">
                                            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                <span>{{ $properties['native'] }}</span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@extends('layouts.site')

@section('content')
    <nav data-depth="1" class="breadcrumb-bg">
        <div class="container no-index">
            <div class="breadcrumb">

                <ol itemscope="" itemtype="http://schema.org/BreadcrumbList" class="lang_text_direction">
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a itemprop="item" href="{{route('home')}}">
                            <span itemprop="name">{{__('site/auth.home')}}</span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>
                </ol>
            </div>
        </div>
    </nav>
    <div class="container no-index">
        <div class="row">
            <div id="content-wrapper" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div id="main">
                    <div class="page-header">
                        <h1 class="page-title hidden-xs-up">
                            {{__('site/auth.enter code')}}
                        </h1>
                    </div>
                    <section id="content" class="page-content">
                        <section class="login-form">
                            <form method="POST" action="{{route('verified.user')}}">
                                @csrf
                                <section>
                                    <div class="form-group row no-gutters">
                                        <label class="col-md-2 form-control-label mb-xs-5 required">
                                            {{__('site/auth.verification code')}} :
                                        </label>
                                        <div class="col-md-4">
                                            <input class="form-control" name="code"
                                                   type="text" required="">
                                            @error('code')
                                            <span class="invalid-feedback text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <footer class="form-footer clearfix">
                                            <div class="row no-gutters">
                                                <div class="col-md-10 offset-md-2">
                                                    <input type="hidden" name="submitLogin" value="1">
                                                    <button class="btn btn-primary" data-link-action="sign-in"
                                                            type="submit"
                                                            class="form-control-submit">
                                                        {{__('site/auth.confirm')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </footer>
                                    </div>
                                </section>
                            </form>
                        </section>
                        <footer class="page-footer">
                            <!-- Footer content -->
                        </footer>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <br>
@stop


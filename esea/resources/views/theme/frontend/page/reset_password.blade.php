@extends('theme.layout.frontend.main')

@section('content')
    <div class="main-section-copy">
        <div class="main-container-copy w-container">
            <div class="div-block-2-column-neewew-2" id="reset_main">
                <div class="div-block-97-copy">
                    <div>
                        <div class="text-block-21-copy">- {{trans('front.homepage.resetpass.title')}} -</div>


                       <div class="alert alert-danger" role="alert" style="display:none"></div>

                        <div class="div-block-80-copy">
                            <div class="w-form">
                                <form id="form-reset-account" name="email-form" data-name="Email Form" role="form" data-toggle="validator">
                                  <label class="field-label">Email <strong class="bold-text-12">*</strong></label>
                                  <div class="form-group">
                                    <input type="email" id="email" name="email" maxlength="64" class="text-field w-input"
                                           required data-required-error="{{trans('front.homepage.resetpass.erremail')}}."
                                           data-type-error="{{trans('front.homepage.resetpass.erremail2')}}." >
                                    <div class="help-block with-errors"></div>
                                  </div>
                                  <div class="form-group">
                                    {!! Recaptcha::render() !!}
                                  </div>
                                  <a href="#" class="link-block-7 w-inline-block btn-reset" style="width:100%">
                                    <div class="text-block-41">{{trans('front.homepage.resetpass.reset')}}</div>
                                  </a>
                                  <div class="div-block-98">
                                    <span class="link-16">{{trans('front.homepage.signup.already')}}</span>
                                  <a href="{{asset('login')}}" class="link-block-16 w-inline-block">
                                      <div class="button-2new">{{trans('front.homepage.signin.login')}}</div>
                                    </a>
                                  </div>
                                </form>
                              </div>
                        </div>
                        
                    </div>
                </div>
                <div class="login-photo"></div>
            </div>

            <div class="div-block-2-column-neewew-2" id="reset_ty" style="display:none">
                    <div class="div-block-97-copy">
                        <h2>{{trans('front.homepage.resetpass.request')}}</h2>
                        <p>{{trans('front.homepage.resetpass.newpass')}}</p>
                        <div>
                            <a href="{{asset('/')}}" class="link-block-7-copy w-inline-block">
                                <div class="text-block-41">{{trans('front.homepage.resetpass.return')}}</div>
                            </a>
                        </div>
                    </div>
                </div>

        </div>
    </div>
    <div class="section-email-enter">
        <div class="container w-container">
            @include('theme.frontend.section.homepage.subscribe')
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('assets/frontend/js/reset-password.js')}}" type="text/javascript"></script>
@endsection
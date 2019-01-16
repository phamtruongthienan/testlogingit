@extends('theme.layout.frontend.main')

@section('content')
    <div class="main-section-copy">
        <div class="main-container-copy w-container">
            <div class="div-block-2-column-neewew-2">
                <div class="div-block-97-copy">
                    <h2>{{trans('front.homepage.login.loginh2')}}</h2>
                    <p>{{trans('front.homepage.login.loginp')}}</p>
                    <div>
                        <a href="{{asset('/login/facebook')}}" class="link-block-7 w-inline-block">
                            <div class="div-block-94"></div>
                            <div class="text-block-41">{{trans('front.homepage.signup.loginwithfb')}}</div>
                        </a>
                        <a href="{{asset('/login/google')}}" class="link-block-7-copy w-inline-block">
                            <div class="div-block-94-copy"></div>
                            <div class="text-block-41">{{trans('front.homepage.signup.loginwithgg')}}</div>
                        </a>
                    </div>
                    <div>
                        <div class="text-block-21-copy">- {{trans('front.homepage.signin.loginwithemail')}} -</div>

                        @if ( $errors->count() > 0 )
                            @foreach( $errors->all() as $message )
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @endforeach
                        @endif
                        <div class="div-block-80-copy">
                            <div class="w-form">
                            <form id="login-form" method="POST" action="{{asset('login')}}" name="login-form" data-name="Login Form" role="form" data-toggle="validator">
                                            @if(!empty(request()->ref))
                                            <input type="hidden" value="{{request()->ref}}" name="ref">
                                            @endif
                                            <label class="field-label">Email <strong class="bold-text-12">*</strong></label>
                                            <div class="form-group">
                                              <input type="email" id="email" name="email" maxlength="64" class="text-field w-input"
                                                     required data-required-error="{{trans('front.homepage.login.erremail')}} "
                                                     data-type-error="{{trans('front.homepage.login.erremail2')}}" >
                                              <div class="help-block with-errors"></div>
                                            </div>
                                            <label class="field-label">{{trans('front.homepage.login.pass')}}  <strong class="bold-text-12">*</strong></label>
                                            <div class="form-group">
                                                <input type="password" id="password" name="password" minlength="6" maxlength="20" class="text-field w-input"
                                                      required data-required-error="{{trans('front.homepage.login.errpass')}} " >
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            {!! csrf_field() !!}
                                            <button type="submit" class="link-block-7 w-inline-block" style="width:100%">
                                                <div class="text-block-41">{{trans('front.homepage.login.login')}}</div>
                                            </button>
                                            <div class="div-block-98">
                                                <a href="{{asset('reset-password')}}" class="link-16">{{trans('front.homepage.signin.forgotpass')}}</a>
                                              </div>
                                          </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="login-photo"></div>
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
    <script src="{{asset('assets/frontend/js/login.js')}}" type="text/javascript"></script>
@endsection
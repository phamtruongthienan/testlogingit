@extends('theme.layout.frontend.main')

@section('content')
    <div class="main-section-copy">
        <div class="main-container-copy w-container">
            <div class="div-block-2-column-neewew-2" id="signup_main">
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
                        <div class="text-block-21-copy">{{trans('front.homepage.signup.createwithemail')}}</div>


                       <div class="alert alert-danger" role="alert" style="display:none"></div>

                        <div class="div-block-80-copy">
                            <div class="w-form">
                                <form id="form-create-account" name="email-form" data-name="Email Form" role="form" data-toggle="validator">
                                  <label class="field-label">Email <strong class="bold-text-12">*</strong></label>
                                  <div class="form-group">
                                    <input type="email" id="email" name="email" maxlength="64" class="text-field w-input"
                                           required data-required-error="{{trans('front.homepage.login.erremail')}}"
                                           data-type-error="{{trans('front.homepage.login.erremail')}}" >
                                    <div class="help-block with-errors"></div>
                                  </div>
                                  <label class="field-label">{{trans('front.homepage.signup.phone')}} <strong class="bold-text-12">*</strong></label>
                                  <div class="form-group">
                                    <input type="text" id="phone" name="phone" maxlength="20" class="text-field w-input"
                                           required data-required-error="{{trans('front.homepage.signup.errphone')}}" >
                                    <div class="help-block with-errors"></div>
                                  </div>
                                  <label class="field-label">{{trans('front.homepage.signup.pass')}} <strong class="bold-text-12">*</strong></label>
                                  <div class="form-group">
                                      <input type="password" id="password" name="password" minlength="6" maxlength="20" class="text-field w-input"
                                            required data-required-error="{{trans('front.homepage.signup.errpass')}}" >
                                      <div class="help-block with-errors"></div>
                                  </div>
                                  <label class="field-label">{{trans('front.homepage.signup.confirm')}} <strong class="bold-text-12">*</strong></label>
                                  <div class="form-group">
                                    <input type="password" id="repassword" name="repassword" minlength="6" maxlength="20" class="text-field w-input"
                                        data-match="#password" data-match-error="{{trans('front.homepage.signup.errconfirm')}}" required data-required-error="{{trans('front.homepage.signup.errconfirm2')}}">
                                    <div class="help-block with-errors"></div>
                                  </div>
                                  <label class="field-label">{{trans('front.homepage.signup.fullname')}} <strong class="bold-text-12">*</strong></label>
                                  <div class="form-group">
                                    <input type="text" id="name" name="name" minlength="3" maxlength="100" class="text-field w-input"
                                           required data-required-error="{{trans('front.homepage.signup.errfullname')}}" >
                                    <div class="help-block with-errors"></div>
                                  </div>
                                  <div class="form-group">
                                        <div class="pretty p-default p-curve p-thick checkbox-field-3 w-checkbox">
                                            <input type="checkbox" name="checkagree"/>
                                            <div class="state p-danger-o">
                                                <label>I agree to Esearch&#x27;s <a href="#" rel="noreferrer" target="_blank" class="link-15">Terms of Use</a> and <a href="#" rel="noreferrer" target="_blank" class="link-15">Privacy Policy</a>.</label>
                                            </div>
                                        </div>
                                    <div class="help-block with-errors"></div>
                                  </div>
                                  <a href="#" class="link-block-7 w-inline-block btn-create" style="width:100%">
                                    <div class="text-block-41">{{trans('front.homepage.subscribe.button')}}</div>
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

            <div class="div-block-2-column-neewew-2" id="signup_ty" style="display:none">
                    <div class="div-block-97-copy">
                        <h2>Đăng ký thành công</h2>
                        <p>Bạn có thể cập nhật thêm thông tin tài khoản hoặc để sau.</p>
                        <div>
                            <a href="{{asset('/account')}}" class="link-block-7 w-inline-block">
                                <div class="text-block-41">Cập nhật thông tin tài khoản</div>
                            </a>
                            <a href="{{asset('/')}}" class="link-block-7-copy w-inline-block">
                                <div class="text-block-41">Trở về trang chủ</div>
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
    <script src="{{asset('assets/frontend/js/sign-up.js')}}" type="text/javascript"></script>
@endsection
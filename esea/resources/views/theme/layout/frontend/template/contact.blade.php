<div class="main-section">
    <div class="main-container w-container">
        <div class="div-block-breadcumb"><a href="index.html" class="link-breadcumb-2">Home</a>
            <div class="div-block-24"></div>
            <a href="{{asset('/'.$view->slug)}}" class="link-breadcumb-now-2 w--current">{{$view->title}}</a></div>
        <div class="div-block-2-column-copy-copy">
            <div class="div-block-97">
                <div class="div-block-1212">
                    <div class="row">
                        <div class="col-12">
                            {!!$view->content!!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="child-2">
                <div class="boder">
                    <div>
                        <h3 class="heading-11">VIETLABO COMPANY INC</h3>
                        <div class="div-block-92">
                            <div class="div-block-icon _1"></div>
                            <div class="text-block-38">{{trans('front.homepage.contact.address')}}:</div>
                        </div>
                        <a href="#" class="link-12">Waseco building, 10 Pho Quang, ward 2, district Tan Binh, HCMC,
                            Vietnam</a>
                        <div class="row-15 w-row">
                            <div class="w-col w-col-4">
                                <div class="div-block-92">
                                    <div class="div-block-icon _2"></div>
                                    <div class="text-block-38">Email</div>
                                </div>
                                <a href="#" class="link-12">contact@aris-vn.com</a></div>
                            <div class="column-16 w-col w-col-4">
                                <div class="div-block-92">
                                    <div class="div-block-icon _3"></div>
                                    <div class="text-block-38">{{trans('front.homepage.contact.phone')}}</div>
                                </div>
                                <a href="#" class="link-12">(+84) 28 38424483</a></div>
                            <div class="w-col w-col-4">
                                <div class="div-block-92">
                                    <div class="div-block-icon _4"></div>
                                    <div class="text-block-38">Fax</div>
                                </div>
                                <a href="#" class="link-12">(+84) 28 38424473</a></div>
                        </div>
                    </div>
                </div>
                <div class="form-block-8 w-form">
                    <form id="form-contact" name="form-contact" data-name="Email Form" role="form"
                          data-toggle="validator">
                        <label for="name-2" class="field-label">{{trans('front.homepage.contact.youremail')}} <strong
                                    class="bold-text-12">*</strong></label>
                        <div class="form-group">
                            <input type="text" id="emailContact" name="emailContact" maxlength="256"
                                   class="text-field w-input" required data-required-error="{{trans('front.homepage.contact.erroryouremail')}}">
                            <div class="help-block with-errors"></div>
                        </div>
                        <label class="field-label">{{trans('front.homepage.contact.youneed')}}  <strong
                                    class="bold-text-12">*</strong><br></label>
                        <div class="form-group">
                            <select id="selectContact" name="selectContact" class="select-field w-select" required
                                    data-required-error="{{trans('front.homepage.contact.erroryouneed')}}">
                                <option value="">Select one...</option>
                                <option value="1">First Choice</option>
                                <option value="2">Second Choice</option>
                                <option value="4">Third Choice</option>
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                        <label class="field-label">{{trans('front.homepage.contact.subject')}}  <strong class="bold-text-12">*</strong><br></label>
                        <div class="form-group">
                            <input type="text" id="subjectContact" name="subjectContact" maxlength="256"
                                   class="text-field w-input" required data-required-error="{{trans('front.homepage.contact.errorsubject')}}">
                            <div class="help-block with-errors"></div>
                        </div>
                        <label class="field-label">{{trans('front.homepage.contact.message')}}  <strong class="bold-text-12">*</strong><br></label>
                        <div class="form-group">
                            <textarea id="messageContact" name="messageContact" maxlength="5000" class="textarea-2 w-input" required
                                      data-required-error="{{trans('front.homepage.contact.errormessage')}}"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="col-lg-7 col-xl-7 col-md-7 col-sm-12 col-12">
                            <div class="widget-area no-padding blank">
                                <div class="status-upload form-group">
                                        <div>
                                        <div style="margin-top: 10px;float: left;">{!! Recaptcha::render() !!}</div>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <input value="{{trans('front.homepage.contact.submit')}}" data-wait="Please wait..." class="button-2 w-button" id="sendContactBtn">
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script src="{{asset('assets/frontend/js/contact.js')}}" type="text/javascript"></script>
@endsection
<div class="div-block-1275">
    <div class="text-block-97" style="text-shadow: 2px 4px 3px rgba(0,0,0,0.3);;background: rgba(0,0,0,0.4);padding: 20px;">{{mb_strtoupper($school_detail[0]->mSchooltranslations[0]->slogan)}}</div>
    <a class="button-13 w-button btn-booking" 
    style="background-image: linear-gradient(45deg, #f04e23, #ffd600), linear-gradient(180deg, #f04e23, #f04e23);background-color: unset !important;" data-toggle="modal" data-target="#booking">{{trans('front.homepage.intro.booking')}}</a>
</div>


<div data-delay="4000" data-animation="slide" data-autoplay="1" data-duration="500" data-infinite="1"
     class="slider-7 w-slider w-slider-banner">
    <div class="w-slider-mask">
        @foreach($school_detail[0]->mSchoolimages as $key => $val)
            @if($val->is_cover == 1)

                <div class="w-slider-mask-item">
                    <div class="w-slide" style="background-image:url({{asset('img/'.$val->image)}});background-position: center;background-size: cover;"></div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="left-arrow w-slider-arrow-left">
        <div class="w-icon-slider-left"></div>
    </div>
    <div class="right-arrow w-slider-arrow-right">
        <div class="w-icon-slider-right"></div>
    </div>
    <div class="w-slider-nav w-round"></div>
</div>

<div class="modal" id="booking">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
            <h4 class="modal-title">{{$school_detail[0]->mSchooltranslations[0]->name}}</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="div-block-80-copy">
              <div class="w-form">
                <form id="bookingForm" name="bookingForm" data-name="Email Form">
                    <input type="hidden" id="dateBooking" name="dateBooking">
                    <input type="hidden" id="schoolId" name="schoolId" value="{{$school_detail[0]->id}}">
                    @if(!Auth::check())
                        <div class="div-block-book-school" style="margin-top:0px; padding-top:0px">
                            <a href="forget-password.html" class="link-16">You have an account? Login to book this school</a>
                            <a href="{{asset('login')}}" class="link-block-13 w-inline-block">
                            <div class="button-2new">Login</div>
                            </a>
                        </div>
                        <label for="name-3" class="field-label">Or fill this form<br></label>
                        <label for="bookingName" class="field-label">Your name <strong class="bold-text-25">*</strong><br></label>
                        <input type="text" id="bookingName" name="bookingName" data-name="Name 2" maxlength="256" class="text-field w-input">
                        <label for="bookingPhone" class="field-label">Your Phone <strong class="bold-text-25">*</strong><br></label>
                        <input type="text" id="bookingPhone" name="bookingPhone" data-name="Name 2" maxlength="256" class="text-field w-input">
                        <label for="bookingEmail-3" class="field-label">Your email <strong class="bold-text-25">*</strong><br></label>
                        <input type="text" id="bookingEmail" name="bookingEmail" data-name="Name 2" maxlength="256" class="text-field w-input">
                    @else
                        <label for="name-3" class="field-label">Or fill this form<br></label>
                        <label for="bookingName" class="field-label">Your name <strong class="bold-text-25">*</strong><br></label>
                        <input type="text" id="bookingName" name="bookingName" data-name="Name 2" maxlength="256" class="text-field w-input" value="{{Auth::user()->name}}">
                        <label for="bookingPhone" class="field-label">Your Phone <strong class="bold-text-25">*</strong><br></label>
                        <input type="text" id="bookingPhone" name="bookingPhone" data-name="Name 2" maxlength="256" class="text-field w-input" value="{{Auth::user()->phone}}">
                        <label for="bookingEmail-3" class="field-label">Your email <strong class="bold-text-25">*</strong><br></label>
                        <input type="text" id="bookingEmail" name="bookingEmail" data-name="Name 2" maxlength="256" class="text-field w-input" value="{{Auth::user()->email}}">
                    @endif
                  <div class="div-block-1208">
                    <div class="div-block-1210">
                        <label for="bookingDate" class="field-label">Select a date <strong class="bold-text-12">*</strong><br></label>
                        <div class="div-block-85">
                            <div class="w-embed">
                                <input type='text' class="form-control" id="datetimepicker"/>
                            </div>
                        </div>
                    </div>
                  </div>
                    <label for="bookingMessage" class="field-label">Your message<br></label>
                    <textarea id="bookingMessage" name="bookingMessage" maxlength="5000" class="textarea-2 w-input"></textarea>
                  <div class="checkbox-field w-checkbox"><input type="checkbox" id="checkbox-2" name="checkbox-2" data-name="Checkbox 2" class="checkbox w-checkbox-input"><label for="checkbox-2" class="checkbox-label-copy w-form-label">I agree with my booking form</label></div>
                  <div class="div-block-98">
                    <input type="button" value="Submit" data-wait="Please wait..." class="button-2new w-button" id="bookingBtn">
                  </div>
                </form>
                <div class="w-form-done">
                  <div>Thank you! Your submission has been received!</div>
                </div>
                <div class="w-form-fail">
                  <div>Oops! Something went wrong while submitting the form.</div>
                </div>
              </div>
            </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
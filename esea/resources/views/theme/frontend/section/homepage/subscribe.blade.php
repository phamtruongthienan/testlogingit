<div class="div-block-49">
    <h3 class="heading-8">{!!trans('front.homepage.subscribe.text') !!}
    </h3>
    <div class="form-block-3 w-form">
        <form id="subscribeForm" name="subscribeForm" data-name="subscribeForm" class="form-2" role="form"
              data-toggle="validator">
            <div class="form-group text-field-4">
                <input type="email" class="w-input" maxlength="256" name="subscribeEmail" data-name="subscribeEmail"
                       placeholder="{{trans('front.homepage.subscribe.email')}}" id="subscribeEmail" required
                       data-type-error="Email phải đúng định dạng." data-required-error="Email không được trống.">
                <div class="help-block with-errors"></div>
            </div>
            <input type="submit" value="{{trans('front.homepage.subscribe.button')}}" data-wait="Please wait..."
                   class="submit-button-4 w-button">
        </form>
    </div>
</div>
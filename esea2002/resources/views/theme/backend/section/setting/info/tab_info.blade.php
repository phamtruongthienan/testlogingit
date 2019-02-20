<div class="tab-pane active" id="information">
    <!-- Custom Tabs -->
    <!-- <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_vn" data-toggle="tab">Tiếng việt</a></li>
            <li><a href="#tab_en" data-toggle="tab">Tiếng anh</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_vn"> -->

    <form class="form-horizontal" id="infoForm" role="form" data-toggle="validator">
        <input class="action" name="action" value="update" type="hidden">
        <input class="table" name="table" value="main" type="hidden">
        <input class="id" name="id" type="hidden">
        <div class="box-body">
            <div class="form-group">
                <label for="logo" class="col-sm-2 control-label">Logo</label>
                <div class="col-sm-10">
                    <div class="logo padding-top-7">
                        <img id="logoImage" class="profile-user-img img-responsive img-circle logo-img" src="{{asset('assets/backend/img/avatar.png')}}" alt="Tên công ty"/>
                        <input type="file" id="logoFile" name="logo" style="display: none;" />
                        <input type="hidden" name="image_hash" id="image_hash" value="">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Tên website</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên website"
                           required data-required-error="Tên website không được trống.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="company_name" class="col-sm-2 control-label">Tên công ty</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Tên công ty"
                           required data-required-error="Tên công ty không được trống.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="slogan" class="col-sm-2 control-label">Slogan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="slogan" name="slogan" placeholder="Slogan"/>
                </div>
            </div>
            <div class="form-group">
                <label for="quote" class="col-sm-2 control-label">Trích dẫn</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="quote" name="quote" placeholder="Trích dẫn"/>
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Địa chỉ công ty</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ công ty"
                           required data-required-error="Địa chỉ không được trống.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-sm-2 control-label">Điện thoại công ty</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" class="form-control" id="phone" name="phone"
                               required data-required-error="Điện thoại không được trống.">
                    </div>
                    <div class="help-block with-errors"></div>
                    <!-- /.input group -->
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                           required data-required-error="Email không được trống." data-type-error="Email không đúng định dạng">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="represent" class="col-sm-2 control-label">Người đại diện</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="represent" name="represent" placeholder="Người đại diện"
                           required data-required-error="Người đại diện không được trống.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="num_promo" class="col-sm-2 control-label">Số lượng khuyến mãi hiển thị</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="num_promo" name="num_promo" placeholder="Số lượng khuyến mãi hiển thị"
                           required data-required-error="Số lượng khuyến mãi hiển thị không được trống.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="background_search" class="col-sm-2 control-label">Background search</label>
                <div class="col-sm-10">
                    <div class="col-sm-4 no-padding-left">
                        <input type="text" class="form-control my-colorpicker background_search" name="background_search[]">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control my-colorpicker background_search" name="background_search[]">
                    </div>
                    {{--<div class="col-sm-4 no-padding-right">--}}
                        {{--<div class="btn btn-default btn-file">--}}
                            {{--<i class="fa fa-paperclip"></i> Attachment--}}
                            {{--<input type="file" class="background_search" name="background_search_img">--}}
                        {{--</div>--}}
                        {{--<p class="help-block inline">Max. 32MB</p>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="form-group">
                <label for="background_promotion" class="col-sm-2 control-label">Background promotion</label>
                <div class="col-sm-10">
                    <div class="col-sm-4 no-padding-left">
                        <input type="text" class="form-control my-colorpicker background_promotion" name="background_promotion[]">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control my-colorpicker background_promotion" name="background_promotion[]">
                    </div>
                    {{--<div class="col-sm-4 no-padding-right">--}}
                        {{--<div class="btn btn-default btn-file">--}}
                            {{--<i class="fa fa-paperclip"></i> Attachment--}}
                            {{--<input type="file" class="background_promotion" name="background_promotion_img">--}}
                        {{--</div>--}}
                        {{--<p class="help-block inline">Max. 32MB</p>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="form-group">
                <label for="background_client" class="col-sm-2 control-label">Background client</label>
                <div class="col-sm-10">
                    <div class="col-sm-4 no-padding-left">
                        <input type="text" class="form-control my-colorpicker background_client" name="background_client[]">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control my-colorpicker background_client" name="background_client[]">
                    </div>
                    {{--<div class="col-sm-4 no-padding-right">--}}
                        {{--<div class="btn btn-default btn-file">--}}
                            {{--<i class="fa fa-paperclip"></i> Attachment--}}
                            {{--<input type="file" class="background_client" name="background_client_img">--}}
                        {{--</div>--}}
                        {{--<p class="help-block inline">Max. 32MB</p>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="InfoBtn">Lưu</button>
                    <button type="reset" class="btn btn-default">Thoát</button>
                </div>
            </div>
        </div>
        <!-- /.box-footer -->
    </form>
    <!-- </div> -->
    <!-- /.tab-pane -->
    <!-- </div> -->
    <!-- /.tab-content -->
    <!-- </div> -->
    <!-- nav-tabs-custom -->
</div>
<!-- /.tab-pane -->
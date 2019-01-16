<div class="tab-pane active" id="information">
    <!-- Custom Tabs -->
    <!-- <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_vn" data-toggle="tab">Tiếng việt</a></li>
            <li><a href="#tab_en" data-toggle="tab">Tiếng anh</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_vn"> -->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible no-display" id="alert_msg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i> Thêm thông tin chung thành công.
            </div>
            <div class="alert alert-success alert-dismissible no-display" id="alert_msg_edit">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i> Cập nhật thông tin chung thành công.
            </div>
        </div>
    </div>
    <!-- row -->
    <form class="form-horizontal" id="infoForm" role="form" data-toggle="validator">
        <div class="box-body">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Logo</label>
                <div class="col-sm-10">
                    <div class="logo padding-top-7">
                        <img id="logoImage" class="profile-user-img img-responsive img-circle logo-img" src="{{asset('assets/backend/img/avatar.png')}}" alt="Tên công ty"/>
                        <input type="file" id="logoFile" style="display: none;" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputNameSite" class="col-sm-2 control-label">Tên website</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputNameSite" placeholder="Tên website"
                           required data-required-error="Tên website không được trống.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Tên công ty</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" placeholder="Tên công ty"
                           required data-required-error="Tên công ty không được trống.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSlogan" class="col-sm-2 control-label">Slogan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputSlogan" placeholder="Slogan"
                           required data-required-error="Slogan không được trống.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputQuote" class="col-sm-2 control-label">Trích dẫn</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputQuote" placeholder="Trích dẫn"
                           required data-required-error="Trích dẫn không được trống.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress" class="col-sm-2 control-label">Địa chỉ công ty</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputAddress" placeholder="Địa chỉ công ty"
                           required data-required-error="Địa chỉ không được trống.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPhone" class="col-sm-2 control-label">Điện thoại công ty</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" class="form-control" id="inputPhone"
                               required data-required-error="Điện thoại không được trống.">
                    </div>
                    <div class="help-block with-errors"></div>
                    <!-- /.input group -->
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email"
                           required data-required-error="Email không được trống." data-type-error="Email không đúng định dạng">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSurrogate" class="col-sm-2 control-label">Người đại diện</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputSurrogate" placeholder="Người đại diện"
                           required data-required-error="Người đại diện không được trống.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputNumPromotion" class="col-sm-2 control-label">Số lượng khuyến mãi hiển thị</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputNumPromotion" placeholder="Số lượng khuyến mãi hiển thị"
                           required data-required-error="Số lượng khuyến mãi hiển thị không được trống.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputBackgroundSearch" class="col-sm-2 control-label">Background search</label>
                <div class="col-sm-10">
                    <div class="col-sm-4 no-padding-left">
                        <input type="text" class="form-control my-colorpicker" name="inputBackgroundSearchTop">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control my-colorpicker" name="inputBackgroundSearchBottom">
                    </div>
                    <div class="col-sm-4 no-padding-right">
                        <div class="btn btn-default btn-file">
                            <i class="fa fa-paperclip"></i> Attachment
                            <input type="file" name="attachment">
                        </div>
                        <p class="help-block inline">Max. 32MB</p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputBackgroundPromotion" class="col-sm-2 control-label">Background promotion</label>
                <div class="col-sm-10">
                    <div class="col-sm-4 no-padding-left">
                        <input type="text" class="form-control my-colorpicker" name="inputBackgroundPromotionTop">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control my-colorpicker" name="inputBackgroundPromotionBottom">
                    </div>
                    <div class="col-sm-4 no-padding-right">
                        <div class="btn btn-default btn-file">
                            <i class="fa fa-paperclip"></i> Attachment
                            <input type="file" name="attachment">
                        </div>
                        <p class="help-block inline">Max. 32MB</p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputBackgroundClient" class="col-sm-2 control-label">Background client</label>
                <div class="col-sm-10">
                    <div class="col-sm-4 no-padding-left">
                        <input type="text" class="form-control my-colorpicker" name="inputBackgroundClientTop">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control my-colorpicker" name="inputBackgroundClientBottom">
                    </div>
                    <div class="col-sm-4 no-padding-right">
                        <div class="btn btn-default btn-file">
                            <i class="fa fa-paperclip"></i> Attachment
                            <input type="file" name="attachment">
                        </div>
                        <p class="help-block inline">Max. 32MB</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="addInfoBtn">Lưu</button>
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
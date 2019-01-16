<!-- Add modal customer -->
<div class="modal fade" id="modal-client" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    <span id="ttlModal"></span>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="PartnerForm" role="form" data-toggle="validator">
                    <input type="hidden" id="action" name="action" value="">
                    <input id="id" name="id" type="hidden">
                    <div class="form-group">
                        <label for="inputAddName"
                               class="col-sm-3 control-label">Họ tên</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" value=""
                                    maxlength="64"
                                   required data-required-error="Họ tên không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddAddress"
                               class="col-sm-3 control-label">Địa chỉ</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address" id="address" value=""
                                   maxlength="128"
                                   required data-required-error="Địa chỉ không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddEmail"
                               class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" value=""
                                   maxlength="64"
                                   required data-required-error="Email không được trống."
                                   data-type-error="Email không đúng định dạng.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddPhone" class="col-sm-3 control-label">Điện thoại</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" class="form-control" id="phone" name="phone"
                                       maxlength="20"
                                       required data-required-error="Điện thoại không được trống.">
                            </div>
                            <div class="help-block with-errors"></div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddFax" class="col-sm-3 control-label">Fax</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-fax"></i>
                                </div>
                                <input type="text" class="form-control" id="fax" name="fax"
                                       maxlength="20"
                                       data-inputmask='"mask": ["(999) 999-9999", "(999) 9999-9999"]' data-mask
                                       required data-required-error="Fax không được trống.">
                            </div>
                            <div class="help-block with-errors"></div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddSite"
                               class="col-sm-3 control-label">Website</label>
                        <div class="col-sm-9">
                            <input type="url" class="form-control" id="website" name="website" value=""
                                   maxlength="255"
                                   data-type-error="Website không đúng định dạng.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddSchool"
                               class="col-sm-3 control-label">Tên trường</label>
                        <div class="col-sm-9">
                            <input id="school_name" name="school_name"
                                   class="form-control single-select2"
                                   required data-required-error="Tên trường không được trống."/>
                            <input id="school_id" name="school_id" type="hidden">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddJob"
                               class="col-sm-3 control-label">Ngành nghề</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="job" name="job" value=""
                                   maxlength="255">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddIntro"
                               class="col-sm-3 control-label">Tự giới thiệu</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="content" id="content" rows="6"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddInvestment" class="col-sm-3 control-label">Vốn đầu tư</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-dollar-sign"></i>
                                </div>
                                <input type="number" class="form-control" id="investment" name="investment"
                                       maxlength="20"
                                       data-type-error="Vốn đầu tư phải là định dạng số.">
                            </div>
                            <div class="help-block with-errors"></div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddNumEmp"
                               class="col-sm-3 control-label">Số nhân viên</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="staff" name="staff" value=""
                                   maxlength="6"
                                   data-type-error="Số nhân viên phải là định dạng số.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLogo" class="col-sm-3 control-label">Logo</label>
                        <div class="col-sm-9">
                            <div class="logo padding-top-7">
                                <img id="logoImage" class="profile-user-img img-circle logo-img" src="{{asset('assets/backend/img/avatar.png')}}" alt="Tên đối tác"/>
                                <input type="file" id="logo" name="logo" style="display: none;" />
                                <input type="hidden" name="image_hash" id="image_hash" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddActive"
                               class="col-sm-3 control-label">Hiển thị</label>
                        <div class="col-sm-9 padding-top-7">
                            <input type="checkbox" name="status" id="status" class="minimal">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="PartnerBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->
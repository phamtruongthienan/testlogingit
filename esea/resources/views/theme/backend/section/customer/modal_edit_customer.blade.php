<!-- Edit modal employee -->
<div class="modal fade" id="modal-customer" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Cập nhật khách hàng
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editCustomerForm" role="form" data-toggle="validator">
                    <input type="hidden" id="action" name="action" value="">
                    <input type="hidden" id="id" name="id" value="">
                    <div class="form-group">
                        <label for="inputEditEmail"
                               class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="inputEditEmail" name="inputEditEmail" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEditPassWord"
                               class="col-sm-3 control-label">Mật khẩu</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="inputEditPassWord" id="inputEditPassWord" value=""
                                   data-minlength="6" data-error="Mật khẩu ít nhất 6 ký tự.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEditRePassWord"
                               class="col-sm-3 control-label">Nhập lại mật khẩu</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="inputEditRePassWord" name="inputEditRePassWord" value=""
                                   data-minlength="6" data-minlength-error="Mật khẩu ít nhất 6 ký tự."
                                   data-match="#inputEditPassWord" data-match-error="Nhập lại mật khẩu không đúng.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEditName"
                               class="col-sm-3 control-label">Họ tên</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputEditName" name="inputEditName" value=""
                                   required data-required-error="Họ tên không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEditSex"
                               class="col-sm-3 control-label">Giới tính</label>
                        <div class="col-sm-9 padding-top-7">
                            <label>
                                <input type="radio" name="sex" id="sexMale" class="minimal" value ="1" required data-required-error="Giới tính không được trống.">
                                Nam
                            </label>
                            <label class="margin-left-10">
                                <input type="radio" name="sex" id="sexFemale" class="minimal" value ="0">
                                Nữ
                            </label>
                            <label class="margin-left-10">
                                <input type="radio" name="sex" id="sexDif" class="minimal" value ="2">
                                Giới tính khác
                            </label>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEditPhone" class="col-sm-3 control-label">Điện thoại</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" class="form-control" id="inputEditPhone" name="inputEditPhone"
                                       required data-required-error="Điện thoại không được trống.">
                            </div>
                            <div class="help-block with-errors"></div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status"
                               class="col-sm-3 control-label">Kích hoạt</label>
                        <div class="col-sm-9">
                            <input type="checkbox" name="status" id="status" class="minimal">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="inputEditNumChild"
                            class="col-sm-3 control-label">Số con</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="inputEditNumChild" value=""
                            required data-required-error="Số con không được trống."
                            data-type-error="Số con phải là định dạng số.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="inputEditDesire"
                            class="col-sm-3 control-label">Mong muốn</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="inputEditDesire" id="inputEditDesire" cols="70" rows="6"></textarea>
                        </div>
                    </div> -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="CustomerBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Edit modal employee  -->
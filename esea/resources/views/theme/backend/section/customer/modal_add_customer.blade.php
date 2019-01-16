<!-- Add modal customer -->
<div class="modal fade" id="modal-customer-add" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Thêm khách hàng mới
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addCustomerForm" role="form" data-toggle="validator">
                    <div class="form-group">
                        <label for="inputAddEmail"
                               class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="inputAddEmail" value=""
                                   required data-required-error="Email không được trống."
                                   data-type-error="Email không đúng định dạng.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddPassWord"
                               class="col-sm-3 control-label">Mật khẩu</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="inputAddPassWord" id="inputAddPassWord" value=""
                                   required
                                   data-minlength="6" data-error="Mật khẩu ít nhất 6 ký tự.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddRePassWord"
                               class="col-sm-3 control-label">Nhập lại mật khẩu</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="inputAddRePassWord" value=""
                                   required data-required-error="Mật khẩu ít nhất 6 ký tự."
                                   data-minlength="6" data-minlength-error="Mật khẩu ít nhất 6 ký tự."
                                   data-match="#inputAddPassWord" data-match-error="Nhập lại mật khẩu không đúng.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddName"
                               class="col-sm-3 control-label">Họ tên</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inputAddName" value=""
                                   required data-required-error="Họ tên không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddSex"
                               class="col-sm-3 control-label">Giới tính</label>
                        <div class="col-sm-9 padding-top-7">
                            <label>
                                <input type="radio" name="sex" class="minimal">
                                Nam
                            </label>
                            <label class="margin-left-10">
                                <input type="radio" name="sex" class="minimal">
                                Nữ
                            </label>
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
                                <input type="text" class="form-control" id="inputAddPhone"
                                       required data-required-error="Điện thoại không được trống.">
                            </div>
                            <div class="help-block with-errors"></div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="inputAddNumChild"
                            class="col-sm-3 control-label">Số con</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="inputAddNumChild" value=""
                            required data-required-error="Số con không được trống."
                            data-type-error="Số con phải là định dạng số.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="inputAddDesire"
                            class="col-sm-3 control-label">Mong muốn</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="inputAddDesire" id="inputAddDesire" cols="70" rows="6"></textarea>
                        </div>
                    </div> -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="addCustomerBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->
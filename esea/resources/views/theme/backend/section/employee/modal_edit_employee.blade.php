<!-- Edit modal employee -->
<div class="modal fade" id="modal-employee" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-user-graduate"></i>
                    Cập nhật nhân viên
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editEmployeeForm" role="form" data-toggle="validator">
                    <input type="hidden" id="action" name="action" value="">
                    <input type="hidden" id="id" name="id" value="">
                    <div class="form-group">
                        <label for="inputEditUserName"
                               class="col-sm-3 control-label">Tên đăng nhập</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="inputEditUserName" id="inputEditUserName" value="" >
                            <div class="help-block with-errors"></div>
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
                            <input type="password" class="form-control" name="inputEditRePassWord" id="inputEditRePassWord" value=""
                                   data-minlength="6" data-minlength-error="Mật khẩu ít nhất 6 ký tự."
                                   data-match="#inputEditPassWord" data-match-error="Nhập lại mật khẩu không đúng.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEditName"
                               class="col-sm-3 control-label">Họ tên</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inputEditName" id="inputEditName" value=""
                                   required data-required-error="Họ tên không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEditBirthday"
                               class="col-sm-3 control-label">Ngày sinh</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="inputEditBirthday" id="inputEditBirthday" value=""
                                       required data-required-error="Ngày sinh không được trống."
                                       data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                            </div>
                            <!-- /.input group -->
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
                        <label for="inputEditPosition"
                               class="col-sm-3 control-label">Vị trí</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" style="width: 100%;" id="inputEditPosition" name="inputEditPosition" required data-required-error="Vị trí không được trống.">
                                @foreach($role as $key => $val)
                                    <option value="{{$val->id}}">{{$val->display_name}}</option>
                                @endforeach
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status"
                               class="col-sm-3 control-label">Chặn</label>
                        <div class="col-sm-9">
                            <input type="checkbox" name="status" id="status" class="minimal">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="EmployeeBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Edit modal employee  -->
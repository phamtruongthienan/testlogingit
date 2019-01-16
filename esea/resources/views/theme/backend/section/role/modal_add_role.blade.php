<!-- Add modal role -->
<div class="modal fade" id="modal-role-add" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fas fa-user-shield"></i> Thêm quyền mới</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addRoleForm">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Add role -->
                            <div class="form-group">
                                <label for="inputAddName"
                                       class="col-sm-3 control-label">Tên</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputAddName" name="inputAddName"
                                           tabindex="1" required data-required-error="Tên không được trống.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Add role -->
                            <!-- Add Description -->
                            <div class="form-group">
                                <label for="inputAddDescription"
                                       class="col-sm-3 control-label">Mô tả</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="add_description"
                                           name="add_description" tabindex="2"
                                           required data-required-error="Mô tả không được trống.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Add Description -->
                            <!-- Add permission -->
                            <div class="form-group">
                                <label for="inputAddRole"
                                       class="col-sm-3 control-label">Quyền</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 select-permission" id="add_permission"
                                            name="add_permission[]"
                                            multiple="multiple" style="width: 100%;" tabindex="3"
                                            required data-required-error="Quyền không được trống.">
                                        <option value="1">Quản lý tìm kiếm | Xem</option>
                                        <option value="2">Quản lý tìm kiếm | Xóa</option>
                                        <option value="3">Quản lý tìm kiếm | Sửa</option>
                                        <option value="4">Quản lý địa điểm | Xem</option>
                                        <option value="5">Quản lý địa điểm | Xóa</option>
                                        <option value="6">Quản lý địa điểm | Sửa</option>
                                        <option value="7">Quản lý phân quyền | Xem</option>
                                        <option value="8">Quản lý phân quyền | Xóa</option>
                                        <option value="9">Quản lý phân quyền | Sửa</option>
                                        <option value="10">Quản lý nhân viên | Xem</option>
                                        <option value="11">Quản lý nhân viên | Xóa</option>
                                        <option value="12">Quản lý nhân viên | Sửa</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Add permission -->
                            <!-- Add permission -->
                            <div class="form-group">
                                <label for="chbAddRole" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="col-sm-6 control-label">
                                        <a id="SelectAllBtn"
                                           class="btn btn-block btn-primary">Chọn tất cả</a>
                                    </div>
                                    <div class="col-sm-6 control-label">
                                        <a id="UnselectAllBtn"
                                           class="btn btn-block btn-primary">Bỏ chọn tất cả</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Add permission -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="addRoleBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal role  -->
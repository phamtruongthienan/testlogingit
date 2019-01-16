<!-- Edit modal role -->
<div class="modal fade" id="modal-role-edit" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fas fa-user-shield"></i> Cập nhật quyền</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editRoleForm">
                    <input type="hidden" id="id" name="id" value="">
                    <input type="hidden" id="action" name="action" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Add role -->
                            <div class="form-group">
                                <label for="inputEditName"
                                       class="col-sm-3 control-label">Tên</label>
                                <div class="col-sm-9" id="inputEditName" style="margin:7px 0;">
                                    <
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEditName"
                                       class="col-sm-3 control-label">Tên hiển thị</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputEditNameDisplay" name="inputEditNameDisplay"
                                           tabindex="4" required data-required-error="Tên hiển thị không được trống.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Add role -->
                            <!-- Add Description -->
                            <div class="form-group">
                                <label for="inputEditDescription"
                                       class="col-sm-3 control-label">Mô tả</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edit_description"
                                           name="edit_description" tabindex="6"
                                           required data-required-error="Mô tả không được trống.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Add Description -->
                            <!-- Add permission -->
                            <div class="form-group">
                                <label for="inputEditRole"
                                       class="col-sm-3 control-label">Quyền</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2 select-permission-edit" id="edit_permission"
                                            name="edit_permission[]"
                                            multiple="multiple" style="width: 100%;" tabindex="6">
                                        @foreach($permission as $key => $val)
                                            <option value="{{$val->id}}">{{$val->display_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <!-- Add permission -->
                            <!-- Add permission -->
                            <div class="form-group">
                                <label for="chbEditRole" class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="col-sm-6 control-label">
                                        <a id="SelectAllBtnEdit"
                                           class="btn btn-block btn-primary">Chọn tât cả</a>
                                    </div>
                                    <div class="col-sm-6 control-label">
                                        <a id="UnselectAllBtnEdit"
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
                <button type="button" class="btn btn-primary" id="editRoleBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Edit modal role  -->
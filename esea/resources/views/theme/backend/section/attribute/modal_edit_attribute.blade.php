<!-- Edit modal employee -->
<div class="modal fade" id="modal-attribute-edit" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Cập nhật thuộc tính
                </h4>
            </div>
            <div class="modal-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_vn_edit" data-toggle="tab">Tiếng việt</a></li>
                        <li><a href="#tab_en_edit" data-toggle="tab">Tiếng anh</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_edit">
                            <form class="form-horizontal" id="editAttributeForm" role="form" data-toggle="validator">
                                <div class="form-group">
                                    <label for="inputEditName"
                                           class="col-sm-3 control-label">Tên thuộc tính</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputEditName" value=""
                                               required data-required-error="Tên thuộc tính không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEditType"
                                           class="col-sm-3 control-label">Loại trường</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2 select-type-edit" id="edit_type"
                                                name="edit_type[]"
                                                style="width: 100%;">
                                            <option>Internatinal</option>
                                            <option>Binglingual</option>
                                            <option>Private</option>
                                            <option>Local preschool</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEditGroup"
                                           class="col-sm-3 control-label">Nhóm thuộc tính</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2 select-group-edit" id="edit_group_attribute"
                                                name="group_attribute"
                                                style="width: 100%;">
                                            <option value="1">Cơ sở vật chất</option>
                                            <option value="2">Sự kiện</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEditAttributeType"
                                           class="col-sm-3 control-label">Loại thuộc tính</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2 select-attribute-edit" id="edit_type_attribute"
                                                name="type_attribute[]"
                                                style="width: 100%;">
                                            <option value="1">TextField</option>
                                            <option value="2">Checkbox</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div id="inputEditAttribute">
                                    <div class="form-group">
                                        <label for="inputEditValue"
                                               class="col-sm-3 control-label">Giá trị</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="inputEditValue" value=""
                                                   required data-required-error="Giá trị không được trống.">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEditUnit"
                                               class="col-sm-3 control-label">Đơn vị tính</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="inputEditUnit" value=""
                                                   required data-required-error="Đơn vị tính không được trống.">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="ckbEditAttribute">
                                    <div class="form-group">
                                        <label for="inputEditValue"
                                               class="col-sm-3 control-label">Giá trị</label>
                                        <div class="col-sm-9 padding-top-7">
                                            <input type="checkbox" name="editValue" class="minimal">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEditActive"
                                           class="col-sm-3 control-label">Cho phép tìm kiếm</label>
                                    <div class="col-sm-9 padding-top-7">
                                        <input type="checkbox" name="editActive" class="minimal">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="editAttributeBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Edit modal employee  -->
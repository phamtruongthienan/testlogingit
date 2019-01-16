<!-- Add modal Facility -->
<div class="modal fade" id="modal-facility-add" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Thêm tiện ích mới
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
                            <form class="form-horizontal" id="addFacilityForm" role="form" data-toggle="validator">
                                <div class="form-group">
                                    <label for="inputAddName"
                                           class="col-sm-3 control-label">Tên tiện ích</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputAddName" value=""
                                               required data-required-error="Tên tiện ích không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddGroup"
                                           class="col-sm-3 control-label">Nhóm thuộc tính</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2 select-group-add" id="add_group_attribute"
                                                name="group_attribute"
                                                style="width: 100%;">
                                            <option value="1">Cơ sở vật chất</option>
                                            <option value="2">Sự kiện</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddFacilityType"
                                           class="col-sm-3 control-label">Loại tiện ích</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2 select-facility-add" id="add_type_facility"
                                                name="type_facility[]"
                                                style="width: 100%;">
                                            <option value="1">TextField</option>
                                            <option value="2">Checkbox</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div id="inputFacility">
                                    <div class="form-group">
                                        <label for="inputAddValue"
                                               class="col-sm-3 control-label">Giá trị</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="inputAddValue" value=""
                                                   required data-required-error="Giá trị không được trống.">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddUnit"
                                               class="col-sm-3 control-label">Đơn vị tính</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="inputAddTime" value=""
                                                   required data-required-error="Đơn vị tính không được trống.">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="ckbFacility">
                                    <div class="form-group">
                                        <label for="inputAddValue"
                                               class="col-sm-3 control-label">Giá trị</label>
                                        <div class="col-sm-9 padding-top-7">
                                            <input type="checkbox" name="addValue" class="minimal">
                                        </div>
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
                <button type="button" class="btn btn-primary" id="addFacilityBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal Facility  -->
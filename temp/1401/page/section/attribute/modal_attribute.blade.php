<!-- Add modal customer -->
<div class="modal fade" id="modal-attribute" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Thêm thuộc tính mới
                </h4>
            </div>
            <div class="modal-body">
                <!-- Custom Tabs --> 
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_vn_edit" class="tab_edit" data-lang="1" data-toggle="tab">Tiếng việt</a></li>
                        <li><a href="#tab_en_edit" class="tab_edit" data-lang="2" data-toggle="tab">Tiếng anh</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_edit">
                            <form class="form-horizontal" id="AttributeForm" role="form" data-toggle="validator">
                                <input  name="action" id="action" value="">
                                <input  name="lang" id="lang">
                                <input  name="id" id="id">
                                <div class="form-group">
                                    <label for="inputAddName"
                                           class="col-sm-3 control-label">Tên thuộc tính</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputAddName" id="inputAddName" value=""
                                               required data-required-error="Tên thuộc tính không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="inputAddType"
                                           class="col-sm-3 control-label">Loại trường</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2 select-type-add" id="type"                          
                                                name="type"
                                                style="width: 100%;">
                                            @foreach ($type as $key => $val)
                                                <option value="{{$val->id}}">{{$val->mSchoolTypeTranslations[0]->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label for="inputAddGroup"
                                           class="col-sm-3 control-label">Nhóm thuộc tính</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2 select-group-add" id="group_attribute"
                                                name="group_attribute"
                                                style="width: 100%;">
                                            @foreach ($category as $key => $val)
                                            <option value="{{$val->id}}">{{$val->mSchoolCategoryTranslations[0]->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddAttributeType"
                                           class="col-sm-3 control-label">Loại thuộc tính</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2 select-attribute-add" id="type_attribute"
                                                name="type_attribute"
                                                style="width: 100%;">
                                            <option value="1">TextField</option>
                                            <option value="2">Checkbox</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div id="inputAttribute">
                                    <div class="form-group">
                                        <label for="inputAddValue"
                                               class="col-sm-3 control-label">Giá trị</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="inputAddValue" id="inputAddValue" value=""
                                                   required data-required-error="Giá trị không được trống.">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddUnit"
                                               class="col-sm-3 control-label">Đơn vị tính</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="inputAddUnit" id="inputAddUnit" value=""
                                                   required data-required-error="Đơn vị tính không được trống.">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="ckbAttribute">
                                    <div class="form-group">
                                        <label for="inputAddValue"
                                               class="col-sm-3 control-label">Giá trị</label>
                                        <div class="col-sm-9 padding-top-7">
                                            <input type="checkbox" name="addValue" class="minimal">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddActive"
                                           class="col-sm-3 control-label">Cho phép tìm kiếm</label>
                                    <div class="col-sm-9 padding-top-7">
                                        <input type="checkbox" name="addActive" class="minimal" id="addActive">
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
                <button type="button" class="btn btn-primary" id="addAttributeBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->
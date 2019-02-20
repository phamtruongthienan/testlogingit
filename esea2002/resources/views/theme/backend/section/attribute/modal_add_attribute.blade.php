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
                    <span class="ttlModal"></span>
                </h4>
            </div>
            <div class="modal-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if(LaravelLocalization::getCurrentLocale() == $properties['regional'])
                                <li class="active"><a href="#" class="tab_edit_attribute" data-lang="{{$properties['id']}}" data-toggle="tab">{{$properties['native']}}</a></li>
                            @else
                                <li><a href="#" class="tab_edit_attribute" data-lang="{{$properties['id']}}" data-toggle="tab">{{$properties['native']}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_edit">
                            <form class="form-horizontal" id="AttributeForm" role="form" data-toggle="validator">
                                <input type="hidden" name="action" class="action">
                                <input type="hidden" name="table" class="table">
                                <input type="hidden" name="lang" class="lang">
                                <input type="hidden" name="id" class="id">
                                <div class="form-group">
                                    <label for="name"
                                           class="col-sm-3 control-label">Tên thuộc tính</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control name" name="name" value=""
                                               required data-required-error="Tên thuộc tính không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="school_category_id"
                                           class="col-sm-3 control-label">Nhóm thuộc tính</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" id="school_category_id"
                                                name="school_category_id"
                                                style="width: 100%;">
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="type"
                                           class="col-sm-3 control-label">Loại thuộc tính</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" id="type"
                                                name="type"
                                                style="width: 100%;">
                                            <option value="1">TextField</option>
                                            <option value="2">Checkbox</option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div id="inputAttribute">
                                    <div class="form-group">
                                        <label for="value"
                                               class="col-sm-3 control-label">Giá trị</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="value" id="value" value=""
                                                   required data-required-error="Giá trị không được trống.">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="unit"
                                               class="col-sm-3 control-label">Đơn vị tính</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2" id="unit"
                                                    name="unit" style="width: 100%;"
                                                    required data-required-error="Đơn vị tính không được trống.">
                                                <option value="1">Tiếng</option>
                                                <option value="2">Buổi</option>
                                                <option value="3">Ngày</option>
                                                <option value="4">Tuần</option>
                                                <option value="5">Tháng</option>
                                                <option value="6">Năm</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="ckbAttribute">
                                    <div class="form-group">
                                        <label for="ckbvalue"
                                               class="col-sm-3 control-label">Giá trị</label>
                                        <div class="col-sm-9 padding-top-7">
                                            <input type="checkbox" name="ckbvalue" id="ckbvalue" class="minimal">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="icon"
                                           class="col-sm-3 control-label">Icon</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" id="icon"
                                                name="icon" style="width: 100%;"
                                                required data-required-error="Icon không được trống.">
                                            <option value="fas fa-bus"></option>
                                            <option value="fas fa-school"></option>
                                            <option value="fas fa-clock"></option>
                                            <option value="fab fa-accessible-icon"></option>
                                            <option value="fas fa-utensils"></option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="search"
                                           class="col-sm-3 control-label">Cho phép tìm kiếm</label>
                                    <div class="col-sm-9 padding-top-7">
                                        <input type="checkbox" name="search" id="search" class="minimal">
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
                <button type="button" class="btn btn-primary" id="AttributeBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->
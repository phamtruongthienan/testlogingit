<!-- Add modal customer -->
<div class="modal fade" id="modal-groupAttribute" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Thêm nhóm thuộc tính mới
                </h4>
            </div>
            <div class="modal-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_vn_edit" class="tab_edit" data-lang="1"  data-toggle="tab">Tiếng việt</a></li>
                        <li><a href="#tab_en_edit" class="tab_edit" data-lang="2" data-toggle="tab">Tiếng anh</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_edit">
                            <form class="form-horizontal" id="GroupAttributeForm" role="form" data-toggle="validator">
                                <input  name="action" id="action" value="">
                                <input  name="lang" id="lang">
                                <input  name="id" id="id">
                                <div class="form-group">
                                    <label for="inputAddName"
                                           class="col-sm-3 control-label">Tên nhóm thuộc tính</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="inputAddName" name="inputAddName" value=""
                                               required data-required-error="Tên nhóm thuộc tính không được trống.">
                                        <div class="help-block with-errors"></div>
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
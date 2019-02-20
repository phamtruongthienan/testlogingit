<!-- Edit modal localization -->
<div class="modal fade" id="modal-localization-edit" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-language"></i>
                    Cập nhật từ vựng
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
                            <form class="form-horizontal" id="editLocalizationForm" role="form" data-toggle="validator">
                                <div class="form-group">
                                    <label for="inputEditKey"
                                           class="col-sm-3 control-label">Từ khóa</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputEditName" value=""
                                               required data-required-error="Từ khóa không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEditName"
                                           class="col-sm-3 control-label">Tên từ vựng</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputEditName" value=""
                                               required data-required-error="Tên từ vựng không được trống.">
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
                <button type="button" class="btn btn-primary" id="editLocalizationBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Edit modal localization  -->
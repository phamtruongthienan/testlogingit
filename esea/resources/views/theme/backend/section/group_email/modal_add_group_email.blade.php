<!-- Add modal customer -->
<div class="modal fade" id="modal-groupreceiver-add" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Thêm nhóm người nhận mới
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
                            <form class="form-horizontal" id="addGroupReceiverForm" role="form" data-toggle="validator">
                                <div class="form-group">
                                    <label for="inputAddName"
                                           class="col-sm-3 control-label">Tên nhóm</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputAddName" value=""
                                               required data-required-error="Tên ngoại ngữ không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEditPosition"
                                           class="col-sm-3 control-label">
                                        <label>
                                            <input type="radio" name="typeGroup" id="ckbGroup" class="minimal">
                                            Chọn loại nhóm
                                        </label>
                                    </label>
                                    <div class="col-sm-9 hidden" id="typeGroup">
                                        <div class="col-sm-6 no-padding-left">
                                            <select class="form-control select2" style="width: 100%;" id="inputEditPosition">
                                                <option>Người dùng đã đăng ký</option>
                                                <option>Người dùng đăng ký tham quan trường</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="selectEmail" class="hidden">
                                    <div class="form-group">
                                        <label for="inputAddEmail"
                                               class="col-sm-3 control-label">Danh sách Email</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2 select-email" id="add_email"
                                                    name="add_email[]"
                                                    multiple="multiple" style="width: 100%;" data-validate="true"
                                                    required data-required-error="Email không được trống.">
                                                <option>abc@gmail.com</option>
                                                <option>xyz@gmail.com</option>
                                                <option>def@gmail.com</option>
                                                <option>ghk@gmail.com</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEditPosition"
                                           class="col-sm-3 control-label">
                                        <label>
                                            <input type="radio" name="typeGroup" id="ckbImport" class="minimal">
                                            Import Excel
                                        </label>
                                    </label>
                                    <div class="col-sm-9 hidden" id="importExcel">
                                        <div class="btn btn-default btn-file">
                                            <i class="fa fa-paperclip"></i> Attachment
                                            <input type="file" name="attachment">
                                        </div>
                                        <p class="help-block">Max. 32MB</p>
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
                <button type="button" class="btn btn-primary" id="addGroupReceiverBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->
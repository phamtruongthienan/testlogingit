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
                <form class="form-horizontal" id="addGroupReceiverForm" role="form" data-toggle="validator">
                    <input type="hidden" id="action" name="action" value="">
                    <input type="hidden" id="id" name="id" value="">
                    <div class="form-group">
                        <label for="inputAddName"
                                class="col-sm-3 control-label">Tên nhóm</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inputAddName" id="inputAddName" value=""
                                    required data-required-error="Tên ngoại ngữ không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="inputEditPosition"
                                class="col-sm-3 control-label">
                            <label>
                                <input type="radio" name="typeGroup" id="ckbGroup" class="minimal">
                                Chọn loại nhóm
                            </label>
                        </label>
                        <div class="col-sm-9 hidden" id="typeGroup">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <select class="form-control select2" style="width: 100%;" id="inputEditPosition" name="inputEditPosition"
                                            data-required-error="Loại nhóm không được trống.">
                                        <option value="1">Người dùng đã đăng ký</option>
                                        <option value="2">Người dùng đăng ký tham quan trường</option>
                                    </select>
                                </div>
                                <div class="help-block with-errors col-sm-12"></div>
                            </div>
                        </div>
                    </div>
                    <div id="selectEmail" class="hidden">
                        <div class="form-group">
                            <label for="inputAddEmail"
                                    class="col-sm-3 control-label">Danh sách Email</label>
                            <div class="col-sm-9">
                                <select class="form-control select2 select-email" id="add_email"
                                        multiple="multiple" style="width: 100%;" data-validate="true"
                                        name="add_email[]" data-placeholder="Chọn email"
                                        data-required-error="Email không được trống.">
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="excel">
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
                                <input type="file" name="attachment" id="attachment"
                                       data-required-error="File không được trống.">
                            </div>
                            <p class="help-block">Max. 32MB</p>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </form>
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
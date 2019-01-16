<!-- Edit modal language -->
<div class="modal fade" id="modal-language-edit" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-globe"></i>
                    Cập nhật thông tin ngôn ngữ
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible no-display" id="alert_language_msg">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fa fa-check"></i> Thêm thông tin ngôn ngữ thành công.
                        </div>
                        <div class="alert alert-success alert-dismissible no-display" id="alert_language_msg_edit">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fa fa-check"></i> Cập nhật thông tin ngôn ngữ thành công.
                        </div>
                    </div>
                </div>
                <!-- row -->
                <form class="form-horizontal" id="editLanguageForm" role="form" data-toggle="validator">
                    <div class="form-group">
                        <label for="inputEditName"
                               class="col-sm-3 control-label">Tên ngôn ngữ</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inputEditName" value=""
                                   required data-required-error="Tên ngôn ngữ không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEditCode"
                               class="col-sm-3 control-label">Mã code</label>
                        <div class="col-sm-9 padding-top-7">
                            <span id="editCode">en</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEditCurrency"
                               class="col-sm-3 control-label">Tiền tệ</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inputEditCurrency" value=""
                                   required data-required-error="Tiền tệ không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEditDate"
                               class="col-sm-3 control-label">Ngày tháng</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">dd/mm/yy</option>
                                <option>dd/mm/yyyy</option>
                                <option>d/m/yy</option>
                                <option>d/m/yyyy</option>
                                <option>ddmmyy</option>
                                <option>ddmmyyyy</option>
                                <option>ddmmmyy</option>
                                <option>ddmmmyyyy</option>
                                <option>dd-mmm-yy</option>
                                <option>dd-mmm-yyyy</option>
                                <option>dmmmyy</option>
                                <option>dmmmyyyy</option>
                                <option>d-mmm-yy</option>
                                <option>d-mmm-yyyy</option>
                                <option>d-mmmm-yy</option>
                                <option>d-mmmm-yyyy</option>
                                <option>yymmdd</option>
                                <option>yyyymmdd</option>
                                <option>yy/mm/dd</option>
                                <option>yyyy/mm/dd</option>
                                <option>mmddyy</option>
                                <option>mmddyyyy</option>
                                <option>mm/dd/yy</option>
                                <option>mm/dd/yyyy</option>
                                <option>mmm-dd-yy</option>
                                <option>mmm-dd-yyyy</option>
                                <option>yyyy-mm-dd</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="editLanguageBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Edit modal language  -->
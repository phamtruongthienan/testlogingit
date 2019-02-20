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
                <form class="form-horizontal" id="editLanguageForm" role="form" data-toggle="validator">
                    <input class="action" name="action" value="update" type="hidden">
                    <input class="table" name="table" value="language" type="hidden">
                    <input class="type" name="type" value="1" type="hidden">
                    <input class="id" name="id" type="hidden">
                    <div class="form-group">
                        <label for="name"
                               class="col-sm-3 control-label">Tên ngôn ngữ</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name" value=""
                                   required data-required-error="Tên ngôn ngữ không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="code"
                               class="col-sm-3 control-label">Mã code</label>
                        <div class="col-sm-9 padding-top-7">
                            <span id="code"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="currency_code"
                               class="col-sm-3 control-label">Tiền tệ</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="currency_code" id="currency_code" value=""
                                   required data-required-error="Tiền tệ không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exchange"
                               class="col-sm-3 control-label">Tỉ giá</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="rate" id="rate" value=""
                                    data-required-error="Tiền tệ không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date_format"
                               class="col-sm-3 control-label">Ngày tháng</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" id="date_format" name="date_format" style="width: 100%;">
                                <option value="dd/mm/yy" selected="selected">dd/mm/yy</option>
                                <option value="dd/mm/yyyy">dd/mm/yyyy</option>
                                <option value="d/m/yy">d/m/yy</option>
                                <option value="d/m/yyyy">d/m/yyyy</option>
                                <option value="ddmmyy">ddmmyy</option>
                                <option value="ddmmyyyy">ddmmyyyy</option>
                                <option value="ddmmmyy">ddmmmyy</option>
                                <option value="ddmmmyyyy">ddmmmyyyy</option>
                                <option value="dd-mmm-yy">dd-mmm-yy</option>
                                <option value="dd-mmm-yyyy">dd-mmm-yyyy</option>
                                <option value="dmmmyy">dmmmyy</option>
                                <option value="dmmmyyyy">dmmmyyyy</option>
                                <option value="d-mmm-yy">d-mmm-yy</option>
                                <option value="d-mmm-yyyy">d-mmm-yyyy</option>
                                <option value="d-mmmm-yy">d-mmmm-yy</option>
                                <option value="d-mmmm-yyyy">d-mmmm-yyyy</option>
                                <option value="yymmdd">yymmdd</option>
                                <option value="yyyymmdd">yyyymmdd</option>
                                <option value="yy/mm/dd">yy/mm/dd</option>
                                <option value="yyyy/mm/dd">yyyy/mm/dd</option>
                                <option value="mmddyy">mmddyy</option>
                                <option value="mmddyyyy">mmddyyyy</option>
                                <option value="mm/dd/yy">mm/dd/yy</option>
                                <option value="mm/dd/yyyy">mm/dd/yyyy</option>
                                <option value="mmm-dd-yy">mmm-dd-yy</option>
                                <option value="mmm-dd-yyyy">mmm-dd-yyyy</option>
                                <option value="yyyy-mm-dd">yyyy-mm-dd</option>
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
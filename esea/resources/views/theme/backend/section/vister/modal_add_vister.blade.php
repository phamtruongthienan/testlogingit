<!-- Add modal visiter -->
<div class="modal fade" id="modal-visiter-add" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Thêm khách tham quan mới
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addVisiterForm" role="form" data-toggle="validator">
                    <div class="form-group">
                        <label for="inputAddBook"
                               class="col-sm-3 control-label">Ngày book</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="inputAddBook" value=""
                                       required data-required-error="Ngày book không được trống."
                                       data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                            </div>
                            <!-- /.input group -->
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddSchool"
                               class="col-sm-3 control-label">Tên trường</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" style="width: 100%;" id="inputAddSchool">
                                <option></option>
                                <option>Trung tâm ila</option>
                                <option>Trung tâm Hello</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddBook"
                               class="col-sm-3 control-label">Thời gian tham quan</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" name="inputBook" value=""
                                       required data-required-error="Ngày book không được trống.">
                            </div>
                            <!-- /.input group -->
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddName"
                               class="col-sm-3 control-label">Họ tên</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inputAddName" value=""
                                   required data-required-error="Họ tên không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddPhone" class="col-sm-3 control-label">Điện thoại</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" class="form-control" id="inputAddPhone"
                                       required data-required-error="Điện thoại không được trống.">
                            </div>
                            <div class="help-block with-errors"></div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddEmail"
                               class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="inputAddEmail" value=""
                                   required data-required-error="Email không được trống."
                                   data-type-error="Email không đúng định dạng.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddStatus"
                               class="col-sm-3 control-label">Trạng thái</label>
                        <div class="col-sm-9">
                            <select class="form-control select2" style="width: 100%;" id="inputAddStatus">
                                <option></option>
                                <option>Mới</option>
                                <option>Đang xử lý</option>
                                <option>Đã xử lý</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddDesire"
                               class="col-sm-3 control-label">Chú thích</label>
                        <div class="col-sm-9">
                            <textarea class="form-control textarea" name="inputAddDesire" id="inputAddDesire" cols="70" rows="6"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="addVisiterBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->
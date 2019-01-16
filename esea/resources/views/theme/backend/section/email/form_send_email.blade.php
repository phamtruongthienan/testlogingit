<div class="box box-primary">
    <div class="box-header with-border">
        <i class="fa fa-envelope"></i>
        <h3 class="box-title">Gửi mail</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible no-display" id="alert_msg">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fa fa-check"></i> Gửi mail thành công.
                </div>
            </div>
        </div>
        <!-- row -->
        <form class="form-horizontal" id="sendForm" role="form" data-toggle="validator">
            <div class="box-body">
                <!-- Add role -->
                <div class="form-group">
                    <label for="inputAddTitle"
                           class="col-sm-2 control-label">Tiêu đề</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputAddTitle" name="inputAddTitle"
                               required data-required-error="Tiêu đề không được trống.">
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <!-- Add role -->
                <!-- Add Description -->
                <div class="form-group">
                    <label for="inputAddContent"
                           class="col-sm-2 control-label">Nội dung</label>
                    <div class="col-sm-10">
                        <textarea class="form-control textarea" name="inputAddContent" id="inputAddContent" rows="6"></textarea>
                    </div>
                </div>
                <!-- Add Description -->
                <div class="form-group">
                    <label for="inputAddType"
                           class="col-sm-2 control-label">Nhóm người nhận</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" style="width: 100%;" id="inputAddType">
                            <option selected="selected">Danh sách trường</option>
                            <option>Danh sách khách hàng </option>
                            <option>Danh sách nhân viên</option>
                        </select>
                    </div>
                </div>
                <!-- Add permission -->
                <div class="form-group">
                    <label for="inputAddEmail"
                           class="col-sm-2 control-label">Danh sách Email</label>
                    <div class="col-sm-10">
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
                <!-- Add permission -->
                <!-- Add permission -->
                <div class="form-group">
                    <label for="chbAddEmail" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <div class="col-sm-6 control-label no-padding-left">
                            <a id="SelectAllBtn"
                               class="btn btn-block btn-primary">Chọn</a>
                        </div>
                        <div class="col-sm-6 control-label no-padding-right">
                            <a id="UnselectAllBtn"
                               class="btn btn-block btn-primary">Bỏ chọn</a>
                        </div>
                    </div>
                </div>
                <!-- Add permission -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Gửi</button>
                        <button type="reset" class="btn btn-default">Hủy</button>
                    </div>
                </div>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
    <!-- /.box-body -->
</div>
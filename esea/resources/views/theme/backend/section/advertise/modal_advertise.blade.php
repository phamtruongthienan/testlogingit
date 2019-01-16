<!-- Add modal customer -->
<div class="modal fade" id="modal-advertise" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Thêm quảng cáo mới
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="AdvertiseForm" role="form" data-toggle="validator">
                    <input type="hidden" id="action" name="action" value="">
                    <input id="id" name="id" type="hidden">
                    <div class="form-group">
                        <label for="type" class="col-sm-2 control-label">Loại popup</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" id="type" name="type" style="width: 100%;">
                                <option value="1">Mở cửa sổ mới</option>
                                <option value="2">Modal popup</option>
                                <option value="3">Ảnh tĩnh</option>
                                <option value="4">Video</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content"
                               class="col-sm-2 control-label">Nội dung</label>
                        <div class="col-sm-10">
                                <textarea class="form-control textarea" name="content" id="content" rows="6"
                                            data-required-error="Nội dung không được trống."
                                ></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div id="StaticImg">
                        <div class="form-group">
                            <label for="inputImage" class="col-sm-2 control-label">Ảnh</label>
                            <div class="col-sm-10">
                                <div class="logo padding-top-7">
                                        <img id="logoImage" width="100px" height="100px" class="profile-user-img img-circle logo-img" src="{{asset('assets/backend/img/avatar.png')}}" alt="Tên quảng cáo"/>
                                        <input type="file" id="image" name="image" style="display: none;" />
                                        <input type="hidden" name="image_hash" id="image_hash" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="position" class="col-sm-2 control-label">Vị trí popup</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" id="position" name="position" style="width: 100%;">
                                    <option value="1">Đầu trang</option>
                                    <option value="2">Cuối trang</option>
                                    <option value="3">Sidebar</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="target" class="col-sm-2 control-label">Chỉ định trang</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" id="target" style="width: 100%;">
                                    <option value="1">Tất cả trang</option>
                                    <option value="2">Chỉ trang chủ</option>
                                    <option value="3">Chỉ trang chi tiết trường</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="link"
                               class="col-sm-2 control-label">Liên kết</label>
                        <div class="col-sm-10">
                            <input type="url" class="form-control" name="link" id="link" value=""
                                   data-type-error="Liên kết không đúng định dạng." data-required-error="Liên kết không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="start_date"
                               class="col-sm-2 control-label">Ngày bắt đầu</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="start_date" id="start_date" value=""
                                       data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="end_date"
                               class="col-sm-2 control-label">Ngày kết thúc</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control datepicker" name="end_date" id="end_date" value=""
                                       data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                            </div>
                            <!-- /.input group -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status"
                               class="col-sm-2 control-label">Trạng thái</label>
                        <div class="col-sm-10 padding-top-7">
                            <input type="checkbox" name="status" id="status" class="minimal">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="AdvertiseBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->
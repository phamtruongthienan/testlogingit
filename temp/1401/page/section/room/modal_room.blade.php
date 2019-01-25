<!-- Add modal customer -->
<div class="modal fade" id="modal-room" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Thêm phòng học mới
                </h4>
            </div>
            <div class="modal-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_vn_edit" class="tab_edit" data-toggle="tab" value='1' data-lang="1" >Tiếng việt</a></li>
                        <li><a href="#tab_en_edit" class="tab_edit" data-toggle="tab" value='2' data-lang="2">Tiếng anh</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_edit">
                            <form class="form-horizontal" id="addRoomForm" role="form" data-toggle="validator">
                                <input  name="action" id="action" value="">
                                <input  name="lang" id="lang">
                                <input  name="id" id="id">
                                <div class="form-group">
                                    <label for="inputAddName"
                                           class="col-sm-3 control-label">Tên phòng học</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputAddName" id="inputAddName" value=""
                                               required data-required-error="Tên phòng học không được trống." maxlength="255" >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddPosition"
                                           class="col-sm-3 control-label">Vị trí</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputAddPosition" id="inputAddPosition" value="" maxlength="255"
                                               required data-required-error="Ví trí không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="addOption">
                                    <div class="form-group">
                                        <input type="hidden" name="idaddon[]" class="idaddon">
                                        <div class="col-sm-3 nameaddonparent ">
                                            <input type="text" class="form-control nameaddon" name="inputAddNameOption[]"   value=""
                                                   placeholder="Tên" data-required-error="Tên không được trống." maxlength="255">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-sm-8 contentaddonparent ">
                                            <input type="text" class="form-control contentaddon" name="inputAddValueOption[]" value=""
                                                placeholder="Giá trị" data-required-error="Giá trị không được trống." maxlength="255">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-sm-1">
                                            <i class="fa fa-plus addElement" aria-hidden="true" ></i>
                                        </div>
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
                <button type="button" class="btn btn-primary" id="addRoomBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->
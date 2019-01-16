<!-- Activity log modal -->
<div class="modal fade" id="list-child-modal">
    <div class="modal-dialog"  style="width:80%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    Danh sách học sinh
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible no-display" id="alert_child_msg_edit">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fa fa-check"></i> Cập nhật học sinh thành công.
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="control-row table-responsive">
                            <table class="table table-bordered table-striped table-dynamic table-dynamic-child nowrap"
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center" width="100px">ID</th>
                                    <th class="text-center">Họ và tên</th>
                                    <th class="text-center" width="150px">Giới tính</th>
                                    <th class="text-center" width="150px">Tuổi</th>
                                    <th class="text-center" width="200px">Tinh cách</th>
                                    <th class="text-center" width="300px">Trường học</th>
                                    <th class="text-center" width="200px"></th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn">Thoát</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Activity log modal -->
<!-- Activity log modal -->
<div class="modal fade" id="activity-log-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    Danh sách hoạt động
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="control-row table-responsive">
                            <table class="table table-bordered table-striped table-dynamic table-dynamic-activity nowrap"
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center" width="100px">ID</th>
                                    <th class="text-center">Ngày thao tác</th>
                                    <th class="text-center" width="150px">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody id="activity">
                                   
                                </tbody>
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
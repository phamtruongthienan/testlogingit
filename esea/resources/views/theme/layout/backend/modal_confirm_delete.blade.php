<!-- Confirm modal -->
<div class="modal fade" id="confirm-delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i
                            class="fas fa-exclamation-triangle text-red"></i> Thông báo</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" class="form-control" id="id" name="id" required>
                        <input type="hidden" class="form-control" id="module" name="module" required>
                        Bạn có chắc chắn muốn xóa?
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning"
                        id="confirm-delete">Đồng ý</button>
                <button type="button" data-dismiss="modal" class="btn">Hủy bỏ</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Confirm modal -->
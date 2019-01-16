<!-- Reply email modal employee -->
<div class="modal fade" id="modal-visiter-reply" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Phản hồi email
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="replyVisiterForm" role="form" data-toggle="validator">
                    <input type="hidden" id="id" name="id" value="">
                    <div class="form-group">
                        <label for="inputReplyContent"
                               class="col-sm-3 control-label">Nội dung</label>
                        <div class="col-sm-9">
                            <textarea class="form-control textarea" name="inputReplyContent" id="inputReplyContent" cols="70" rows="6" required data-required-error="Chưa nhập phản hồi."></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="replyVisiterBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Gửi</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Reply email modal employee  -->
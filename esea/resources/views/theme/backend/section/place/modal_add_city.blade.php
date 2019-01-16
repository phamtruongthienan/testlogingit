<!-- Add modal city -->
<div class="modal fade" id="modal-city-add" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Thêm tỉnh mới
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="addCityForm" role="form" data-toggle="validator">
                    <input type="hidden" class="action" name="action" value="">
                    <input type="hidden" class="table" name="table" value="">
                    <div class="form-group">
                        <label for="name"
                               class="col-sm-3 control-label">Tên Tỉnh</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control name" name="name" value=""
                                   required data-required-error="Tên tỉnh không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="addCityBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal city  -->
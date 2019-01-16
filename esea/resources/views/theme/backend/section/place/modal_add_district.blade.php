<!-- Add modal district -->
<div class="modal fade" id="modal-district" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    <span class="ttlModal"></span>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="DistrictForm" role="form" data-toggle="validator">
                    <input type="hidden" class="action" name="action" value="">
                    <input class="id" name="id" type="hidden">
                    <input id="city_id" name="city_id" type="hidden">
                    <input type="hidden" class="table" name="table" value="">
                    <div class="form-group">
                        <label for="inputAddName"
                               class="col-sm-3 control-label">Tên Quận</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control name" name="name" value=""
                                   required data-required-error="Tên quận không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="DistrictBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal district  -->
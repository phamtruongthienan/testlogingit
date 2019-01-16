<div class="tab-pane active" id="tab_city">
    <form class="form-horizontal" id="editCityForm" role="form" data-toggle="validator">
        <input type="hidden" class="action" name="action" value="">
        <input class="id" name="id" type="hidden">
        <input type="hidden" class="table" name="table" value="">
        <div class="form-group">
            <label for="name"
                   class="col-sm-2 control-label">Tên Tỉnh</label>
            <div class="col-sm-10">
                <input type="text" class="form-control name" name="name" value=""
                       required data-required-error="Tên tỉnh không được trống.">
                <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-primary" id="editCityBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu
                </button>
            </div>
        </div>
    </form>
</div>
<!-- /.tab-pane -->
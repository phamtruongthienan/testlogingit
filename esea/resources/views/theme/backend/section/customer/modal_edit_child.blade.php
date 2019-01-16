<!-- Edit modal child -->
<div class="modal fade" id="modalChild" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Cập nhật học sinh
                </h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="editChildForm" role="form" data-toggle="validator">
                <input type="hidden" id="id" name="id" value="">
                <input type="hidden" id="action" name="action" value="">
                    <div class="form-group">
                        <label for="inputChildName"
                               class="col-sm-3 control-label">Họ tên</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="inputChildName" id="inputChildName" value=""
                                   required data-required-error="Họ tên không được trống.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputChildSex"
                               class="col-sm-3 control-label">Giới tính</label>
                        <div class="col-sm-9 padding-top-7">
                            <label>
                                <input type="radio" name="sex" id="sexChildMale" class="minimal" value="1" required data-required-error="Giới tính không được trống.">
                                Nam
                            </label>
                            <label class="margin-left-10">
                                <input type="radio" name="sex" id="sexChildFemale" class="minimal" value="0">
                                Nữ
                            </label>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEditBirthday"
                               class="col-sm-3 control-label">Ngày sinh</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" name="inputEditChildBirthday" id="inputEditChildBirthday" value=""
                                       required data-required-error="Ngày sinh không được trống."
                                       data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                            </div>
                            <!-- /.input group -->
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddName"
                                class="col-sm-3 control-label">Tính cách</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="inputAddChildGentive[]" id="inputAddChildGentive" multiple="multiple"
                                    required data-required-error="Tên khóa học không được trống." style="width: 100%">
                                    @foreach($genitive as $k => $v)
                                      <option value="{{$v->genitive}}">{{$v->genitive}}</option>
                                    @endforeach
                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="editChildBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Edit modal child -->
<!-- Add modal program -->
<div class="modal fade" id="modal-program" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    <span class="form-title">Thêm chương trình học mới</span>
                </h4>
            </div>
            <div class="modal-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    @if(LaravelLocalization::getCurrentLocale() == $properties['regional'])
                                    <li class="active"><a href="#" class="tab_edit_program" data-lang="{{$properties['id']}}" data-toggle="tab">{{$properties['native']}}</a></li>
                                    @else
                                    <li><a href="#" class="tab_edit_program" data-lang="{{$properties['id']}}" data-toggle="tab">{{$properties['native']}}</a></li>
                                    @endif 
                                @endforeach
                            </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_edit">
                            <form class="form-horizontal" id="ProgramForm" role="form" data-toggle="validator">
                                    <input type="hidden" name="school_id" id="school_id"  required>
                                    <input type="hidden" name="school_course_id" id="school_course_id"  required>
                                    <input type="hidden" name="action" id="action"  required>
                                    <input type="hidden" name="lang" id="lang"  required>
                                    <input type="hidden" name="id" id="id"  required>
                                <div class="form-group">
                                    <label for="inputAddName"
                                           class="col-sm-3 control-label">Tên giáo trình</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" value=""
                                        required data-required-error="Tên giáo trình không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddTime"
                                           class="col-sm-3 control-label">Thời gian</label>
                                    <div class="col-sm-9">
                                        <div class="col-sm-4 no-padding-left">
                                            <input type="text" class="form-control" id="time" name="time" value=""
                                            required data-required-error="Thời gian không được trống.">
                                        </div>
                                        <div class="col-sm-4">
                                            <select class="form-control select2 select-timeunit-add" id="unit1"
                                                    name="unit1"
                                                    style="width: 100%;" required>
                                                <option value="1">Tiếng</option>
                                                <option value="2">Buổi</option>
                                                <option value="3">Ngày</option>
                                                <option value="4">Tuần</option>
                                                <option value="5">Tháng</option>
                                                <option value="6">Năm</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 no-padding-right posr">
                                            <span class="posa icon-slat">/</span>
                                            <select class="form-control select2 select-timeunit-add" id="unit2"
                                                    name="unit2"
                                                    style="width: 100%;" required>
                                                    <option value="1">Tiếng</option>
                                                    <option value="2">Buổi</option>
                                                    <option value="3">Ngày</option>
                                                    <option value="4">Tuần</option>
                                                    <option value="5">Tháng</option>
                                                    <option value="6">Năm</option>
                                            </select>
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddTime"
                                           class="col-sm-3 control-label">Phí VNĐ</label>
                                    <div class="col-sm-9">
                                        <div class="col-sm-4 no-padding-left">
                                            <input type="number" class="form-control" id="fee" name="fee" value=""
                                            required data-required-error="Phí không được trống.">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="unit4" name="unit4" value=""
                                            required data-required-error="Đơn vị không được trống.">
                                        </div>
                                        <div class="col-sm-4 no-padding-right posr">
                                            <span class="posa icon-slat">/</span>
                                            <select class="form-control select2 select-timeunit-add" id="unit3"
                                                    name="unit3"
                                                    style="width: 100%;" required>
                                                    <option value="1">Tiếng</option>
                                                    <option value="2">Buổi</option>
                                                    <option value="3">Ngày</option>
                                                    <option value="4">Tuần</option>
                                                    <option value="5">Tháng</option>
                                                    <option value="6">Năm</option>
                                            </select>
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddIntro"
                                           class="col-sm-3 control-label">Giới thiệu</label>
                                    <div class="col-sm-9">
                                                            <textarea class="textarea form-control" id="content" name="content" placeholder="" style="width: 100%;" rows="15"
                                                            required></textarea>
                                        <div class="help-block with-errors"></div>
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
                <button type="button" class="btn btn-primary" id="addProgramBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal program  -->
<!-- Add modal customer -->
<div class="modal fade" id="modal-course" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    <span class="form-title">Thêm khóa học mới</span>
                </h4>
            </div>
            <div class="modal-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if(LaravelLocalization::getCurrentLocale() == $properties['regional'])
                            <li class="active"><a href="#" class="tab_edit_course" data-lang="{{$properties['id']}}" data-toggle="tab">{{$properties['native']}}</a></li>
                            @else
                            <li><a href="#" class="tab_edit_course" data-lang="{{$properties['id']}}" data-toggle="tab">{{$properties['native']}}</a></li>
                            @endif 
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_edit">
                            <form class="form-horizontal" id="CourseForm" role="form" data-toggle="validator">
                                <input type="hidden" name="school_id" id="school_id">
                                <input type="hidden" name="action" id="action">
                                <input type="hidden" name="lang" id="lang">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="inputAddName"
                                           class="col-sm-2 control-label">Tên khóa học</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" value=""
                                        required data-required-error="Tên khóa học không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddName"
                                           class="col-sm-2 control-label">Miêu tả ngắn</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name_class" name="name_class" value=""
                                        required data-required-error="Tên khóa học không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddName"
                                           class="col-sm-2 control-label">Meta title</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" value=""
                                        required data-required-error="Meta không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddName"
                                           class="col-sm-2 control-label">Meta keyword</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value=""
                                        required data-required-error="Meta không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddName"
                                           class="col-sm-2 control-label">Meta description</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="meta_description" name="meta_description" value=""
                                        required data-required-error="Meta không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddOld"
                                           class="col-sm-2 control-label padding-top-7">Độ tuổi</label>
                                    <div class="col-sm-10 padding-top-7">
                                        <div class="col-sm-10 no-padding-left">
                                            <input type="text" value="" class="slider form-control" data-slider-min="0" data-slider-max="12"
                                                   data-slider-step="1" data-slider-value="[6,10]" data-slider-orientation="horizontal"
                                                   data-slider-selection="before" data-slider-tooltip="show" data-slider-id="blue"
                                                   name="age_month" id="age_month">
                                        </div>
                                        <div class="col-sm-2 no-padding-right no-padding-left">/ tháng</div>
                                        <div class="col-sm-10 no-padding-left">
                                            <input type="text" value="" class="slider form-control" data-slider-min="1" data-slider-max="50"
                                                   data-slider-step="1" data-slider-value="[6,10]" data-slider-orientation="horizontal"
                                                   data-slider-selection="before" data-slider-tooltip="show" data-slider-id="blue"
                                                   name="age" id="age">
                                        </div>
                                        <div class="col-sm-2 no-padding-right no-padding-left">/ tuổi</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddName"
                                           class="col-sm-2 control-label">Sỉ số</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" value=""
                                               required data-required-error="Sỉ số không được trống."
                                               data-type-error="Sỉ số phải là định dạng số."
                                               name="num_student" id="num_student"
                                               >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddName"
                                           class="col-sm-2 control-label">Tỷ lệ giáo viên</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" value=""
                                               required data-required-error="Tỷ lệ giáo viên không được trống."
                                               data-type-error="Tỷ lệ giáo viên phải là định dạng số."
                                               name="num_teacher" id="num_teacher"
                                               >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddDescribe"
                                           class="col-sm-2 control-label">Miêu tả</label>
                                    <div class="col-sm-10">
                                                            <textarea class="textarea form-control" id="content" name="content" placeholder="" style="width: 100%;" rows="6"
                                                                      required data-required-error="Miêu tả không được trống."></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddDateOpen"
                                           class="col-sm-2 control-label">Ngày mở</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control datepicker" id="start_date" name="start_date" value=""
                                                   data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddDateClose"
                                           class="col-sm-2 control-label">Ngày kết thúc</label>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control datepicker" id="end_date" name="end_date" value=""
                                                   data-inputmask="'alias': 'yyyy-mm-dd'" data-mask>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddRoom"
                                           class="col-sm-2 control-label">Phòng</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2 select-room-add" id="school_class"
                                                name="school_class"
                                                style="width: 100%;">
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label for="inputAddActive"
                                               class="col-sm-3 control-label">Hiển thị</label>
                                        <div class="col-sm-9 padding-top-7">
                                            <input type="checkbox" name="status" id="status" class="minimal">
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
                <button type="button" class="btn btn-primary" id="addCourseBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->
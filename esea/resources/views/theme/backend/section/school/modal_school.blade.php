<!-- Add modal customer -->
<div class="modal fade" id="modal-school" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-school"></i>
                    Thêm trường học mới
                </h4>
            </div>
            <div class="modal-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_vn" data-toggle="tab">Tiếng việt</a></li>
                        <li><a href="#tab_en" data-toggle="tab">Tiếng anh</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn">
                            <form class="form-horizontal" id="addSchoolForm" role="form" data-toggle="validator">
                                <div class="box box-primary" id="schoolGeneral">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Thông tin chung</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="inputAddName"
                                                   class="col-sm-3 control-label">Tên trường</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="inputAddName" id="inputAddName" value=""
                                                       required data-required-error="Tên trường không được trống.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddSEO"
                                                   class="col-sm-3 control-label">SEO url</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="inputAddSEO" id="inputAddSEO" value=""
                                                       required data-required-error="SEO url không được trống.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputKeyWord" class="col-sm-3 control-label">Meta Key word</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputKeyWord" placeholder="Meta Key word"
                                                       required data-required-error="Meta Key word không được trống.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDescription" class="col-sm-3 control-label">Meta description</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputDescription" placeholder="Meta description"
                                                       required data-required-error="Meta description không được trống.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddType"
                                                   class="col-sm-3 control-label">Phân loại</label>
                                            <div class="col-sm-9 padding-top-7">
                                                <label>
                                                    <input type="radio" name="addType" class="minimal">
                                                    Trụ sở chính
                                                </label>
                                                <label class="margin-left-10">
                                                    <input type="radio" name="addType" class="minimal">
                                                    Chi nhánh
                                                </label>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddAdress"
                                                   class="col-sm-3 control-label">Địa chỉ</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="inputAddAdress" value=""
                                                       required data-required-error="Địa chỉ không được trống.">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddAdress"
                                                   class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="form-group col-sm-4 no-margin-left no-margin-right">
                                                        <select class="form-control select2 select-city" id="add_city"
                                                                name="city[]"
                                                                style="width: 100%;"
                                                                required data-required-error="Tỉnh/Thành phố không được trống.">
                                                            <option></option>
                                                            <option>Tp. Hồ Chí Minh</option>
                                                            <option>Vũng tàu</option>
                                                            <option>Tiền Giang</option>
                                                            <option>Đồng Nai</option>
                                                        </select>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group col-sm-4 no-margin-left no-margin-right">
                                                        <select class="form-control select2 select-district" id="add_district"
                                                                name="district[]"
                                                                style="width: 100%;"
                                                                required data-required-error="Quận/Huyện không được trống.">
                                                            <option></option>
                                                            <option>Quận 1</option>
                                                            <option>Quận 2</option>
                                                            <option>Quận 3</option>
                                                            <option>Quận 4</option>
                                                        </select>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                    <div class="form-group col-sm-4 no-margin-left no-margin-right">
                                                        <select class="form-control select2 select-ward" id="add_ward"
                                                                name="ward[]"
                                                                style="width: 100%;"
                                                                required data-required-error="Phường/Xã không được trống.">
                                                            <option></option>
                                                            <option>Phường 1</option>
                                                            <option>Phường 2</option>
                                                        </select>
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddType"
                                                   class="col-sm-3 control-label">Trụ sở chính</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2 select-head-office" id="add_head_office"
                                                        name="add_head_office[]"
                                                        style="width: 100%;"
                                                        required data-required-error="Trụ sở chính không được trống." data-validate="false">
                                                    <option>Trụ sở 1</option>
                                                    <option>Trụ sở 2</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddLevel"
                                                   class="col-sm-3 control-label">Cấp trường</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2 select-level-add" id="add_level"
                                                        name="add_level[]"
                                                        style="width: 100%;">
                                                    <option>PRESCHOOLS</option>
                                                    <option>KINGDERGARTEN</option>
                                                    <option>PRIMARY</option>
                                                    <option>LANGUAGE COURSES</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddType"
                                                   class="col-sm-3 control-label">Loại trường</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2 select-type-add" id="add_type"
                                                        name="add_type[]"
                                                        style="width: 100%;">
                                                    <option>Internatinal</option>
                                                    <option>Binglingual</option>
                                                    <option>Private</option>
                                                    <option>Local preschool</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddPhone" class="col-sm-3 control-label">Điện thoại</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-phone"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="inputAddPhone">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddEmail" class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="inputAddEmail" placeholder="Email"
                                                       data-type-error="Email không đúng định dạng">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputNumTeacher" class="col-sm-3 control-label">Số giáo viên</label>
                                            <div class="col-sm-9">
                                                <div class="col-sm-6 no-padding-left">
                                                    <select class="form-control" name="inputNumTeacher[]" id="tagTeacher" multiple="multiple"
                                                            required data-required-error="Số giáo viên không được trống." style="width: 100%">
                                                        <option selected="selected">Giáo viên mầm non</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                                <div class="col-sm-6 no-padding-right">
                                                    <input type="number" class="form-control" name="inputAddNumber" value=""
                                                           required data-required-error="Sỉ số không được trống."
                                                           data-type-error="Sỉ số phải là định dạng số.">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddImage"
                                                   class="col-sm-3 control-label">Ảnh 360<sup>&ordm;</sup></label>
                                            <div class="col-sm-9">
                                                <div class="btn btn-default btn-file">
                                                    <i class="fa fa-paperclip"></i> Attachment
                                                    <input type="file" name="attachment">
                                                </div>
                                                <p class="help-block">Max. 32MB</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddInfo"
                                                   class="col-sm-3 control-label">Thông tin</label>
                                            <div class="col-sm-9">
                                                                    <textarea class="textarea form-control" name="inputAddInfo" placeholder="" style="width: 100%;" rows="15"
                                                                              required data-required-error="Thông tin không được trống."></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddFile"
                                                   class="col-sm-3 control-label">File PDF</label>
                                            <div class="col-sm-9">
                                                <div class="btn btn-default btn-file">
                                                    <i class="fa fa-paperclip"></i> Attachment
                                                    <input type="file" name="attachment">
                                                </div>
                                                <p class="help-block">Max. 32MB</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddIntro"
                                                   class="col-sm-3 control-label">Giới thiệu</label>
                                            <div class="col-sm-9">
                                                <textarea class="textarea form-control" name="inputAddIntro" placeholder="" style="width: 100%;" rows="15"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddVideo"
                                                   class="col-sm-3 control-label">Video</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="inputAddVideo" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddVideo"
                                                   class="col-sm-3 control-label">Ảnh</label>
                                            <div class="col-sm-9">
                                                <div class="info-pic__content">
                                                    <ul id="media-list" class="clearfix">
                                                        <li class="myupload">
                                                                            <span>
                                                                                <i>+</i>
                                                                                <b>Tối đa 20 hình 1 trường học</b>
                                                                                <input type="file" click-type="type2" id="picupload" class="picupload" multiple>
                                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputBackgroundIntro" class="col-sm-3 control-label">Background Introdution</label>
                                            <div class="col-sm-9">
                                                <div class="col-sm-4 no-padding-left">
                                                    <input type="text" class="form-control my-colorpicker" name="inputBackgroundIntro">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputBackgroundFacility" class="col-sm-3 control-label">Background Facility</label>
                                            <div class="col-sm-9">
                                                <div class="col-sm-4 no-padding-left">
                                                    <input type="text" class="form-control my-colorpicker" name="inputBackgroundFacility">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputBackgroundPrice" class="col-sm-3 control-label">Background Price</label>
                                            <div class="col-sm-9">
                                                <div class="col-sm-4 no-padding-left">
                                                    <input type="text" class="form-control my-colorpicker" name="inputBackgroundPrice">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputBackgroundReview" class="col-sm-3 control-label">Background Review</label>
                                            <div class="col-sm-9">
                                                <div class="col-sm-4 no-padding-left">
                                                    <input type="text" class="form-control my-colorpicker" name="inputBackgroundReview">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputBackgroundMap" class="col-sm-3 control-label">Background Map</label>
                                            <div class="col-sm-9">
                                                <div class="col-sm-4 no-padding-left">
                                                    <input type="text" class="form-control my-colorpicker" name="inputBackgroundMap">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddSearch"
                                                   class="col-sm-3 control-label">Cho phép tìm kiếm</label>
                                            <div class="col-sm-9 padding-top-7">
                                                <input type="checkbox" name="addSearch" class="minimal">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddActive"
                                                   class="col-sm-3 control-label">Hiển thị</label>
                                            <div class="col-sm-9 padding-top-7">
                                                <input type="checkbox" name="addActive" class="minimal">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                                <div class="box box-primary" id="schoolDetail">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Thông tin chi tiết</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="inputAddLanguage"
                                                   class="col-sm-3 control-label">Ngoại ngữ</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2 select-language-add" id="add_language"
                                                        name="add_language[]" multiple
                                                        style="width: 100%;">
                                                    <option>Anh</option>
                                                    <option>Hoa</option>
                                                    <option>Nhật</option>
                                                    <option>Hàn</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddFee"
                                                   class="col-sm-3 control-label">Học phí</label>
                                            <div class="col-sm-9 padding-top-7">
                                                <div class="col-sm-10 no-padding-left">
                                                    <input type="text" value="" class="slider form-control" data-slider-min="0" data-slider-max="12"
                                                           data-slider-step="1" data-slider-value="[6,10]" data-slider-orientation="horizontal"
                                                           data-slider-selection="before" data-slider-tooltip="show" data-slider-id="blue">
                                                </div>
                                                <label class="col-sm-2 no-padding-right no-padding-left">/ tháng</label>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddFacility"
                                                   class="col-sm-3 control-label">Trang thiết bị hiện đại</label>
                                            <div class="col-sm-9 padding-top-7">
                                                <div class="row">
                                                    <div class="col-sm-12 box-example-movie">
                                                        <select class="example-movie" name="rating" autocomplete="off">
                                                            <option value="1">1 điểm</option>
                                                            <option value="2">2 điểm</option>
                                                            <option value="3" selected="selected">3 điểm</option>
                                                            <option value="4">4 điểm</option>
                                                            <option value="5">5 điểm</option>
                                                            <option value="6">6 điểm</option>
                                                            <option value="7">7 điểm</option>
                                                            <option value="8">8 điểm</option>
                                                            <option value="9">9 điểm</option>
                                                            <option value="10">10 điểm</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 no-padding-left">
                                                    <div class="facility-item">
                                                        <label>
                                                            <input type="checkbox" name="" class="minimal">
                                                            Camera
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="" class="minimal">
                                                            Elevator
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="" class="minimal">
                                                            Tivi
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 no-padding-right">
                                                    <div class="facility-item">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddFacility"
                                                   class="col-sm-3 control-label">Chăm sóc Sức khỏe</label>
                                            <div class="col-sm-9 padding-top-7">
                                                <div class="row">
                                                    <div class="col-sm-12 box-example-movie">
                                                        <select class="example-movie" name="rating" autocomplete="off">
                                                            <option value="1">1 điểm</option>
                                                            <option value="2">2 điểm</option>
                                                            <option value="3" selected="selected">3 điểm</option>
                                                            <option value="4">4 điểm</option>
                                                            <option value="5">5 điểm</option>
                                                            <option value="6">6 điểm</option>
                                                            <option value="7">7 điểm</option>
                                                            <option value="8">8 điểm</option>
                                                            <option value="9">9 điểm</option>
                                                            <option value="10">10 điểm</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 no-padding-left">
                                                    <div class="facility-item">
                                                        <label>
                                                            <input type="checkbox" name="" class="minimal">
                                                            Physical care
                                                        </label>
                                                        <label>
                                                            <input type="checkbox" name="" class="minimal">
                                                            Medical care
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 no-padding-right">
                                                    <div class="facility-item">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddFacilityAdditional"
                                                   class="col-sm-3 control-label">Tiện ích bổ sung</label>
                                            <div class="col-sm-9">
                                                <div class="text-right">
                                                    <a class="text-green cursor-pointer" id="addFacility">
                                                        <i class="fa fa-plus-square"></i>
                                                    </a>
                                                </div>
                                                <table class="table table-bordered table-facility">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Tên</th>
                                                        <th scope="col">Nhóm</th>
                                                        <th scope="col">Giá trị</th>
                                                        <th scope="col">Đơn vị</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Phòng Gym</td>
                                                        <td>Cở sở vật chất</td>
                                                        <td><i class="fas fa-check-circle text-green"></i></td>
                                                        <td></td>
                                                        <td>
                                                            <a class="table-action table-action-edit text-green cursor-pointer" data-id="' + data.id + '">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a class="table-action text-red table-action-delete cursor-pointer" data-id="' + data.id + '">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Phí ăn</td>
                                                        <td>Chăm sóc sức khỏe</td>
                                                        <td>2,300,000</td>
                                                        <td>/ tháng</td>
                                                        <td>
                                                            <a class="table-action table-action-edit text-green cursor-pointer" data-id="' + data.id + '">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a class="table-action text-red table-action-delete cursor-pointer" data-id="' + data.id + '">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
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
                <button type="button" class="btn btn-primary" id="addPrevBtn">Trở về</button>
                <button type="button" class="btn btn-primary" id="addNextBtn">Tiếp theo</button>
                <button type="button" class="btn btn-primary" id="addSchoolBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->
<!-- Add modal customer -->
<div class="modal fade" id="modal-event" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    <span id="ttlModal"></span>
                </h4>
            </div>
            <div class="modal-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if(LaravelLocalization::getCurrentLocale() == $properties['regional'])
                                <li class="active"><a class="tab_edit_event" href="#" data-lang="{{$properties['id']}}" data-toggle="tab">{{$properties['native']}}</a></li>
                            @else
                                <li><a class="tab_edit_event" href="#" data-toggle="tab" data-lang="{{$properties['id']}}">{{$properties['native']}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_edit">
                            <form class="form-horizontal" id="EventForm" role="form" data-toggle="validator">
                                <input type="hidden" name="action" id="action">
                                <input type="hidden" name="lang" id="lang">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="name"
                                           class="col-sm-3 control-label">Tên chương trình</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" value=""
                                               required data-required-error="Tên chương trình không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="slug"
                                           class="col-sm-3 control-label">SEO url</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="slug" id="slug" value=""
                                               required data-required-error="SEO url không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="logo" class="col-sm-3 control-label">Ảnh</label>
                                    <div class="col-sm-9">
                                        <div class="logo padding-top-7">
                                            <img id="logoImage" class="profile-user-img img-circle logo-img" src="{{asset('assets/backend/img/avatar.png')}}" alt="Tên chương trình"/>
                                            <input type="file" id="logo" name="logo" style="display: none;" />
                                            <input type="hidden" name="image_hash" id="image_hash" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="type"
                                           class="col-sm-3 control-label">Đối tượng</label>
                                    <div class="col-sm-9">
                                        <div class="col-sm-6 no-padding-left">
                                            <select class="form-control select2" style="width: 100%" id="type" name="type">
                                                <option value="1">Loại trường</option>
                                                <option value="2">Danh sách trường</option>
                                                <option value="3">Tất cả khách hàng</option>
                                                <option value="4">Khách hàng được chọn</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6 no-padding-right">
                                            <select class="form-control select2 col-sm-6" style="width: 100%" id="target"
                                                    name="target[]"
                                                    multiple="multiple">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="date_type"
                                           class="col-sm-3 control-label">Thời gian</label>
                                    <div class="col-sm-9 padding-top-7">
                                        <div class="col-sm-6 no-padding-left">
                                            <label>
                                                <input type="radio" id="date_type_forever" name="date_type" class="minimal" value="1" checked>
                                                Vĩnh viễn
                                            </label>
                                        </div>
                                        <div class="col-sm-6 no-padding-right">
                                            <label>
                                                <input type="radio" id="date_type_period" name="date_type" class="minimal" value="2">
                                                Khoảng thời gian
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="date" name="date">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="discount_type"
                                           class="col-sm-3 control-label">Giảm giá</label>
                                    <div class="col-sm-9 padding-top-7">
                                        <label>
                                            <input type="radio" id="discount_type_percent" name="discount_type" class="minimal" value="1" checked>
                                            Phần trăm
                                        </label>
                                        <label class="margin-left-10">
                                            <input type="radio" id="discount_type_cash" name="discount_type" class="minimal" value="2">
                                            Hiện kim
                                        </label>
                                        <input type="number" class="form-control" name="discount" id="discount" value=""
                                               required data-required-error="Giảm giá không được trống."
                                               data-type-error="Giảm giá phải là định dạng số.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="code"
                                           class="col-sm-3 control-label">Mã giảm giá</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="code" id="code" value=""
                                               required data-required-error="Mã giảm giá không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content"
                                           class="col-sm-3 control-label">Nội dung</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control textarea" name="content" id="content" rows="6"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="position" class="col-sm-3 control-label">Vị trí</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" id="position" name="position" style="width: 100%;">
                                            <option value="1">Đầu trang</option>
                                            <option value="2">Cuối trang</option>
                                            <option value="3">Sidebar</option>
                                            <option value="4">What's new</option>
                                            <option value="5">Home page</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status"
                                           class="col-sm-3 control-label">Hiển thị</label>
                                    <div class="col-sm-9 padding-top-7">
                                        <label>
                                            <input type="checkbox" class="minimal" id="status" name="status">
                                        </label>
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
                <button type="button" class="btn btn-primary" id="EventBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->
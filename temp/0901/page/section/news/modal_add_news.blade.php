<!-- Add modal customer -->
<div class="modal fade" id="modal-news" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Thêm bài viết mới
                </h4>
            </div>
            <div class="modal-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_vn_edit" class="tab_edit_news" data-toggle="tab" data-lang="1">Tiếng việt</a></li>
                        <li><a href="#tab_en_edit" class="tab_edit_news" data-toggle="tab"  data-lang="2">Tiếng anh</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_edit">
                            <form class="form-horizontal" id="addNewsForm" role="form" data-toggle="validator">
                                <input type="hidden" name="action" id="action" value="">
                                <input type="hidden" name="lang" id="lang">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="inputAddName"
                                           class="col-sm-3 control-label">Tên bài viết</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputAddName" id="inputAddName" placeholder="Tên bài viết" value=""
                                               required data-required-error="Tên bài viết không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddSEO"
                                           class="col-sm-3 control-label">SEO url</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputAddSEO" id="inputAddSEO" placeholder="SEO url" value=""
                                               required data-required-error="SEO url không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputKeyWord" class="col-sm-3 control-label">Meta Key word</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputKeyWord" id="inputKeyWord" placeholder="Meta Key word"
                                               required data-required-error="Meta Key word không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription" class="col-sm-3 control-label">Meta description</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputDescription" id="inputDescription" placeholder="Meta description"
                                               required data-required-error="Meta description không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddContent"
                                           class="col-sm-3 control-label">Nội dung</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control textarea" name="inputAddContent" id="inputAddContent" rows="6"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ckbLayout"
                                           class="col-sm-3 control-label">Layout</label>
                                    <div class="col-sm-9">
                                        <div class="col-sm-6 no-padding-left">
                                            <select class="form-control select2" style="width: 100%;" id="inputAddLayout" name="inputAddLayout"
                                                    required data-required-error="Chọn layout không được trống.">
                                                    @foreach ($layout as $key => $val)
                                                        <option value="{{$val->id}}">{{$val->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddStatus"
                                           class="col-sm-3 control-label">Hiển thị trang chủ</label>
                                    <div class="col-sm-9 padding-top-7">
                                        <input type="checkbox" name="addStatus" id="addStatus" class="minimal">
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
                <button type="button" class="btn btn-primary" id="addNewsBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->
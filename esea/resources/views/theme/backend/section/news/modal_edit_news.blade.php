<!-- Edit modal employee -->
<div class="modal fade" id="modal-news-edit" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child" id="ttlModal"></i>
                </h4>
            </div>
            <div class="modal-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if(LaravelLocalization::getCurrentLocale() == $properties['regional'])
                                <li class="active"><a class="tab_edit_news" href="#tab_vn_edit" data-id="" data-lang="{{$properties['id']}}" data-toggle="tab">{{$properties['native']}}</a></li>
                            @else
                                <li><a class="tab_edit_news" href="#tab_en_edit" data-toggle="tab" data-id="" data-lang="{{$properties['id']}}">{{$properties['native']}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_edit">
                            <form class="form-horizontal" id="editNewsForm" role="form" data-toggle="validator">
                                <input type="hidden" name="action" id="action">
                                <input type="hidden" name="lang" id="lang">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="inputEditName"
                                           class="col-sm-3 control-label">Tên bài viết</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputEditName" id="inputEditName" placeholder="Tên bài viết" value=""
                                               required data-required-error="Tên bài viết không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEditSEO"
                                           class="col-sm-3 control-label">SEO url</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputEditSEO" id="inputEditSEO" placeholder="SEO url" value=""
                                               required data-required-error="SEO url không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputKeyWord" class="col-sm-3 control-label">Meta Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputTitle" id="inputTitle" placeholder="Meta Key word"
                                               required data-required-error="Meta Title không được trống.">
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
                                    <label for="inputEditContent"
                                           class="col-sm-3 control-label">Nội dung</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control textarea" name="inputEditContent" id="inputEditContent" rows="6"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ckbLayout"
                                           class="col-sm-3 control-label">Layout</label>
                                    <div class="col-sm-9">
                                        <div class="col-sm-6 no-padding-left">
                                            <select class="form-control select2" style="width: 100%;" id="inputEditLayout" name="inputEditLayout"
                                                    required data-required-error="Chọn layout không được trống.">
                                                @foreach($layout as $key => $val)
                                                    <option value="{{$val->id}}">{{$val->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEditStatus"
                                           class="col-sm-3 control-label">Hiển thị trang chủ</label>
                                    <div class="col-sm-9 padding-top-7">
                                        <input type="checkbox" id="editStatus" name="editStatus" class="minimal">
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
                <button type="button" class="btn btn-primary" id="editNewsBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Edit modal employee  -->
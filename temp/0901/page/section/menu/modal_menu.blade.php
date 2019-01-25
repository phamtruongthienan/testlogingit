<!-- Add modal menu -->
<div class="modal fade" id="modal-menu" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Thêm menu mới
                </h4>
            </div>
            <div class="modal-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_vn_edit" class="tab_edit" data-toggle="tab" data-lang="1">Tiếng việt</a></li>
                        <li><a href="#tab_en_edit" class="tab_edit" data-toggle="tab" data-lang="2">Tiếng anh</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_edit">
                            <form class="form-horizontal" id="addMenuForm" role="form" data-toggle="validator">
                                <input type="hidden" name="action" id="action" value="">
                                <input type="hidden" name="lang" id="lang">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="inputAddName"
                                           class="col-sm-3 control-label">Tên menu</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="inputAddName" id="inputAddName" value=""
                                               required data-required-error="Tên menu không được trống.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddPosition"
                                           class="col-sm-3 control-label">Vị trí</label>
                                    <div class="col-sm-9">
                                        <div class="col-sm-6 no-padding-left">
                                            <select class="form-control select2" style="width: 100%;" id="inputAddPosition" name="inputAddPosition">
                                                <option value="1">Header Menu</option>
                                                <option value="2">Sidebar Menu</option>
                                                <option value="3">Footer Menu</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ckbLink"
                                           class="col-sm-3 control-label">Link</label>
                                    <div class="col-sm-9 padding-top-7">
                                        <input type="radio" name="addLink" class="minimal" id="inputLink" value="1">
                                    </div>
                                </div>
                                <div id="ckbLink">
                                    <div class="form-group">
                                        <label for="ckbLink"
                                               class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="inputAddLink" id="inputAddLink" value=""
                                                   required data-required-error="Link không được trống.">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ckbSelect"
                                           class="col-sm-3 control-label">Chọn bài viết</label>
                                    <div class="col-sm-9 padding-top-7">
                                        <input type="radio" name="addLink" class="minimal" id="inputSelect" value="2">
                                    </div>
                                </div>
                                <div id="ckbSelect">
                                    <div class="form-group">
                                        <label for="ckbSelect"
                                               class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9">
                                            <div class="col-sm-6 no-padding-left">
                                                <select class="form-control select2" style="width: 100%;" name="inputAddSelect" id="inputAddSelect"
                                                    required data-required-error="Chọn bài viết không được trống.">
                                                    @foreach ($news as $key => $val)
                                                        <option value="{{$val->id}}">{{$val->mNewsTranslations[0]->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
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
                <button type="button" class="btn btn-primary" id="addMenuBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal menu  -->
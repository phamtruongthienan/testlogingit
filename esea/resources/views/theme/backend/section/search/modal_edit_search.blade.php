<!-- Edit modal employee -->
<div class="modal fade" id="modal-search-edit" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Cập nhật tìm kiếm
                </h4>
            </div>
            <div class="modal-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_vn_edit" data-toggle="tab">Tiếng việt</a></li>
                        <li><a href="#tab_en_edit" data-toggle="tab">Tiếng anh</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_edit">
                            <form class="form-horizontal" id="editSearchForm" role="form" data-toggle="validator">
                                <div class="form-group">
                                    <label for="inputEditName"
                                           class="col-sm-2 control-label">Từ khóa</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="inputEditKey[]" id="tagKey" multiple="multiple"
                                                style="width: 100%">
                                            <option selected="selected">Kerry</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="nav-tabs-custom posr">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_type_priority_edit" data-toggle="tab">Loại ưu tiên</a></li>
                                        <li><a href="#tab_list_school_edit" data-toggle="tab">Danh sách trường</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_type_priority_edit">
                                            @include('theme.backend.section.search.tab_priority')
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_list_school_edit">
                                            @include('theme.backend.section.search.tab_school')
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
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
                <button type="button" class="btn btn-primary" id="editSearchBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Edit modal employee  -->
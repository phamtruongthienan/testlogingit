<!-- Add modal employee -->
<div class="modal fade" id="modal-typePriority" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    <span class="ttlModal"></span>
                </h4>
            </div>
            <div class="modal-body">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @if(LaravelLocalization::getCurrentLocale() == $properties['regional'])
                                <li class="active"><a href="#" class="tab_edit_keyword_prioty" data-lang="{{$properties['id']}}" data-toggle="tab">{{$properties['native']}}</a></li>
                            @else
                                <li><a href="#" class="tab_edit_keyword_prioty" data-lang="{{$properties['id']}}" data-toggle="tab">{{$properties['native']}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_add">
                            <form class="form-horizontal" id="TypePriorityForm" role="form" data-toggle="validator">
                                <input type="hidden" name="action" class="action">
                                <input type="hidden" name="lang" class="lang">
                                <input type="hidden" name="keyword_id" class="keyword_id">
                                <input type="hidden" name="id" class="id">
                                <input type="hidden" name="table" class="table">
                                <div class="form-group">
                                    <label for="type"
                                           class="col-sm-2 control-label">Loại</label>
                                    <div class="col-sm-10">
                                        <div class="col-sm-6 no-padding-left">
                                            <select class="form-control single-select2" id="type" name="type"
                                                    required data-required-error="Loại ưu tiên không được trống." style="width: 100%">
                                                <option value="1">Khu vực</option>
                                                <option value="2">Loại trường</option>
                                                <option value="3">Cấp trường</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-sm-6 no-padding-right">
                                            <select class="form-control single-select2" id="typename" name="typename"
                                                    required data-required-error="Tên ưu tiên không được trống." style="width: 100%">
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status"
                                           class="col-sm-2 control-label">Hiển thị</label>
                                    <div class="col-sm-10 padding-top-7">
                                        <input type="checkbox" id="status" name="status" class="minimal">
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
                <button type="button" class="btn btn-primary" id="TypePriorityBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->
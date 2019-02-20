<!-- Add modal school -->
<div class="modal fade" id="modal-school" data-backdrop="static">
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
                                <li class="active"><a href="#" class="tab_edit_keyword_school" data-lang="{{$properties['id']}}" data-toggle="tab">{{$properties['native']}}</a></li>
                            @else
                                <li><a href="#" class="tab_edit_keyword_school" data-lang="{{$properties['id']}}" data-toggle="tab">{{$properties['native']}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_add">
                            <form class="form-horizontal" id="SchoolForm" role="form" data-toggle="validator">
                                <input type="hidden" name="action" class="action">
                                <input type="hidden" name="lang" class="lang">
                                <input type="hidden" name="keyword_id" class="keyword_id">
                                <input type="hidden" name="id" class="id">
                                <input type="hidden" name="table" class="table">
                                <div class="form-group">
                                    <label for="school_id"
                                           class="col-sm-2 control-label">Tên trường</label>
                                    <div class="col-sm-10">
                                        <select class="form-control single-select2" id="school_id" name="school_id"
                                                required data-required-error="Tên trường không được trống." style="width: 100%">
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sort"
                                           class="col-sm-2 control-label">Thứ tự</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="sort" name="sort" value=""
                                               required data-required-error="Thứ tự không được trống.">
                                        <div class="help-block with-errors"></div>
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
                <button type="button" class="btn btn-primary" id="SchoolBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->
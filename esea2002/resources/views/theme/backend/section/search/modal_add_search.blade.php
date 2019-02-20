<!-- Add modal search -->
<div class="modal fade" id="modal-search" data-backdrop="static">
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
                                <li class="active"><a href="#" class="tab_edit_keyword" data-lang="{{$properties['id']}}" data-toggle="tab">{{$properties['native']}}</a></li>
                            @else
                                <li><a href="#" class="tab_edit_keyword" data-lang="{{$properties['id']}}" data-toggle="tab">{{$properties['native']}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_vn_add">
                            <form class="form-horizontal" id="SearchForm" role="form" data-toggle="validator">
                                <input type="hidden" name="action" class="action">
                                <input type="hidden" name="lang" class="lang">
                                <input type="hidden" name="id" class="id">
                                <input type="hidden" name="table" class="table">
                                <div class="form-group">
                                    <label for="name"
                                           class="col-sm-2 control-label">Từ khóa</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="name[]" id="name" multiple="multiple"
                                                style="width: 100%" data-required-error="Từ khóa không được trống." required>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="nav-tabs-custom posr">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_type_priority" data-toggle="tab">Loại ưu tiên</a></li>
                                        <li><a href="#tab_list_school" data-toggle="tab">Danh sách trường</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_type_priority">
                                            @include('theme.backend.section.search.tab_priority')
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_list_school">
                                            @include('theme.backend.section.search.tab_school')
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                                <!-- nav-tabs-custom -->
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
                <button type="button" class="btn btn-primary" id="SearchBtn"
                        data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
                    <i class="fas fa-plus"></i> Lưu</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Add modal employee  -->
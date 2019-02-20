<div class="tab-pane" id="language">
    <div class="alert alert-danger alert-dismissible" id="error_msg" style="display:none"></div>
    <div class="control-row table-responsive">
        <table class="table table-bordered table-striped table-dynamic table-dynamic-language nowrap"
               cellspacing="0" width="100%">
            <thead>
            <tr>
                <th class="text-center" width="100px">ID</th>
                <th class="text-center">Tên</th>
                <th class="text-center" width="100px">Mã code</th>
                <th class="text-center" width="150px">Mặc định</th>
                <th class="text-center" width="150px">Tiền tệ</th>
                <th class="text-center" width="150px">Ngày tháng</th>
                <th class="text-center" width="200px"></th>
            </tr>
            </thead>
        </table>
    </div>
    @include('theme.backend.section.setting.language.modal_edit_language')
</div>
<!-- /.tab-pane -->
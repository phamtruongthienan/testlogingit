<!-- Edit modal city -->
<div class="modal fade" id="modal-city-edit" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Cập nhật tỉnh
                </h4>
            </div>
            <div class="modal-body">
                <div class="nav-tabs-custom posr">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_city" data-toggle="tab">Tỉnh/Thành phố</a></li>
                        <li><a href="#tab_district" data-toggle="tab">Quận/Huyện</a></li>
                        <li><a href="#tab_ward" data-toggle="tab">Phường/Xã</a></li>
                        <li class="dropdown">
                    </ul>
                    <div class="tab-content">
                        @include('theme.backend.section.place.tab_city')
                        @include('theme.backend.section.place.tab_district')
                        @include('theme.backend.section.place.tab_ward')
                    </div>
                    <!-- /.tab-content -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">Thoát</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Edit modal city  -->
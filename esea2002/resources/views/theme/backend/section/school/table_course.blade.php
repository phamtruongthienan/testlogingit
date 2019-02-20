<!-- List modal course -->
<div class="modal fade" id="modal-course-list" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Danh sách khóa học
                </h4>
            </div>
            <div class="modal-body">
                <div class="text-right">
                <a class="text-green cursor-pointer" data-school-id="" data-lang="{{LaravelLocalization::getCurrentLocaleID()}}" id="addCourse">
                        <i class="fa fa-plus-square"></i>
                    </a>
                </div>
                <div class="control-row table-responsive">
                    <table class="table table-bordered table-striped table-dynamic table-dynamic-course nowrap"
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="text-center" width="100px">ID</th>
                            <th class="text-center">Tên</th>
                            <th class="text-center" width="200px">Miêu tả</th>
                            <th class="text-center" width="200px">Ngày mở</th>
                            <th class="text-center" width="200px">Ngày kết thúc</th>
                            <th class="text-center" width="100px">Sỉ số</th>
                            <th class="text-center" width="100px">Chương trình học</th>
                            <th class="text-center" width="100px"></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left"
                        data-dismiss="modal">Thoát</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- List modal course  -->
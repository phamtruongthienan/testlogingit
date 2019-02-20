<!-- List modal program -->
<div class="modal fade" id="modal-program-list" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fas fa-child"></i>
                    Danh sách chương trình học
                </h4>
            </div>
            <div class="modal-body">
                <div class="text-right">
                    <a class="text-green cursor-pointer" data-school-id="" data-course-id="" data-lang="{{LaravelLocalization::getCurrentLocaleID()}}" id="addProgram">
                            <i class="fa fa-plus-square"></i>
                        </a>
                </div>
                <div class="control-row table-responsive">
                    <table class="table table-bordered table-striped table-dynamic table-dynamic-program nowrap"
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="text-center" width="100px">ID</th>
                            <th class="text-center">Tên giáo trình</th>
                            <th class="text-center" width="150px">Thời gian</th>
                            <th class="text-center" width="150px">Phí</th>
                            <th class="text-center" width="200px"></th>
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
<!-- List modal program  -->
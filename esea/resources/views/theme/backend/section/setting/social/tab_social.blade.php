<div class="tab-pane" id="social">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible no-display" id="alert_social_msg">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i> Thêm thông tin mạng xã hội thành công.
            </div>
            <div class="alert alert-success alert-dismissible no-display" id="alert_social_msg_edit">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i> Cập nhật thông tin mạng xã hội thành công.
            </div>
        </div>
    </div>
    <!-- row -->
    <form class="form-horizontal" id="socialForm" role="form" data-toggle="validator">
        <div class="box-body">
            <div class="form-group">
                <label for="inputFaceID" class="col-sm-2 control-label">Facebook App ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputFaceID" placeholder="Facebook App ID">
                </div>
            </div>
            <div class="form-group">
                <label for="inputFaceSecret" class="col-sm-2 control-label">Facebook App Secret</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputFaceSecret" placeholder="Facebook App Secret">
                </div>
            </div>
            <div class="form-group">
                <label for="inputFaceURL" class="col-sm-2 control-label">Facebook APP CALLBACK URL</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputFaceURL" placeholder="Facebook APP CALLBACK URL">
                </div>
            </div>
            <div class="form-group">
                <label for="inputGoogleID" class="col-sm-2 control-label">Google App ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputGoogleID" placeholder="Google App ID">
                </div>
            </div>
            <div class="form-group">
                <label for="inputGoogleSecret" class="col-sm-2 control-label">Google App Secret</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputGoogleSecret" placeholder="Google App Secret">
                </div>
            </div>
            <div class="form-group">
                <label for="inputGoogleURL" class="col-sm-2 control-label">Google APP CALLBACK URL</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputGoogleURL" placeholder="Google APP CALLBACK URL">
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="addSocialBtn">Lưu</button>
                    <button type="reset" class="btn btn-default">Thoát</button>
                </div>
            </div>
        </div>
        <!-- /.box-footer -->
    </form>
</div>
<!-- /.tab-pane -->
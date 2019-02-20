<div class="tab-pane" id="social">
    <form class="form-horizontal" id="socialForm" role="form" data-toggle="validator">
        <input class="action" name="action" value="update" type="hidden">
        <input class="table" name="table" value="other" type="hidden">
        <input class="id" name="id" type="hidden" value="1">
        <div class="box-body">
            <div class="form-group">
                <label for="FB_APP_ID" class="col-sm-2 control-label">Facebook App ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="FB_APP_ID" name="FB_APP_ID" placeholder="Facebook App ID">
                </div>
            </div>
            <div class="form-group">
                <label for="FB_APP_KEY" class="col-sm-2 control-label">Facebook App Secret</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="FB_APP_KEY" name="FB_APP_KEY" placeholder="Facebook App Secret">
                </div>
            </div>
            <div class="form-group">
                <label for="FB_APP_CALLBACK" class="col-sm-2 control-label">Facebook APP CALLBACK URL</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="FB_APP_CALLBACK" name="FB_APP_CALLBACK"
                           placeholder="Facebook APP CALLBACK URL">
                </div>
            </div>
            <div class="form-group">
                <label for="GG_APP_ID" class="col-sm-2 control-label">Google App ID</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="GG_APP_ID" name="GG_APP_ID" placeholder="Google App ID">
                </div>
            </div>
            <div class="form-group">
                <label for="GG_APP_KEY" class="col-sm-2 control-label">Google App Secret</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="GG_APP_KEY" name="GG_APP_KEY" placeholder="Google App Secret">
                </div>
            </div>
            <div class="form-group">
                <label for="GG_APP_CALLBACK" class="col-sm-2 control-label">Google APP CALLBACK URL</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="GG_APP_CALLBACK" name="GG_APP_CALLBACK" placeholder="Google APP CALLBACK URL">
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
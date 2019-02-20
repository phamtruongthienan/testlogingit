<div class="tab-pane" id="seo">
    <!-- Custom Tabs -->
    <!-- <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_vn" data-toggle="tab">Tiếng việt</a></li>
            <li><a href="#tab_en" data-toggle="tab">Tiếng anh</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_vn">     -->
    <form class="form-horizontal" id="seoForm" role="form" data-toggle="validator">
        <input class="action" name="action" value="update" type="hidden">
        <input class="table" name="table" value="main" type="hidden">
        <input class="id" name="id" type="hidden">
        <div class="box-body">
            <div class="form-group">
                <label for="enable_ssl" class="col-sm-2 control-label">Cấu hình site</label>
                <div class="col-sm-10 padding-top-7">
                    <label>
                        <input type="checkbox" class="minimal" id="enable_ssl" name="enable_ssl">
                        HTTPS
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="meta_title" class="col-sm-2 control-label">Meta Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta title"
                           required data-required-error="Meta title không được trống.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="meta_keyword" class="col-sm-2 control-label">Meta Key word</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="Meta Key word"
                           required data-required-error="Meta Key word không được trống.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="meta_description" class="col-sm-2 control-label">Meta description</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta description"
                           required data-required-error="Meta description không được trống.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="analytics_id" class="col-sm-2 control-label">Tracking ID google analytics</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="analytics_id" name="analytics_id"
                           placeholder="Tracking ID google analytics">
                </div>
            </div>
            <div class="form-group">
                <label for="facebook_page" class="col-sm-2 control-label">Facebook Fanpage</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="facebook_page" name="facebook_page" placeholder="Facebook Fanpage">
                </div>
            </div>
            <div class="form-group">
                <label for="googleplus_page" class="col-sm-2 control-label">Google Plus</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="googleplus_page" name="googleplus_page" placeholder="Google Plus">
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="SeoBtn">Lưu</button>
                    <button type="reset" class="btn btn-default">Thoát</button>
                </div>
            </div>
        </div>
        <!-- /.box-footer -->
    </form>
    <!-- </div> -->
    <!-- /.tab-pane -->
    <!-- </div> -->
    <!-- /.tab-content -->
    <!-- </div> -->
    <!-- nav-tabs-custom -->
</div>
<!-- /.tab-pane -->
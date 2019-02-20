<!-- Edit modal account -->
<div class="modal fade" id="modal-account-edit" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">
					<i class="fas fa-globe" id="ttlModal"></i>
				</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="editAccountForm" role="form" data-toggle="validator">
					<input type="hidden" name="action" id="action">
					<input type="hidden" name="lang" id="lang">
					<input type="hidden" name="id" id="id">
					<div class="form-group">
						<label for="inputEditSMTP"
									 class="col-sm-3 control-label">SMTP server</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="inputEditSMTP" id="inputEditSMTP" value=""
										 required data-required-error="SMTP server không được trống.">
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEditUserName"
									 class="col-sm-3 control-label">Email</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="inputEditUserName" id="inputEditUserName" value=""
										 required data-error="Email không được trống.">
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEditPassWord"
									 class="col-sm-3 control-label">Password</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" name="inputEditPassWord" id="inputEditPassWord" value=""
							data-error="Password không được trống.">
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEditPassWord"
									 class="col-sm-3 control-label">rePassword</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" name="inputEditrePassWord" id="inputEditrePassWord" value="" data-error="Mật khẩu không được trống.">
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEditPort"
									 class="col-sm-3 control-label">Port</label>
						<div class="col-sm-9">
							<input type="number" class="form-control" name="inputEditPort" id="inputEditPort" value=""
										 required data-required-error="Port không được trống." data-type-error="Port phải là định dạng số.">
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEditProtocal"
									 class="col-sm-3 control-label">Protocal</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="inputEditProtocal" id="inputEditProtocal" value=""
										 required data-error="Protocal không được trống.">
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEditSender"
									 class="col-sm-3 control-label">Sender name</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="inputEditSender" id="inputEditSender" value=""
										 required data-error="Sender name không được trống.">
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group defaultBtn">
						<label for="inputEditDefault"
									 class="col-sm-3 control-label">Mặc định</label>
						<div class="col-sm-9 padding-top-7"> 
							<input type="checkbox" name="default" id="default" class="minimal">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left"
								data-dismiss="modal">Thoát</button>
				<button type="button" class="btn btn-primary" id="editAccountBtn"
								data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
					<i class="fas fa-plus"></i> Lưu</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- Edit modal account  -->
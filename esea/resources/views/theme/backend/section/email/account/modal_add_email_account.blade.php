<!-- Add modal account -->
<div class="modal fade" id="modal-account-add" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">
					<i class="fas fa-globe"></i>
					Thêm thông tin account
				</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" id="addAccountForm" role="form" data-toggle="validator">
					<div class="form-group">
						<label for="inputAddSMTP"
									 class="col-sm-3 control-label">SMTP server</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="inputAddSMTP" value=""
										 required data-required-error="SMTP server không được trống.">
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="inputAddPort"
									 class="col-sm-3 control-label">Port</label>
						<div class="col-sm-9">
							<input type="number" class="form-control" name="inputAddPort" value=""
										 required data-required-error="Port không được trống." data-type-error="Port phải là định dạng số.">
							<div class="help-block with-errors"></div>
						</div>
					</div><div class="form-group">
						<label for="inputAddUserName"
									 class="col-sm-3 control-label">Username</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="inputAddUserName" value=""
										 required data-error="Tên đăng nhập không được trống.">
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="inputAddPassWord"
									 class="col-sm-3 control-label">Password</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" name="inputAddPassWord" id="inputAddPassWord" value=""
										 required data-error="Mật khẩu không được trống.">
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="inputAddProtocal"
									 class="col-sm-3 control-label">Protocal</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="inputAddProtocal" id="inputAddProtocal" value=""
										 required data-error="Protocal không được trống.">
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="inputAddSender"
									 class="col-sm-3 control-label">Sender name</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="inputAddSender" id="inputAddSender" value=""
										 required data-error="Sender name không được trống.">
							<div class="help-block with-errors"></div>
						</div>
					</div>
					<div class="form-group">
						<label for="inputAddDefault"
									 class="col-sm-3 control-label">Mặc định</label>
						<div class="col-sm-9 padding-top-7">
							<input type="checkbox" name="default" class="minimal">
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left"
								data-dismiss="modal">Thoát</button>
				<button type="button" class="btn btn-primary" id="addAccountBtn"
								data-loading-text="<i class='fa fa-spinner fa-spin '></i> ">
					<i class="fas fa-plus"></i> Lưu</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- Add modal account  -->
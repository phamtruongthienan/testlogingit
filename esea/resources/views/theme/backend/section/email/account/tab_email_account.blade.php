<div class="tab-pane active" id="account">
	<a class="text-green cursor-pointer posa" id="addAccount">
		<i class="fa fa-plus-square"></i>
	</a>
	<div class="alert alert-danger alert-dismissible" id="error_msg" style="display:none"></div>
	<div class="control-row table-responsive">
		<table class="table table-bordered table-striped table-dynamic table-dynamic-account nowrap"
					 cellspacing="0" width="100%">
			<thead>
			<tr>
				<th class="text-center" width="100px">ID</th>
				<th class="text-center">SMTP server</th>
				<th class="text-center" width="100px">Port</th>
				<th class="text-center" width="150px">Username</th>
				<th class="text-center" width="150px">Protocal</th>
				<th class="text-center" width="150px">Sender name</th>
				<th class="text-center" width="100px">Mặc định</th>
				<th class="text-center" width="200px"></th>
			</tr>
			</thead>
		</table>
	</div>
	@include('theme.backend.section.email.account.modal_add_email_account')
	@include('theme.backend.section.email.account.modal_edit_email_account')
</div>
<!-- /.tab-pane -->
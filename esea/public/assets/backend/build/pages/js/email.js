var app = app || {};

app.init = function () {
	$('.select2').select2();
	if ($('input[type="radio"], input[type="checkbox"]').length > 0) {
		$('input[type="radio"], input[type="checkbox"]').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue'
		});
	}
	$('[data-mask]').inputmask();

	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	var table_dynamic_account = $('.table-dynamic-account').DataTable({
		"processing": true,
		"ajax": base_admin + "/ajax/email",
		'responsive': true,
		'paging': true,
		'lengthChange': true,
		'searching': true,
		'ordering': true,
		'info': true,
		'autoWidth': true,
		'scrollX': true,
		'scrollCollapse': true,
		"columns": [
			{"data": "id"},
			{"data": "smtp_server"},
			{"data": "smtp_port"},
			{"data": "smtp_username"},
			{"data": "smtp_protocol"},
			{"data": "smtp_name"},
			{"data": "default"},
			{"data": "action"}
		],
		'columnDefs': [
			{
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '150px',
				targets: [3, 4, 5],
				class: 'text-center'
			},
			{
				width: '100px',
				targets: [0, 2, -2],
				class: 'text-center'
			}
		]
	});

	var table_dynamic_email = $('.table-dynamic-email').DataTable({
		"processing": true,
		"ajax": base_admin + "/ajax/emailStatus",
		'responsive': true,
		'paging': true,
		'lengthChange': true,
		'searching': true,
		'ordering': true,
		'info': true,
		'autoWidth': true,
		'scrollX': true,
		'scrollCollapse': true,
		"columns": [
			{"data": "id"},
			{"data": "title"},
			{"data": "content"},
			{"data": "group"},
			{"data": "created_at"},
			{"data": "status"},
			{"data": "action"}
		],
		'columnDefs': [
			{
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '150px',
				targets: [3, 4, 5],
				class: 'text-center'
			},
			{
				width: '100px',
				targets: [0],
				class: 'text-center'
			},
			{
				width: '300px',
				targets: [2]
			}
		]
	});

	$('#editAccountForm').validator().on('submit', function (e) {
		$('#editAccountBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				app.submitForm(table_dynamic_account);
				$('#modal-account-edit').modal('hide');
				$('#editAccountBtn').button('reset');
		} else {
				$('#editAccountBtn').button('reset');
		}
	});

	app.submitForm = function (table_dynamic_account) {
		$.ajax({
			url: base_admin + "/ajax/email",
			data: $('#editAccountForm').serialize(),
			type: "post",
			success: function (response) {
					if (response.code == '200') {	
						table_dynamic_account.ajax.reload(null, true);
						$('#alert_msg_edit').removeClass('no-display');
						$('#editAccountBtn').button('reset');
						Lobibox.notify("success", {
							title: 'Thông báo',
							pauseDelayOnHover: false,
							continueDelayOnInactiveTab: false,
							icon: false,
							sound: false,
							msg: 'Thay đổi thông tin thành công'
						});
						$('#confirm-delete-modal').modal('hide');
					} else {
						Lobibox.notify("warning", {
							title: 'Thông báo',
							pauseDelayOnHover: false,
							continueDelayOnInactiveTab: false,
							icon: false,
							sound: false,
							msg: 'Có lỗi xảy ra'
						});
					}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				Lobibox.notify("warning", {
					title: 'Thông báo',
					pauseDelayOnHover: false,
					continueDelayOnInactiveTab: false,
					icon: false,
					sound: false,
					msg: 'Có lỗi xảy ra'
				});
			}
		});
	}

	$(document).on('click', '.table-action-delete', function (e) {
		e.preventDefault();
		$('#modal-account-edit #id').val($(this).data('id'));
		var lang = $(this).attr('data-lang');
        app.clearForm('delete');
		var row = $(this);
		var table = $(this).parents('table').DataTable();
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		}).one('click', '#confirm-delete', function (e) {
				app.submitForm(table_dynamic_account);
		});
	});

	$('#modal-account-edit').on('blur', '#inputEditPassWord', function() {
		if($(this).val()) {
			$(this).parents('.form-group').next().find('#inputEditrePassWord').prop('required',true);
			$('#editAccountForm').validator('update');
		}
	});	

	$(document).on('click', '.table-action-edit', function (e) {
		e.preventDefault();
		app.clearForm('update');
		$('#modal-account-edit #ttlModal').html(" Cập nhật thông tin account");
		$('#modal-account-edit .defaultBtn').show();
		var id = $(this).data('id');
		$('#modal-account-edit #inputEditSMTP').prop('required',false);
		$('#modal-account-edit #inputEditrePassWord').prop('required',false);
		$('#modal-account-edit #inputEditPort').prop('required',false);
		$('#modal-account-edit #inputEditUserName').prop('required',false);
		$('#modal-account-edit #inputEditProtocal').prop('required',false);
		$('#modal-account-edit #inputEditSender').prop('required',false);
        $('#modal-account-edit').validator('validate');
        $('#modal-account-edit #inputEditSMTP').prop('required',true);
		$('#modal-account-edit #inputEditPort').prop('required',true);
		$('#modal-account-edit #inputEditUserName').prop('required',true);
		$('#modal-account-edit #inputEditProtocal').prop('required',true);
		$('#modal-account-edit #inputEditSender').prop('required',true);
        $('#modal-account-edit').validator('update');
		$.ajax({
			url: base_admin + "/ajax/email?id=" + id,
			type: "get",
			success: function (response) {
					if (response.code == '200') {	
							$('#modal-account-edit #id').val(response.data[0].id);
							$('#modal-account-edit #inputEditSMTP').val(response.data[0].smtp_server);
							$('#modal-account-edit #inputEditPort').val(response.data[0].smtp_port);
							$('#modal-account-edit #inputEditUserName').val(response.data[0].smtp_username);
							$('#modal-account-edit #inputEditProtocal').val(response.data[0].smtp_protocol);
							$('#modal-account-edit #inputEditSender').val(response.data[0].smtp_name);
							if(response.data[0].default == true){
								$('#modal-account-edit #default').iCheck('check');
							} else {
								$('#modal-account-edit #default').iCheck('uncheck');
							}
							$('#modal-account-edit').modal('show');
					} else {
							$('#error-modal').modal('show');
					}
			},
			error: function (jqXHR, textStatus, errorThrown) {
					$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
			}
		});
	});

	$(document).on('click', '#addAccount', function (e) {
		e.preventDefault();
		app.clearForm('insert');
		$('#modal-account-edit .defaultBtn').hide();
		$('#modal-account-edit #ttlModal').html(" Tạo mới account");
		$('#modal-account-edit').modal('show');
	});

	$(document).on('click', '#editAccountBtn', function (e) {
		e.preventDefault();
		$('#editAccountForm').submit();
	});

	$(document).on('click', '#SelectAllBtn', function (e) {
		e.preventDefault();
		$(".select-email > option").prop("selected", "selected");
		$(".select-email").trigger("change");
	});

	$(document).on('click', '#UnselectAllBtn', function (e) {
		e.preventDefault();
		$(".select-email").val(null).trigger("change");
	});
}

app.clearForm = function (action) {
	$('#editAccountForm')[0].reset();
	$('#modal-account-edit #action').val(action);
	$('#modal-account-edit #default').iCheck('update');
}

$(function() {
	app.init();
});
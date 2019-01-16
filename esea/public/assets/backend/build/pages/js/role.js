var app = app || {};

app.init = function () {

	$('.select2').select2({
		placeholder: 'Chọn quyền'
	});
	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});
	$.fn.validator.Constructor.INPUT_SELECTOR = ':input:not([type="submit"], button):enabled';

	var table_dynamic_role = $('.table-dynamic-role').DataTable({
		"processing": true,
		"ajax": base_admin + "/ajax/role",
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
			{"data": "name"},
			{"data": "display_name"},
			{"data": "description"},
			{"data": "action"}
		],
		'columnDefs': [
			{
				targets: [2],
				class: 'text-center'
			},
			{
				targets: [3],
				class: 'text-center'
			},
			{
				width: '200px',
				targets: [-1, 1],
				class: 'text-center'
			},
			{
				width: '100px',
				targets: [0],
				class: 'text-center'
			},
		]		
	});

	$(document).on('click', '.table-action-delete', function (e) {
		e.preventDefault();
		app.clearForm('delete');
		$('#modal-role-edit #id').val($(this).data('id'));
		var row = $(this);
		var table = $(this).parents('table').DataTable();
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		}).one('click', '#confirm-delete', function (e) {
				app.submitForm(table_dynamic_role);
		});
	});

	$(document).on('click', '.table-dynamic-role .table-action-edit', function (e) {
		e.preventDefault();
		app.clearForm('update');
		var id = $(this).data('id');
		$.ajax({
				url: base_admin + "/ajax/role?id=" + id,
				type: "get",
				success: function (response) {
					if (response.code == '200') {	
						var listPermisstion = [];
						$.each(response.data.permissions, function(i, item) {
							listPermisstion.push(item.id);
						});
						$('#modal-role-edit #id').val(response.data.id);
						$('#modal-role-edit #edit_permission').val(listPermisstion).trigger('change');
						$('#modal-role-edit #inputEditNameDisplay').val(response.data.display_name);
						$('#modal-role-edit #inputEditName').html(response.data.name);
						$('#modal-role-edit #edit_description').val(response.data.description);
						$('#modal-role-edit').modal('show');
					} else {
						$('#error-modal').modal('show');
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
						$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
				}
		});
	});

	$(document).on('click', '#addRole', function (e) {
		e.preventDefault();
		app.clearForm('insert');
		$('#modal-role-edit').modal('show');	
	});

	$(document).on('click', '#editRoleBtn', function (e) {
		e.preventDefault();
		$('#editRoleForm').submit();
	});

	$(document).on('click', '#SelectAllBtn', function (e) {
		e.preventDefault();
		$(".select-permission > option").prop("selected", "selected");
		$(".select-permission").trigger("change");
	});

	$(document).on('click', '#UnselectAllBtn', function (e) {
		e.preventDefault();
		$(".select-permission").val([]).trigger('change.select2');
	});
	
	$(document).on('click', '#SelectAllBtnEdit', function (e) {
		e.preventDefault();
		$(".select-permission-edit > option").prop("selected", "selected");
		$(".select-permission-edit").trigger("change");
	});

	$(document).on('click', '#UnselectAllBtnEdit', function (e) {
		e.preventDefault();
		$(".select-permission-edit").val(null).trigger("change");
	});

	$('#editRoleForm').validator().on('submit', function (e) {
		$('#editRoleBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				app.submitForm(table_dynamic_role);
				$('#modal-role-edit').modal('hide');
				$('#editRoleBtn').button('reset');
		} else {
				$('#editRoleBtn').button('reset');
		}
	});

	app.submitForm = function (table_dynamic_role) {
		$.ajax({
			url: base_admin + "/ajax/role",
			data: $('#editRoleForm').serialize(),
			type: "POST",
			success: function (response) {
					if (response.code == '200') {	
						table_dynamic_role.ajax.reload(null, true);
						$('#alert_msg_edit').removeClass('no-display');
						$('#editRoleBtn').button('reset');
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
						$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
					}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
			}
		});
	}

	app.clearForm = function (action) {
		$('#modal-role-edit #action').val(action);
		$('#modal-role-edit #id').val('');
		$('#modal-role-edit #inputEditName').html('');
		$('#modal-role-edit #edit_description').val('');
		$('#modal-role-edit #inputEditNameDisplay').val('');
		$('#modal-role-edit #edit_permission').val([]).trigger('change');
	}
}

$(function() {
	app.init();
});
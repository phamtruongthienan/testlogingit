var app = app || {};

app.init = function () {

	$('.modal').on( 'show.bs.modal', function (e) {
		if ($('input[type="radio"], input[type="checkbox"]').length > 0) {
			$('input[type="radio"], input[type="checkbox"]').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
				radioClass: 'iradio_minimal-blue'
			});
		}		
		$('.select2').select2({		
			placeholder: "Chọn vị trí",
			allowClear: true,
		});
	});

	$('[data-mask]').inputmask();

	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	$('#activity-log-modal').on( 'shown.bs.modal', function (e) {
		$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
	});

	$(document).on('click', '.table-action-delete', function (e) {
		e.preventDefault();
		app.clearForm('delete');
		$('#modal-employee #id').val($(this).data('id'));
		var row = $(this);
		var table = $(this).parents('table').DataTable();
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		}).one('click', '#confirm-delete', function (e) {
				app.submitForm(table_dynamic_employee);
		});
	});

	var table_dynamic_employee = $('.table-dynamic-employee').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": base_admin+"/ajax/employee",
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
			{"data": "email"},
			{"data": "name"},
			{"data": "dob"},
			{"data": "phone"},
			{"data": "locked"},
			{"data": "role"},
			{"data": null}
		],
		'columnDefs': [
			{
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '150px',
				targets: [3, 4, 5, 6],
				class: 'text-center'
			},
			{
				width: '100px',
				targets: [0, 2],
				class: 'text-center'
			},
			{
				width: '200px',
				orderable: false,
				targets: [-1],
				class: 'text-center',
				render: function (data, type, row, meta) {
					return '<a' +
							' class="table-action table-action-edit text-green cursor-pointer" data-id="' + data.id + '"><i' +
							' class="fa fa-edit"></i></a>' +
							' <a class="table-action text-red table-action-delete cursor-pointer" data-id="' + data.id + '"><i' +
							' class="fa fa-trash"></i></a>' +
							' <a class="table-action text-aqua table-action-view cursor-pointer" data-id="' + data.id + '"><i' +
							' class="fa fa-eye"></i></a>';
				}
			}
		]		
	});

	$(document).on('click', '.table-action-view', function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			url: base_admin + "/ajax/employee?id=" + id,
			type: "get",
			success: function (response) {
					if (response.code == '200') {	
						var a;
						$.each(response.data.activity, function(i, item) {
							a += '<tr><td>'+item.id+'</td><td>'+item.created_at+'</td><td>'+item.description+'<td></tr>';
						});
						$('#activity').html(a);
						$('#activity-log-modal').modal('show');
					} else {
						$('#error-modal').modal('show');
					}
			},
			error: function (jqXHR, textStatus, errorThrown) {
					$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
			}
	});
	});

	$(document).on('click', '.table-action-edit', function (e) {
		e.preventDefault();
		app.clearForm('update');
		var id = $(this).data('id');
		$('#modal-employee #inputEditName').prop('required',false);
		$('#modal-employee #inputEditBirthday').prop('required',false);
		$('#modal-employee #inputEditPhone').prop('required',false);
        $('#modal-employee').validator('validate');
		$('modal-employee #inputEditName').prop('required',true);
		$('#modal-employee #inputEditBirthday').prop('required',true);
		$('#modal-employee #inputEditPhone').prop('required',true);
        $('#modal-employee').validator('update');
		$.ajax({
				url: base_admin + "/ajax/employee?id=" + id,
				type: "get",
				success: function (response) {
						if (response.code == '200') {	
								$('#modal-employee #id').val(response.data.user.id);
								$('#modal-employee #inputEditUserName').val(response.data.user.email);
								$('#modal-employee #inputEditName').val(response.data.user.name);
								$('#modal-employee #inputEditBirthday').val(response.data.user.dob);
								$('#modal-employee #inputEditPhone').val(response.data.user.phone);
								$('#modal-employee #inputEditPosition').val(response.data.user.role_users[0].role_id).trigger('change');
								console.log(response.data.user.role_users[0].role_id);
								if(response.data.user.locked == 1) {
									$('#modal-employee #status').iCheck('check');
								} else {
									$('#modal-employee #status').iCheck('uncheck');
								}
								$('#modal-employee').modal('show');
						} else {
								$('#error-modal').modal('show');
						}
				},
				error: function (jqXHR, textStatus, errorThrown) {
						$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
				}
		});
	});

	app.submitForm = function (table_dynamic_employee) {
		$.ajax({
			url: base_admin + "/ajax/employee",
			data: $('#editEmployeeForm').serialize(),
			type: "post",
			success: function (response) {
					if (response.code == '200') {	
						table_dynamic_employee.ajax.reload(null, true);
						$('#alert_msg_edit').removeClass('no-display');
						$('#EmployeeBtn').button('reset');
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

	$(document).on('click', '#EmployeeBtn', function (e) {
		e.preventDefault();
		$('#editEmployeeForm').submit();
	});

	$(document).on('click', '#addEmployee', function (e) {
		e.preventDefault();
		app.clearForm('insert');
		$('#modal-employee').modal('show');		
	});

	$('#editEmployeeForm').validator().on('submit', function (e) {
		$('#EmployeeBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				app.submitForm(table_dynamic_employee);
				$('#modal-employee').modal('hide');
				$('#EmployeeBtn').button('reset');
		} else {
				$('#EmployeeBtn').button('reset');
		}
	});

	app.clearForm = function (action) {
		$('#editEmployeeForm')[0].reset();
		$('#modal-employee #action').val(action);
		// $('#modal-employee #id').val('');
		// $('#modal-employee #inputEditUserName').val('');
		// $('#modal-employee #inputEditPassWord').val('');
		// $('#modal-employee #inputEditRePassWord').val('');
		// $('#modal-employee #inputEditName').val('');
		// $('#modal-employee #inputEditBirthday').val('');
		// $('#modal-employee #inputEditPhone').val('');
		// $('#modal-employee #inputEditPosition').val(null).trigger('change');
		// $('#modal-employee #status').iCheck('uncheck');	
	}
}
$(function() {
	app.init();
});
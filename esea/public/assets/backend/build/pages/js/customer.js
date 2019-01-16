var app = app || {};
var table_dynamic_child;
var email = "";
app.init = function () {
	$('.modal').on( 'show.bs.modal', function (e) {
		if ($('input[type="radio"], input[type="checkbox"]').length > 0) {
			$('input[type="radio"], input[type="checkbox"]').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
				radioClass: 'iradio_minimal-blue'
			});
		}		
		$("#inputAddChildGentive").select2({
			placeholder: "Chọn tính cách",
			allowClear: true,
			maximumSelectionLength: 4
		});
	});
	
	$('[data-mask]').inputmask();

	function GetURLParameter(sParam) {
		var sPageURL = window.location.search.substring(1);
		var sURLVariables = sPageURL.split('&');
		for (var i = 0; i < sURLVariables.length; i++){
			var sParameterName = sURLVariables[i].split('=');
			if (sParameterName[0] == sParam)
			{
				return sParameterName[1];
			}
		}
	}
	
	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	$('#list-child-modal').on( 'shown.bs.modal', function (e) {
		$.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
	});

	$(' #modal-customer, #modalChild').on( 'show.bs.modal', function (e) {
		if ($('input[type="radio"]').length > 0) {
			$('input[type="radio"]').iCheck({
					radioClass: 'iradio_minimal-blue'
			});
		}
	});
	

	var table_dynamic_customer = $('.table-dynamic-customer').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": base_admin+"/ajax/customer",
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
			{"data": "phone"},
			{"data": "email"},
			{"data": "type"},
			{"data": "status"},
			{"data": null}
		],
		'columnDefs': [
			{
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '150px',
				targets: [2, 3, 5],
				class: 'text-center'
			},
			{
				width: '100px',
				targets: [0, 4],
				class: 'text-center'
			},
			{
				width: '200px',
				targets: [-1],
				orderable: false,
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

	$(document).on('click', '.table-action-edit', function (e) {
		e.preventDefault();
		app.clearForm('update');
		var id = $(this).data('id');
		$('#modal-customer #inputEditName').prop('required',false);
		$('#modal-customer #inputEditPhone').prop('required',false);
		$('#modal-customer #sexMale').prop('required',false);
		$('#modal-customer #sexFemale').prop('required',false);
        $('#modal-customer').validator('validate');
        $('#modal-customer #inputEditName').prop('required',true);
		$('#modal-customer #inputEditPhone').prop('required',true);
		$('#modal-customer #sexMale').prop('required',true);
		$('#modal-customer #sexFemale').prop('required',true);
        $('#modal-customer').validator('update');
		$.ajax({
			url: base_admin + "/ajax/customer?id=" + id,
			type: "get",
			success: function (response) {
					if (response.code == '200') {	
							$('#modal-customer #id').val(response.data.id);
							$('#modal-customer #inputEditEmail').val(response.data.email);
							$('#modal-customer #inputEditName').val(response.data.name);
							$('#modal-customer #inputEditPhone').val(response.data.phone);
							if(response.data.gender == 1){
								$('#modal-customer #sexMale').prop('checked', true);
							} else if (response.data.gender == 0){
								$('#modal-customer #sexFemale').prop('checked', true);
							} else {
								$('#modal-customer #sexDif').prop('checked', true);
							}
							if(response.data.status == 1) {
								$('#modal-customer #status').iCheck('check');
							} else {
								$('#modal-customer #status').iCheck('uncheck');
							}
							$('#modal-customer').modal('show');
					} else {
							$('#error-modal').modal('show');
					}
			},
			error: function (jqXHR, textStatus, errorThrown) {
					$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
			}
		});
	});

	var email = GetURLParameter('email');
	if(email != undefined){
		$('.table-dynamic-customer').DataTable().search(email).draw();
	}

	$(document).on('click', '#CustomerBtn', function (e) {
		e.preventDefault();
		$('#editCustomerForm').submit();
	});

	$('#editCustomerForm').validator().on('submit', function (e) {
		$('#CustomerBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				app.submitForm(table_dynamic_customer);
				$('#modal-customer').modal('hide');
				$('#CustomerBtn').button('reset');
		} else {
				$('#CustomerBtn').button('reset');
		}
	});

	$(document).on('click', '.table-action-delete', function (e) {
		e.preventDefault();
		app.clearForm('delete');
		$('#modal-customer #id').val($(this).data('id'));
		var row = $(this);
		var table = $(this).parents('table').DataTable();
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		}).one('click', '#confirm-delete', function (e) {
				app.submitForm(table_dynamic_customer);
		});
	});

	app.submitForm = function (table_dynamic_customer) {
		$.ajax({
			url: base_admin + "/ajax/customer",
			data: $('#editCustomerForm').serialize(),
			type: "post",
			success: function (response) {
					if (response.code == '200') {	
						table_dynamic_customer.ajax.reload(null, true);
						$('#alert_msg_edit').removeClass('no-display');
						$('#CustomerBtn').button('reset');
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

	app.submitForm1 = function (table_dynamic_child) {
		$.ajax({
			url: base_admin + "/ajax/child",
			data: $('#editChildForm').serialize(),
			type: "post",
			success: function (response) {
					if (response.code == '200') {	
						table_dynamic_child.ajax.reload(null, true);
						$('#alert_msg_edit').removeClass('no-display');
						$('#editChildBtn').button('reset');
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

	$(document).on('click', '.table-action-view', function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		if ($.fn.DataTable.isDataTable('.table-dynamic-child')) {
			$('.table-dynamic-child').DataTable().destroy();
			$('.table-dynamic-child tbody').empty();
		}
		table_dynamic_child = $('.table-dynamic-child').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": base_admin + "/ajax/child?parent=" + id,
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
				{"data": "gender"},
				{"data": "dob"},
				{"data": "genitive"},
				{"data": "school"},
				{"data": "action"}
			],
			'columnDefs': [
				{
					targets: [1],
					class: 'text-ellipsis'
				},			
				{
					width: '150px',
					targets: [2, 3],
					class: 'text-center'
				},		
				{
					width: '200px',
					targets: [4, 5],
					class: 'text-center'
				},		
				{
					width: '100px',
					targets: [0],
					class: 'text-center'
				}
			]		
		});
		$('#list-child-modal').modal('show');		
	});

	$(document).on('click', '.table-action-edit-child', function (e) {
		e.preventDefault();
		app.clearForm('update');
		var id = $(this).data('id');
		$.ajax({
			url: base_admin + "/ajax/child?id=" + id,
			type: "get",
			success: function (response) {
				if (response.code == '200') {	
					var genitive = response.data.genitive;
					var arrGenitive = genitive.split(",");
					$('#modalChild #id').val(id);
					$('#modalChild #inputChildName').val(response.data.name);
					$('#modalChild #inputEditChildBirthday').val(response.data.dob);
					$('#modalChild #inputAddChildGentive').val(arrGenitive).trigger('change');
					if(response.data.gender == 1){
						$('#modalChild #sexChildMale').prop('checked', true);
					} else if (response.data.gender == 0){
						$('#modalChild #sexChildFemale').prop('checked', true);
					} 
					$('#modalChild').modal('show');
				} else {
					$('#error-modal').modal('show');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
					$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
			}
		});
	});

	$(document).on('click', '#editChildBtn', function (e) {
		e.preventDefault();
		$('#modalChild').submit();
	});

	$('#modalChild').validator().on('submit', function (e) {
		$('#editChildBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				app.submitForm1(table_dynamic_child);
				$('#modalChild').modal('hide');
				$('#editChildBtn').button('reset');
		} else {
				$('#editChildBtn').button('reset');
		}
	});

	$(document).on('click', '.table-action-delete-child', function (e) {
		e.preventDefault();
		app.clearForm('delete');
		$('#modalChild #id').val($(this).data('id'));
		var row = $(this);
		var table = $(this).parents('table').DataTable();
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		}).one('click', '#confirm-delete', function (e) {
				app.submitForm1(table_dynamic_child);
		});
	});

	$(document).on('click', '#addCustomer', function (e) {
		e.preventDefault();
		app.clearForm('insert');
		$('#modal-customer').modal('show');		
	});

	app.clearForm = function (action) {
		$('#modal-customer #action').val(action);
		$('#editChildForm #action').val(action);
		$('#modal-customer #id').val('');
		$('#modal-customer #inputEditEmail').val('');
		$('#modal-customer #inputEditPassWord').val('');
		$('#modal-customer #inputEditRePassWord').val('');
		$('#modal-customer #inputEditName').val('');
		$('#modal-customer #sexDif').prop('checked', false);
		$('#modal-customer #sexMale').prop('checked', false);
		$('#modal-customer #sexFemale').prop('checked', false);
		$('#modal-customer #inputEditPhone').val('');
		$('#modal-customer #status').iCheck('uncheck');	
		$('#modalChild #sexChildMale').prop('checked', false);
		$('#modalChild #sexChildFemale').prop('checked', false);
		$('#modalChild #inputChildName').val('');
		$('#modalChild #inputEditChildBirthday').val('');
		$('#modalChild #inputAddChildGentive').val([]).trigger('change');
	}
}
$(function() {
	app.init();
});
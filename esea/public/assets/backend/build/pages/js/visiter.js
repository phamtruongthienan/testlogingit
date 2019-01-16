var app = app || {};
var dateBooking = "";
app.init = function () {
	$('[data-mask]').inputmask();
	$("#inputEditSchool").select2({
    placeholder: "Chọn",
    allowClear: true
	});
	$('input[name="inputBook"]').daterangepicker({
		singleDatePicker: true,
		timePicker: true,
    	minYear: 1901,
		maxYear: parseInt(moment().format('YYYY'),10),
		timePicker24Hour:true,
		locale: {
      	format: 'YYYY-MM-DD hh:mm:ss'
    }
	});

	var table_dynamic_visiter = $('.table-dynamic-visiter').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": base_admin +"/ajax/visiter", 
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
			{"data": "datebook"},
			{"data": "school"},
			{"data": "datevisit"},
			{"data": "customer"},
			{"data": "phone"},
			{"data": "email"},
			{"data": "status"},
			{"data": "action"}
		],
		'columnDefs': [
			{
				targets: [2],
				class: 'text-ellipsis'
			},			
			{
				width: '150px',
				targets: [1, 3, 5, 6, 7],
				class: 'text-center'
			},		
			{
				width: '200px',
				targets: [4],
				// class: 'text-center'
			},
			{
				width: '100px',
				targets: [0],
				class: 'text-center'
			},
			
		]		
	});

	$('#addVisiterForm').validator().on('submit', function (e) {
		$('#addVisiterBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_visiter_msg').removeClass('no-display');
						$('#addVisiterBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#addVisiterBtn').button('reset');
		}
	});
	
	$(document).on('click', '.table-action-delete', function (e) {
		e.preventDefault();
		var row = $(this);
		var table = $(this).parents('table').DataTable();
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		}).one('click', '#confirm-delete', function (e) {
				table.row(row.parents('tr')).remove().draw();
		});
	});

	$(document).on('click', '.table-action-edit', function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		$('#modal-visiter-edit #inputEditSchool').prop('required',false);
		$('#modal-visiter-edit #inputBook').prop('required',false);
		$('#modal-visiter-edit #inputEditName').prop('required',false);
		$('#modal-visiter-edit #inputEditPhone').prop('required',false);
		$('#modal-visiter-edit #inputEditEmail').prop('required',false);
		$('#modal-visiter-edit #inputEditStatus').prop('required',false);
        $('#modal-visiter-edit').validator('validate');
		$('#modal-visiter-edit #inputEditSchool').prop('required',true);
		$('#modal-visiter-edit #inputBook').prop('required',true);
		$('#modal-visiter-edit #inputEditName').prop('required',true);
		$('#modal-visiter-edit #inputEditPhone').prop('required',true);
		$('#modal-visiter-edit #inputEditEmail').prop('required',true);
		$('#modal-visiter-edit #inputEditStatus').prop('required',true);
        $('#modal-visiter-edit').validator('update');
		app.clearForm('update');
		$('#modal-visiter-edit #dateBooking').show();
		$.ajax({
				url: base_admin +"/ajax/visiter?id=" + id, 
				type: "get",
				success: function (response) {
						if (response.code == '200') {	
								$('#modal-visiter-edit #id').val(id);
								$('#modal-visiter-edit #inputEditBook').html(response.data.created_at);
								$('#modal-visiter-edit #inputEditName').val(response.data.name);
								$('#modal-visiter-edit #inputBook').val(response.data.booking_date);
								$('#modal-visiter-edit #inputEditPhone').val(response.data.phone);
								$('#modal-visiter-edit #inputEditEmail').val(response.data.email);
								$('#modal-visiter-edit #inputEditDesire').summernote('code', response.data.content);
								$('#modal-visiter-edit #inputEditStatus').val(response.data.status).trigger('change');
								$('#modal-visiter-edit #inputEditSchool').val(response.data.school_id).trigger('change');
								$('#modal-visiter-edit').modal('show');
						} else {
								$('#error-modal').modal('show');
						}
				},
				error: function (jqXHR, textStatus, errorThrown) {
						$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
				}
		});
	});

	$(document).on('click', '.table-action-view', function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		app.clearForm('update');
		$.ajax({
			url: base_admin +"/ajax/visiter?id=" + id, 
			type: "get",
			success: function (response) {
					if (response.code == '200') {	
							$('#note-modal #content').html(response.data.content);
							$('#note-modal').modal('show');	
					} else {
							$('#error-modal').modal('show');
					}
			},
			error: function (jqXHR, textStatus, errorThrown) {
					$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
			}
		});	
	});

	$(document).on('click', '.table-action-reply', function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		$('#modal-visiter-reply #id').val(id);
		$('#modal-visiter-reply #inputReplyContent').val('');
		$('#modal-visiter-reply').modal('show');		
	});

	$(document).on('click', '#replyVisiterBtn', function (e) {
		e.preventDefault();
		$.ajax({
			url: base_admin + "/ajax/sendFeedback",
			data: $('#replyVisiterForm').serialize(),
			type: "POST",
			success: function (response) {
				if (response.code == '200') {	
					$('#modal-visiter-reply').modal('hide');
					Lobibox.notify("success", {
                        title: 'Thông báo',
                        pauseDelayOnHover: false,
                        continueDelayOnInactiveTab: false,
                        icon: false,
                        sound: false,
                        msg: 'Gửi phản hồi thành công'
                    });
				} else {
					$('#error-modal').modal('show');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
					$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
			}
		});
	});

	$(document).on('click', '#addVisiter', function (e) {
		e.preventDefault();
		app.clearForm('insert');
		$('#modal-visiter-edit #dateBooking').hide();
		$('#modal-visiter-edit').modal('show');		
	});

	$(document).on('click', '#editVisiterBtn', function (e) {
		e.preventDefault();
		$('#editVisiterForm').submit();
	});

	$(document).on('click', '.table-action-visiter-info', function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			url: base_admin +"/ajax/visiter?id=" + id, 
			type: "get",
			success: function (response) {
				if (response.code == '200') {	
					window.location.replace(base_admin +"/customer?email="+response.data.email);
				} else {
					$('#error-modal').modal('show');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
			}
		});	
		
	});

	$(document).on('click', '.table-action-delete', function (e) {
		e.preventDefault();
		app.clearForm('delete');
		$('#modal-visiter-edit #id').val($(this).data('id'));
		var row = $(this);
		var table = $(this).parents('table').DataTable();
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		}).one('click', '#confirm-delete', function (e) {
				app.submitForm(table_dynamic_visiter);
		});
	});

	app.submitForm = function (table_dynamic_visiter) {
		$.ajax({
			url: base_admin + "/ajax/visiter",
			data: $('#editVisiterForm').serialize(),
			type: "POST",
			success: function (response) {
					if (response.code == '200') {	
						table_dynamic_visiter.ajax.reload(null, true);
						$('#alert_msg_edit').removeClass('no-display');
						$('#editVisiterBtn').button('reset');
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

	$('#editVisiterForm').validator().on('submit', function (e) {
		$('#editVisiterBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				app.submitForm(table_dynamic_visiter);
				$('#modal-visiter-edit').modal('hide');
				$('#editVisiterBtn').button('reset');
		} else {
				$('#editVisiterBtn').button('reset');
		}
	});

	app.clearForm = function (action) {
		$('#modal-visiter-edit #action').val(action);
		$('#modal-visiter-edit #inputEditBook').html('');
		$('#modal-visiter-edit #inputBook').val('');
		$('#modal-visiter-edit #inputEditName').val('');
		$('#modal-visiter-edit #inputEditPhone').val('');
		$('#modal-visiter-edit #inputEditEmail').val('');
		$('#modal-visiter-edit #inputEditSchool').val(null).trigger('change');
		$('#modal-visiter-edit #inputEditStatus').val(null).trigger('change');
		$('#modal-visiter-edit #inputEditDesire').summernote('code', '');
	}
}

$(function() {
	app.init();
});
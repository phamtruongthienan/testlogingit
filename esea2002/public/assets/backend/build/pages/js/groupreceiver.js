var app = app || {};

app.init = function () {
	$('.modal').on( 'show.bs.modal', function (e) {
		if ($('input[type="radio"]').length > 0) {
			$('input[type="radio"]').iCheck({
				radioClass: 'iradio_minimal-blue'
			});
		}
        app.toggleElement($('input[type="radio"]#ckbGroup'), $('#typeGroup, #selectEmail'));
        app.toggleElement($('input[type="radio"]#ckbImport'), $('#importExcel'));
        $('#modal-groupreceiver-add #ckbGroup').iCheck('check');
    });
    $(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    	$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	var table_dynamic_groupreceiver = $('.table-dynamic-groupreceiver').DataTable({
		"processing": true,
		"ajax": base_admin+"/ajax/group",
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
			{"data": "num"},
			{"data": "action"}
		],
		'columnDefs': [
			{
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '200px',
				targets: [-1, -2],
				class: 'text-center',
				orderable: false,
			},
			{
				width: '100px',
				targets: [0],
				class: 'text-center'
			}
		]		
	});

	$('#addGroupReceiverForm').validator().on('submit', function (e) {
		$('#addGroupReceiverBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
			app.submitForm(table_dynamic_groupreceiver);
			$('#modal-groupreceiver-add').modal('hide');
			$('#addGroupReceiverBtn').button('reset');
		} else {
			$('#addGroupReceiverBtn').button('reset');
		}
	});

	$("#inputEditPosition").select2({
        placeholder: 'Chọn đối tượng',
        allowClear: true
    }).on('select2:select', function (e) {
		var id= $(this).val();
		$.get("ajax/mailgroup/" + id, function(data) {
			$("#add_email").html(data);
		});
	});
    $('#inputEditPosition').on('select2:unselect', function (e) {
        $('#add_email').empty();
    });

    $('#add_email').select2({
        minimumResultsForSearch: -1,
        placeholder: function() {
            $(this).data('placeholder');
        }
    });

	$(document).on('click', '.table-action-export', function (e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		window.location= base_admin + "/ajax/export/"+id ;	
	});

	$(document).on('click', '.table-action-delete', function (e) {
		e.preventDefault();
		app.clearForm('delete');
		$('#modal-groupreceiver-add #id').val($(this).data('id'));
		var row = $(this);
		var table = $(this).parents('table').DataTable();
		$('#confirm-delete-modal').modal({
			backdrop: 'static',
			keyboard: false
		}).one('click', '#confirm-delete', function (e) {
			app.submitForm(table_dynamic_groupreceiver);
		});
	});

	$(document).on('click', '.table-action-edit', function (e) {
		e.preventDefault();
		app.clearForm('update');
		var id = $(this).data('id');
		$('#modal-groupreceiver-add #excel').hide();
		$('#modal-groupreceiver-add #inputAddName').prop('required',false);
		$('#modal-groupreceiver-add #add_email').prop('required',false);
        $('#addGroupReceiverForm').validator('validate');
        $('#modal-groupreceiver-add #inputAddName').prop('required',true);
		$('#modal-groupreceiver-add #add_email').prop('required',true);
        $('#addGroupReceiverForm').validator('update');
		$('#modal-groupreceiver-add').modal('show');
		$.ajax({
			url: base_admin + "/ajax/group?id=" + id,
			type: "get",
			success: function (response) {
				if (response.code == '200') {
					var listEmail = [];
					$.each(response.data.mGroupEmailUsers, function(i, item) {
						listEmail.push(item.email);
					});
					$('#modal-groupreceiver-add #id').val(response.data.id);
					$('#modal-groupreceiver-add #inputAddName').val(response.data.name);
					$('#modal-groupreceiver-add #ckbGroup').iCheck('check');
					$('#modal-groupreceiver-add #inputEditPosition').val(response.data.group).trigger('change');
					$.get("ajax/mailgroup/"+response.data.group,function(data){
						$("#add_email").html(data);
					}).then(function (data) {
						$('#modal-groupreceiver-add #add_email').val(listEmail).trigger('change');
					});;
					$('#modal-groupreceiver-add').modal('show');
				} else {
						$('#error-modal').modal('show');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				Lobibox.notify("warning", {
					title: 'Thông báo',
					pauseDelayOnHover: true,
					continueDelayOnInactiveTab: false,
					icon: false,
					sound: false,
					msg: response.msg
				});
			}
		});
	});

	app.submitForm = function (table_dynamic_groupreceiver) {
		var form_data = new FormData($('#addGroupReceiverForm')[0]);
		$.ajax({
			url: base_admin + "/ajax/group",
			data: form_data,
			cache:false,
			contentType: false,
			enctype: 'multipart/form-data',
			processData: false,
			dataType: "json",
			type: "post",
			success: function (response) {
				if (response.code == '200') {
					table_dynamic_groupreceiver.ajax.reload(null, true);
					$('#addGroupReceiverBtn').button('reset');
					Lobibox.notify("success", {
						title: 'Thông báo',
						pauseDelayOnHover: false,
						continueDelayOnInactiveTab: false,
						icon: false,
						sound: false,
						msg: response.msg
					});
					$('#confirm-delete-modal').modal('hide');
				} else {
					Lobibox.notify("warning", {
						title: 'Thông báo',
						pauseDelayOnHover: true,
						continueDelayOnInactiveTab: false,
						icon: false,
						sound: false,
						msg: response.msg
					});
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
				Lobibox.notify("warning", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: response.msg
                });
			}
		});
	}
	
	$(document).on('click', '#addGroupReceiver', function (e) {
		e.preventDefault();
		app.clearForm('insert');
		$('#modal-groupreceiver-add #excel').show();
		$('#modal-groupreceiver-add').modal('show');		
	});

	$(document).on('click', '#addGroupReceiverBtn', function (e) {
		e.preventDefault();
		$('#addGroupReceiverForm').submit();
	});
};

app.toggleElement = function (input, element) {
	input.on('ifChanged', function() {
        $('#modal-groupreceiver-add #inputEditPosition').val('').trigger('change');
        $('#modal-groupreceiver-add #add_email').val([]).trigger('change');
        $('#modal-groupreceiver-add #attachment').val('');
		//Check if checkbox is checked or not
		var checkboxChecked = $(this).is(':checked');
        var id = $(this).prop('id');
		if(checkboxChecked) {
			element.removeClass('hidden');
            switch (id)
            {
                case 'ckbGroup':
                {
                    $('#addGroupReceiverForm #inputEditPosition').prop('required',true);
                    $('#addGroupReceiverForm #add_email').prop('required',true);
                    break;
                }
                default:
                {
                    $('#addGroupReceiverForm #attachment').prop('required',true);
                }
            }
            $('#addGroupReceiverForm').validator('update');
		}else{
			element.addClass('hidden');
            switch (id)
            {
                case 'ckbGroup':
                {
                    $('#addGroupReceiverForm #inputEditPosition').prop('required',false);
                    $('#addGroupReceiverForm #add_email').prop('required',false);
                    break;
                }
                default:
                {
                    $('#addGroupReceiverForm #attachment').prop('required',false);
                }
            }
            $('#addGroupReceiverForm').validator('validate');
		}
	});
};

app.clearForm = function (action) {
	$('#modal-groupreceiver-add #id').val('');
	$('#modal-groupreceiver-add #inputAddName').val('');
	$('#modal-groupreceiver-add #inputEditPosition').val('').trigger('change');
	$('#modal-groupreceiver-add #ckbGroup').iCheck('uncheck');	
	$('#modal-groupreceiver-add #ckbImport').iCheck('uncheck');	
	$('#modal-groupreceiver-add #add_email').val([]).trigger('change');
	$('#modal-groupreceiver-add #attachment').val('');
	$('#modal-groupreceiver-add #action').val(action);
};

$(function() {
	app.init();
});
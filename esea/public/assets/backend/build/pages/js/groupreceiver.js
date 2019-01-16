var app = app || {};

app.init = function () {
	$('.modal').on( 'show.bs.modal', function (e) {
		if ($('input[type="radio"]').length > 0) {
			$('input[type="radio"]').iCheck({
				radioClass: 'iradio_minimal-blue'
			});
		}		
		$('.select2').select2();
		app.toggleElement($('input[type="radio"]#ckbGroup'), $('#typeGroup, #selectEmail'));
		app.toggleElement($('input[type="radio"]#ckbImport'), $('#importExcel'));	
	});
	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	var table_dynamic_groupreceiver = $('.table-dynamic-groupreceiver').DataTable({
		"processing": true,
		"ajax": "/data/groupreceiver.json",
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
			{"data": null}
		],
		'columnDefs': [
			{
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '200px',
				targets: [-1, -2],
				class: 'text-center'
			},
			{
				width: '100px',
				targets: [0],
				class: 'text-center'
			},
			{
				targets: [-1],
				orderable: false,
				render: function (data, type, row, meta) {
					return '<a' +
							' class="table-action table-action-edit text-green cursor-pointer" data-id="' + data.id + '"><i' +
							' class="fa fa-edit"></i></a>' +
							' <a class="table-action text-red table-action-delete cursor-pointer" data-id="' + data.id + '"><i' +
							' class="fa fa-trash"></i></a>' +
							' <a class="table-action text-blue table-action-export cursor-pointer" data-id="' + data.id + '"><i' +
							' class="fa fa-download"></i></a>';
				}
			}
		]		
	});

	$('#addGroupReceiverForm').validator().on('submit', function (e) {
		$('#addGroupReceiverBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg').removeClass('no-display');
						$('#addGroupReceiverBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#addGroupReceiverBtn').button('reset');
		}
	});
	
	$('#editGroupReceiverForm').validator().on('submit', function (e) {
		$('#editGroupReceiverBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg_edit').removeClass('no-display');
						$('#editGroupReceiverBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#editGroupReceiverBtn').button('reset');
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
		$('#modal-groupreceiver-edit').modal('show');
		// $.ajax({
		// 		// url: base_url + "/api/typecheck?id=" + id,
		// 		// type: "get",
		// 		success: function (response) {
		// 				if (response.code == '200') {	
		// 						$('#modal-language-edit #id').val(response.data.id);
		// 						$('#modal-language-edit').modal('show');
		// 				} else {
		// 						$('#error-modal').modal('show');
		// 				}
		// 		},
		// 		error: function (jqXHR, textStatus, errorThrown) {
		// 				$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
		// 		}
		// });
	});

	$(document).on('click', '#addGroupReceiver', function (e) {
		e.preventDefault();
		$('#modal-groupreceiver-add').modal('show');		
	});

	$(document).on('click', '#addGroupReceiverBtn', function (e) {
		e.preventDefault();
		$('#addGroupReceiverForm').submit();
	});

	$(document).on('click', '#editGroupReceiverBtn', function (e) {
		e.preventDefault();
		$('#editGroupReceiverForm').submit();
	});
}

app.toggleElement = function (input, element) {
	input.on('ifChanged', function() {
		//Check if checkbox is checked or not
    var checkboxChecked = $(this).is(':checked');

    if(checkboxChecked) {
			element.removeClass('hidden');
    }else{
			element.addClass('hidden');
    }
	});
}

$(function() {
	app.init();
});
var app = app || {};

app.init = function () {
	$('.select2').select2();
	$('.textarea').wysihtml5();

	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});
	
	var table_dynamic_program = $('.table-dynamic-program').DataTable({
		"processing": true,
		"ajax": "/data/program.json",
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
			{"data": "time"},
			{"data": null}
		],
		'columnDefs': [
			{
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '200px',
				targets: [-1],
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
							' class="fa fa-trash"></i></a>';
				}
			}
		]		
	});

	$('#addProgramForm').validator().on('submit', function (e) {
		$('#addProgramBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg').removeClass('no-display');
						$('#addProgramBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#addProgramBtn').button('reset');
		}
	});
	
	$('#editProgramForm').validator().on('submit', function (e) {
		$('#editProgramBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg_edit').removeClass('no-display');
						$('#editProgramBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#editProgramBtn').button('reset');
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
		$('#modal-program-edit').modal('show');
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

	$(document).on('click', '#addProgram', function (e) {
		e.preventDefault();
		$('#modal-program-add').modal('show');		
	});

	$(document).on('click', '#addProgramBtn', function (e) {
		e.preventDefault();
		$('#addProgramForm').submit();
	});

	$(document).on('click', '#editProgramBtn', function (e) {
		e.preventDefault();
		$('#editProgramForm').submit();
	});
}

$(function() {
	app.init();
});
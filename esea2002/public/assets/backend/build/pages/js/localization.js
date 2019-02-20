var app = app || {};

app.init = function () {
	$('.select2').select2({
    placeholder: "Chọn ngôn ngữ",
    allowClear: true
	});

	var table_dynamic_localization = $('.table-dynamic-localization').DataTable({
		"processing": true,
		"ajax": "/data/localization.json",
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
			// {"data": "id"},
			{"data": "key"},
			{"data": "name"},
			{"data": null}
		],
		'columnDefs': [
			{
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '200px',
				targets: [-1, 0],
				class: 'text-center'
			},			
			{
				targets: [-1],
				class: 'text-center',
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

	$('#addLocalizationForm').validator().on('submit', function (e) {
		$('#addLocalizationBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg').removeClass('no-display');
						$('#addLocalizationBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#addLocalizationBtn').button('reset');
		}
	});
	
	$('#editLocalizationForm').validator().on('submit', function (e) {
		$('#editLocalizationBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg_edit').removeClass('no-display');
						$('#editLocalizationBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#editLocalizationBtn').button('reset');
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
		$('#modal-localization-edit').modal('show');
		// $.ajax({
		// 		// url: base_url + "/api/typecheck?id=" + id,
		// 		// type: "get",
		// 		success: function (response) {
		// 				if (response.code == '200') {	
		// 						$('#modal-localization-edit #id').val(response.data.id);
		// 						$('#modal-localization-edit').modal('show');
		// 				} else {
		// 						$('#error-modal').modal('show');
		// 				}
		// 		},
		// 		error: function (jqXHR, textStatus, errorThrown) {
		// 				$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
		// 		}
		// });
	});

	$(document).on('click', '#addLocalization', function (e) {
		e.preventDefault();
		$('#modal-localization-add').modal('show');		
	});

	$(document).on('click', '#addLocalizationBtn', function (e) {
		e.preventDefault();
		$('#addLocalizationForm').submit();
	});

	$(document).on('click', '#editLocalizationBtn', function (e) {
		e.preventDefault();
		$('#editLocalizationForm').submit();
	});
}

app.toggleElement = function (input, contentOne, contentTwo, form) {
	input.on('ifChecked', function() {
		contentOne.show();	
		contentTwo.hide();	
		contentTwo.children(":first").prop('required',false);
		form.validator('validate');
		contentOne.children(":first").prop('required',true);	
		form.validator('update'); 		
	});
}

$(function() {
	app.init();
});
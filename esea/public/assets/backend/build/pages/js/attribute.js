var app = app || {};

app.init = function () {
	$('#ckbEditAttribute, #ckbAttribute').hide();
	$('.select2').select2();
	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});
	$('.modal').on( 'show.bs.modal', function (e) {
		if ($('input[type="radio"], input[type="checkbox"]').length > 0) {
			$('input[type="radio"], input[type="checkbox"]').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
				radioClass: 'iradio_minimal-blue'
			});
		}
	});

	var table_dynamic_groupAttribute = $('.table-dynamic-groupAttribute').DataTable({
		"processing": true,
		"ajax": "/data/attribute.json",
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
			{"data": "group"},
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

	var table_dynamic_attribute = $('.table-dynamic-attribute').DataTable({
		"processing": true,
		"ajax": "/data/attribute.json",
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
			{"data": "group"},
			{"data": "value"},
			{"data": "unit"},
			{"data": "active"},
			{"data": null}
		],
		'columnDefs': [
			{
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '200px',
				targets: [-1, 2, 3, -2],
				class: 'text-center'
			},
			{
				width: '100px',
				targets: [0,-2],
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
			},
			{
				targets: [3],
				render: function (data, type, row, meta) {
					var val = '';
					switch (data)
					{
						case 'true':
						{
							val = '<i class="fas fa-check-circle text-green"></i>';
							break;
						}
						case 'false':
						{
							val = '';
							break;
						}
						default:
						{
							val = data;
						}
					}
					return val;					
				}
			},
			{
				targets: [-2],
				render: function (data, type, row, meta) {
					if (data == 1) {
							return '<i class="fas fa-check-circle text-green"></i>';
					} else {
							return '';
					}
				}
			},
		]		
	});

	$('#addAttributeForm').validator().on('submit', function (e) {
		$('#addAttributeBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg').removeClass('no-display');
						$('#addAttributeBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#addAttributeBtn').button('reset');
		}
	});
	
	$('#editAttributeForm').validator().on('submit', function (e) {
		$('#editAttributeBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg_edit').removeClass('no-display');
						$('#editAttributeBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#editAttributeBtn').button('reset');
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

	$(document).on('click', '.table-dynamic-attribute .table-action-edit', function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		$('#modal-attribute-edit').modal('show');
		// $.ajax({
		// 		// url: base_url + "/api/typecheck?id=" + id,
		// 		// type: "get",
		// 		success: function (response) {
		// 				if (response.code == '200') {	
		// 						$('#modal-attribute-edit #id').val(response.data.id);
		// 						$('#modal-attribute-edit').modal('show');
		// 				} else {
		// 						$('#error-modal').modal('show');
		// 				}
		// 		},
		// 		error: function (jqXHR, textStatus, errorThrown) {
		// 				$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
		// 		}
		// });
	});

	$(document).on('click', '.table-dynamic-groupAttribute .table-action-edit', function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		$('#modal-groupAttribute-edit').modal('show');		
	});
	
	$(document).on('click', '#addGroupAttribute', function (e) {
		e.preventDefault();
		$('#modal-groupAttribute-add').modal('show');		
	});

	$(document).on('click', '#addAttribute', function (e) {
		e.preventDefault();
		$('#modal-attribute-add').modal('show');		
	});

	$(document).on('click', '#addAttributeBtn', function (e) {
		e.preventDefault();
		$('#addAttributeForm').submit();
	});

	$(document).on('click', '#editAttributeBtn', function (e) {
		e.preventDefault();
		$('#editAttributeForm').submit();
	});
	app.changeSelect($('#add_type_attribute'), $('#inputAttribute'), $('#ckbAttribute'));	
	app.changeSelect($('#edit_type_attribute'), $('#inputEditAttribute'), $('#ckbEditAttribute'));	
}

app.changeSelect = function(element, contentOne, contentTwo) {
	element.on("change", function (e) {
		var value = $(this).val();
		if(value == "1") {
			console.log(value);
			contentTwo.hide();
			contentOne.show();
		} else {
			console.log(value);
			contentTwo.show();
			contentOne.hide();
		}
	});
}

$(function() {
	app.init();
});
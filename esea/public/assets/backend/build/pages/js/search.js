var app = app || {};

app.init = function () {
	$.fn.validator.Constructor.INPUT_SELECTOR = ':input:not([type="hidden"], [type="submit"], [type="reset"], button, .select2-search__field)';
	$('#tagKey, #tagEditKey').select2({
		data: ["Internatinal","Binglingual"],
		tags: true,
		tokenSeparators: [',', ' '], 
		placeholder: {
			id: '', // the value of the option
			text: 'Từ khóa'
		}
	});
	$('.single-select2').select2({
    placeholder: "Chọn"
	});	
	$('#tagKey').on('change', function () {
		$(this).trigger('blur');
		console.log('aa');
	});
	$('.modal').on( 'show.bs.modal', function (e) {
		if ($('input[type="radio"], input[type="checkbox"]').length > 0) {
			$('input[type="radio"], input[type="checkbox"]').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
				radioClass: 'iradio_minimal-blue'
			});
		}
	});
	$('#modal-search-add').on( 'hidden.bs.modal', function (e) {		
		$('#addSearchForm')[0].reset();
		$('.single-select2, #tagKey, #tagEditKey').trigger('change.select2');
		$('#tagKey, #tagEditKey').val([]);
	});
	var table_dynamic_search = $('.table-dynamic-search').DataTable({
		"processing": true,
		"ajax": "/data/search.json",
		'responsive': true,
		'paging': true,
		'lengthChange': true,
		'searching': true,
		'ordering': true,
		'info': true,
		'autoWidth': true,
		'scrollX': true,
		'scrollCollapse': true,
		"ordering": false,
		"columns": [
			{"data": "id"},
			{"data": "keyword"},
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
				render: function (data, type, row, meta) {
					return '<a' +
							' class="table-action table-action-edit text-green cursor-pointer" data-id="' + data.id + '"><i' +
							' class="fa fa-edit"></i></a>' +
							' <a class="table-action text-red table-action-delete cursor-pointer" data-id="' + data.id + '"><i' +
							' class="fa fa-trash"></i></a>';
				}
			},
			// {
			// 	targets: 3,
			// 	render: function (data, type, row, meta) {
			// 		if (type === 'display') {
			// 			var $span = $('<span></span>');
			// 			if (meta.row > 0) {
			// 				$('<a data-id="'+data.id+'" data-id2="'+(data.sort - 1)+'" class="upBtn table-action text-primary cursor-pointer"><i class="fas fa-caret-square-up"></i></a>').appendTo($span);
			// 			}
			// 			$('<a data-id="'+data.id+'" data-id2="'+(data.sort + 1)+'" class="downBtn table-action text-primary cursor-pointer"><i class="fas fa-caret-square-down"></i></a>').appendTo($span);						
			// 			return $span.html();
			// 		}
			// 		return data;
			// 	}
			// }
		]	,
		// 'drawCallback': function(){
		// 	$('.table-dynamic-search tr:last .downBtn').remove();
		// 	$('.upBtn').unbind('click');
		// 	$('.downBtn').unbind('click');
		// 	$('.upBtn').on('click', function(){
		// 		moveUp($(this));
		// 	});
		// 	$('.downBtn').on('click', function(){
		// 		moveDown($(this));
		// 	});
		// }			
	});
	var table_dynamic_typePriority = $('.table-dynamic-typePriority').DataTable({
		"processing": true,
		"ajax": "/data/search.json",
		'responsive': true,
		'paging': true,
		'lengthChange': true,
		'searching': true,
		'ordering': true,
		'info': true,
		'autoWidth': true,
		'scrollX': true,
		'scrollCollapse': true,
		"ordering": false,
		"columns": [
			{"data": "id"},
			{"data": "type"},
			{"data": "name"},
			{"data": "active"},
			{"data": null}
		],
		'columnDefs': [
			{
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '150px',
				targets: [-1],
				class: 'text-center'
			},
			{
				width: '200px',
				targets: [2],
				class: 'text-center'
			},
			{
				width: '100px',
				targets: [0, -2],
				class: 'text-center'
			},
			{
				targets: [-1],
				render: function (data, type, row, meta) {
					return '<a' +
							' class="table-action table-action-edit text-green cursor-pointer" data-id="' + data.id + '"><i' +
							' class="fa fa-edit"></i></a>' +
							' <a class="table-action text-red table-action-delete cursor-pointer" data-id="' + data.id + '"><i' +
							' class="fa fa-trash"></i></a>';
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
			}
		]	
	});
	var table_dynamic_listSchool;
	$('a[href="#tab_list_school"], a[href="#tab_list_school_edit"]').on('shown.bs.tab', function (e) {
		if ($.fn.DataTable.isDataTable('.table-dynamic-listSchool')) {
			$('.table-dynamic-listSchool').DataTable().destroy();
		}
		var element = $($(this).attr("href")).find('.table-dynamic-listSchool');
		table_dynamic_listSchool = element.DataTable({
			"processing": true,
			"ajax": "/data/search.json",
			'responsive': true,
			'paging': true,
			'lengthChange': true,
			'searching': true,
			'ordering': true,
			'info': true,
			'autoWidth': true,
			'scrollX': true,
			'scrollCollapse': true,
			"ordering": false,
			"columns": [
				{"data": "id"},
				{"data": "school"},
				{"data": "sort"},
				{"data": "active"},
				{"data": null},
				{"data": null}
			],
			'columnDefs': [
				{
					targets: [1],
					class: 'text-ellipsis'
				},
				{
					width: '150px',
					targets: [-1, -2],
					class: 'text-center'
				},
				{
					width: '100px',
					targets: [0, -3, 2],
					class: 'text-center'
				},
				{
					targets: [-1],
					render: function (data, type, row, meta) {
						return '<a' +
								' class="table-action table-action-edit text-green cursor-pointer" data-id="' + data.id + '"><i' +
								' class="fa fa-edit"></i></a>' +
								' <a class="table-action text-red table-action-delete cursor-pointer" data-id="' + data.id + '"><i' +
								' class="fa fa-trash"></i></a>';
					}
				},
				{
					targets: [-3],
					render: function (data, type, row, meta) {
						if (data == 1) {
								return '<i class="fas fa-check-circle text-green"></i>';
						} else {
								return '';
						}
					}
				},
				{
					targets: -2,
					render: function (data, type, row, meta) {
						if (type === 'display') {
							var $span = $('<span></span>');
							if (meta.row > 0) {
								$('<a data-id="'+data.id+'" data-id2="'+(data.sort - 1)+'" class="upBtn table-action text-primary cursor-pointer"><i class="fas fa-caret-square-up"></i></a>').appendTo($span);
							}
							$('<a data-id="'+data.id+'" data-id2="'+(data.sort + 1)+'" class="downBtn table-action text-primary cursor-pointer"><i class="fas fa-caret-square-down"></i></a>').appendTo($span);						
							return $span.html();
						}
						return data;
					}
				}
			],
			'drawCallback': function(){
				var table = $(this);
				table.find('tr:last .downBtn').remove();
				table.find('.upBtn').unbind('click');
				table.find('.downBtn').unbind('click');
				table.find('.upBtn').on('click', function(){
					moveUp($(this));
				});
				table.find('.downBtn').on('click', function(){
					moveDown($(this));
				});
			}			
		});
	});
	$('.modal').on( 'shown.bs.modal', function (e) {
		$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	$('#addSearchForm').validator().on('submit', function (e) {
		$('#addSearchBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg').removeClass('no-display');
						$('#addSearchBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
						$('#modal-search-add').modal('hide');
				}, 1000);
		} else {
				$('#addSearchBtn').button('reset');
		}
	});
	
	$('#editSearchForm').validator().on('submit', function (e) {
		$('#editSearchBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg_edit').removeClass('no-display');
						$('#editSearchBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#editSearchBtn').button('reset');
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

	$(document).on('click', '.table-dynamic-search .table-action-edit', function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		$('#modal-search-edit').modal('show');
		// $.ajax({
		// 		// url: base_url + "/api/typecheck?id=" + id,
		// 		// type: "get",
		// 		success: function (response) {
		// 				if (response.code == '200') {	
		// 						$('#modal-search-edit #id').val(response.data.id);
		// 						$('#modal-search-edit').modal('show');
		// 				} else {
		// 						$('#error-modal').modal('show');
		// 				}
		// 		},
		// 		error: function (jqXHR, textStatus, errorThrown) {
		// 				$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
		// 		}
		// });
	});

	$(document).on('click', '.table-dynamic-typePriority .table-action-edit', function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		$('#modal-typePriority-edit').modal('show');
	});

	$(document).on('click', '.table-dynamic-listSchool .table-action-edit', function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		$('#modal-school-edit').modal('show');
	});

	$(document).on('click', '#addSearch', function (e) {
		e.preventDefault();
		$('#modal-search-add').modal('show');		
	});

	$(document).on('click', '.addTypePriority', function (e) {
		e.preventDefault();
		$('#modal-typePriority-add').modal('show');		
	});

	$(document).on('click', '.btnAddSchool', function (e) {
		e.preventDefault();
		$('#modal-school-add').modal('show');		
	});

	$(document).on('click', '#addSearchBtn', function (e) {
		e.preventDefault();
		$('#addSearchForm').submit();
	});

	$(document).on('click', '#editSearchBtn', function (e) {
		e.preventDefault();
		$('#editSearchForm').submit();
	});

	function moveUp(element) {
		var fid = element.data('id');
		var tid = element.data('id2');
		var tr = element.parents('tr'); 
		$.ajax({
				// url: base_url + "/v1/departments/init?up=1&id=" + fid + '&tid='+tid,
				// type: "post",
				success: function (response) {
						moveRow(tr, 'up');
						// table_dynamic_partner.ajax.reload(null, false);
				},
				error: function (jqXHR, textStatus, errorThrown) {
						$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
				}
		});
	}

	function moveDown(element) {
		var fid = element.data('id');
		var tid = element.data('id2');
		var tr = element.parents('tr');
		$.ajax({
				// url: base_url + "/v1/departments/init?down=1&id=" + fid + '&tid='+tid,
				// type: "post",
				success: function (response) {
						moveRow(tr, 'down');
						// table_dynamic_partner.ajax.reload(null, false);
				},
				error: function (jqXHR, textStatus, errorThrown) {
						$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
				}
		});
	}
	
	function moveRow(row, direction) {
		var index = table_dynamic_listSchool.row(row).index();
	
		var order = -1;
		if (direction === 'down') {
			order = 1;
		}
	
		var data1 = table_dynamic_listSchool.row(index).data();
		data1.sort += order;
	
		var data2 = table_dynamic_listSchool.row(index + order).data();
		data2.sort += -order;
	
		table_dynamic_listSchool.row(index).data(data2);
		table_dynamic_listSchool.row(index + order).data(data1);
	
		table_dynamic_listSchool.draw(false);
	}
}

$(function() {
	app.init();
});
var app = app || {};

app.init = function () {
	changeImage('#logoImage', 'input[id="logoFile"]');
	$('input[type="checkbox"].minimal').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass   : 'iradio_minimal-blue'
	});
	$('[data-mask]').inputmask();
	$('.my-colorpicker').colorpicker();
	$(document).on('shown.bs.tab', 'a[href="#language"]', function (e) {
 	   $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

    $(document).on('shown.bs.tab', 'a[href="#information"], a[href="#seo"]', function (e) {
		$('#blockLanguage').show();
    });

    $(document).on('shown.bs.tab', 'a[href="#social"], a[href="#language"]', function (e) {
        $('#blockLanguage').hide();
    });

	var table_dynamic_language = $('.table-dynamic-language').DataTable({
		"processing": true,
		"ajax": "/data/setting.json",
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
			{"data": "code"},
			{"data": null},
			{"data": "currency"},
			{"data": "time"},
			{"data": null}
		],
		'columnDefs': [
			{
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '150px',
				targets: [3, 4, 5],
				class: 'text-center'
			},
			{
				width: '100px',
				targets: [0, 2],
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
							' class="fa fa-edit"></i></a>';
				}
			},
			{
				targets: [3],
				orderable: false,
				render: function (data, type, full, meta) {
					if (full.enable == 1) {
						return '<input data-id="' + full.id + '" id="rdEnable" type="radio" class="minimal" checked name="defaultEnable">';
					} else {
						return '<input data-id="' + full.id + '" id="rdEnable" type="radio" class="minimal" name="defaultEnable">';
					}
				}
			}
		],
		"drawCallback": function (settings) {
			if ($('input[type="radio"]').length > 0) {
				$('input[type="radio"]').iCheck({
						radioClass: 'iradio_minimal-blue'
				});
			}
		},
	});

	$(table_dynamic_language.table().container()).on('ifChecked', 'input[type="radio"]', function() {
		var id = $(this).data("id");
		$.ajax({
			// url: base_url + "/v1/period/init?default=1&id=" + id,
			// type: "post",
			success: function (response) {

			},
			error: function (jqXHR, textStatus, errorThrown) {
				$('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
			}
		});
	});

	$('#infoForm').validator().on('submit', function (e) {
		$('#addInfoBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg').removeClass('no-display');
						$('#addInfoBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#addInfoBtn').button('reset');
		}
	});

	$('#seoForm').validator().on('submit', function (e) {
		$('#addSeoBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg').removeClass('no-display');
						$('#addSeoBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#addSeoBtn').button('reset');
		}
	});

	$('#socialForm').validator().on('submit', function (e) {
		$('#addSocialBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg').removeClass('no-display');
						$('#addSocialBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#addSocialBtn').button('reset');
		}
	});

	$('#editLanguageForm').validator().on('submit', function (e) {
		$('#editLanguageBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg').removeClass('no-display');
						$('#editLanguageBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#editLanguageBtn').button('reset');
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
		$('#modal-language-edit').modal('show');
	});

	$(document).on('click', '#AddInfoStatusBtn', function (e) {
		e.preventDefault();
		$('#AddInfoStatusForm').submit();
	});

	$(document).on('click', '#editLanguageBtn', function (e) {
		e.preventDefault();
		$('#editLanguageForm').submit();
	});
};

$(function() {
	app.init();
});
var app = app || {};

app.init = function () {
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
		$('.select2').select2();
		app.toggleElement($('input[type="radio"]#inputEditLink'),  $('#ckbEditLink'), $('#ckbEditSelect'), $("#editMenuForm"));		
		app.toggleElement($('input[type="radio"]#inputEditSelect'), $('#ckbEditSelect'), $('#ckbEditLink'), $("#editMenuForm"));	
	});
	$('#ckbSelect, #ckbEditSelect').hide();
	$('#ckbEditLink, #ckbEditLink').hide();
	var table_dynamic_menu = $('.table-dynamic-menu').DataTable({
		"processing": true,
		"ajax": base_admin+"/ajax/menu",
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
			{"data": "position"},
			{"data": "url"},
			{"data": "action"}
		],
		'columnDefs': [
			{
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '200px',
				targets: [-1, 2, 3]
			},
			{
				width: '100px',
				targets: [0],
				class: 'text-center'
			}
		]		
	});

	$('#editMenuForm').validator().on('submit', function (e) {
		$('#editMenuBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				app.submitForm(table_dynamic_menu);
				$('#modal-menu-edit').modal('hide');
				$('#editMenuBtn').button('reset');
		} else {
				$('#editMenuBtn').button('reset');
		}
	});

	app.submitForm = function (table_dynamic_news) {
		$.ajax({
			url: base_admin + "/ajax/menu",
			data: $('#editMenuForm').serialize(),
			type: "post",
			success: function (response) {
					if (response.code == '200') {	
						table_dynamic_menu.ajax.reload(null, true);
						$('#editMenuBtn').button('reset');
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

	$(document).on('click', '.table-action-edit, #modal-menu-edit .tab_edit_menu', function (e) {
		e.preventDefault();
        var id = $(this).attr('data-id');
        var lang = $(this).attr('data-lang');
        app.ClearFormNews(lang, 'update');
        app.UpdateNews(id, lang);
	});

	app.ClearFormNews = function(lang, type) {
		if (type == "insert") {
			$('#modal-menu-edit .nav-tabs').hide();
			$('#modal-menu-edit #ttlModal').html(' Thêm cấp menu mới');
			$('#modal-menu-edit #action').val(type);
		} else {
			$('#modal-menu-edit .nav-tabs').show();
			$('#modal-menu-edit #ttlModal').html(' Cập nhật Menu');
			$('#modal-menu-edit #action').val(type);
		}
		$('#modal-menu-edit ul > li').removeClass('active');
		$('#modal-menu-edit .tab_edit_menu[data-lang=' + lang + ']').parent().addClass('active');
		$('#modal-menu-edit #lang').val(lang);
	}

	app.UpdateNews = function(id, lang) {
		$('#modal-menu-edit #inputEditName').prop('required',false);
		if($('#modal-menu-edit inputLink').prop('checked')){
			$('#modal-menu-edit #inputAddLink').prop('required',false);
		} else {
			$('#modal-menu-edit #inputAddSelect').prop('required',false);
		}
		$('#modal-menu-edit').validator('validate');
		$('#modal-menu-edit #inputEditName').prop('required',true);
		if($('#modal-menu-edit inputLink').prop('checked')){
			$('#modal-menu-edit #inputAddLink').prop('required',true);
		} else {
			$('#modal-menu-edit #inputAddSelect').prop('required',true);
		}
        $('#modal-menu-edit').validator('update');
		$.ajax({
			url: base_admin + "/ajax/menu?id=" + id,
			type: "get",
			success: function(response) {
				if (response.code == '200') {
					$('#modal-menu-edit .tab_edit_menu').attr('data-id', id);
					if(response.data[0].news_id == null) {
						$('#modal-menu-edit #inputEditLink').iCheck('check');
						$('#ckbEditLink, #ckbEditLink').show();
						$('#ckbSelect, #ckbEditSelect').hide();
					} else {
						$('#modal-menu-edit #inputEditSelect').iCheck('check');
						$('#ckbSelect, #ckbEditSelect').show();
						$('#ckbEditLink, #ckbEditLink').hide();
					}
					$('#modal-menu-edit #inputEditPosition').val(response.data[0].position).trigger('change');
					$('#modal-menu-edit #inputEditSelectNews').val(response.data[0].news_id).trigger('change');
					if ( response.data[0].mMenuTranslationsAll !== "undefined") {
						$.each(response.data[0].mMenuTranslationsAll, function(k, v) {
							if (lang == v.language_id) {
								$('#modal-menu-edit #id').val(v.id);
								$('#modal-menu-edit #inputEditName').val(v.name);
								$('#modal-menu-edit #inputEditLink').val(v.slug);
							}
						});
					}
					$('#modal-menu-edit').modal('show');
				} else {
					Lobibox.notify("warning", {
						title: 'Thông báo',
						pauseDelayOnHover: true,
						continueDelayOnInactiveTab: false,
						icon: false,
						sound: false,
						msg: 'Có lỗi xảy ra'
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				Lobibox.notify("warning", {
					title: 'Thông báo',
					pauseDelayOnHover: true,
					continueDelayOnInactiveTab: false,
					icon: false,
					sound: false,
					msg: 'Có lỗi xảy ra'
				});
			}
		});
	};

	$(document).on('click', '.table-action-delete', function (e) {
		e.preventDefault();
		$('#modal-menu-edit #id').val($(this).data('id'));
		var lang = $(this).attr('data-lang');
        app.ClearFormNews(lang, 'delete');
		var row = $(this);
		var table = $(this).parents('table').DataTable();
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		}).one('click', '#confirm-delete', function (e) {
				app.submitForm(table_dynamic_menu);
		});
	});

	$(document).on('click', '#addMenu', function (e) {
		e.preventDefault();
		var lang = $(this).attr('data-lang');
		$('#editMenuForm')[0].reset();
		$('#modal-menu-edit #inputEditLink').iCheck('check');
		$('#ckbEditLink, #ckbEditLink').show();
        app.ClearFormNews(lang, 'insert');
		$('#modal-menu-edit').modal('show');	
	});

	$(document).on('click', '#editMenuBtn', function (e) {
		e.preventDefault();
		$('#editMenuForm').submit();
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
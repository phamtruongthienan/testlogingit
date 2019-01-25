var app = app || {};

app.init = function () {

	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
		$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});
	console.log("abc");
	var table_dynamic_language = $('.table-dynamic-language').DataTable({
		"processing": true,
		"ajax": base_admin + "/ajax/language",
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
			{ "data": "id" },
			{ "data": "name" },
			{ "data": "action" }
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
			}
		]
	});

	$('#addLanguageForm').validator().on('submit', function (e) {
		$('#addLanguageBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
			console.log("them1");
			app.LanguageFormSubmit(table_dynamic_language);
			setTimeout(function () {
				$('#alert_msg').removeClass('no-display');
				$('#addLanguageBtn').button('reset');
				setTimeout(function () {
					$('.alert').addClass('no-display');
				}, 3000);
			}, 1000);
		} else {
			$('#addLanguageBtn').button('reset');
		}
	});

	$('#editLanguageForm').validator().on('submit', function (e) {
		$('#editLanguageBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
			setTimeout(function () {
				$('#alert_msg_edit').removeClass('no-display');
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
		var id = $(this).data('id');
		console.log(($(this).data('id'))+"delete1")
		$('#modal-language-add #id').val($(this).data('id'));
		$('#confirm-delete-modal').modal({
			backdrop: 'static',
			keyboard: false
		}).one('click', '#confirm-delete', function (e) {
			app.DeleteLanguage(id,table_dynamic_language);
			table.row(row.parents('tr')).remove().draw();
		});
	});

	$(document).on('click', '.table-action-edit,#modal-language-add .tab_edit_language', function (e) {
		e.preventDefault();
        var id = $(this).attr('data-id');
		var lang = $(this).attr('data-lang');
		console.log("id:" + id + "lang:"+ lang);
		app.ClearFormLanguage(lang, 'update');
		app.UpdateLanguage(id,lang);
	});

	$(document).on('click', '#addLanguage', function (e) {
		e.preventDefault();
		app.ClearFormLanguage(lang, 'add');
		console.log("them2");
		$('#modal-language-add').modal('show');
	});

	$(document).on('click', '#addLanguageBtn', function (e) {
		e.preventDefault();
		$('#addLanguageForm').submit();
	});

	$(document).on('click', '#editLanguageBtn', function (e) {
		e.preventDefault();
		console.log("editLanguageBtn");
		$('#editLanguageForm').submit();
	});
}

app.ClearFormLanguage = function(lang, type) {
	$('#modal-language-add ul > li').removeClass('active');
	$('#modal-language-add #lang').val(lang);
    if (type == "add") {
		$('#modal-language-add .nav-tabs').hide();
		$('#modal-language-add .modal-title').html('Thêm ngoại ngữ mới');
		$('#modal-language-add #action').val("insert");
		$('#modal-language-add #inputAddName').val("");
		return;
    } else {
		$('#modal-language-add .nav-tabs').show();
		$('#modal-language-add #action').val("update");
        $('#modal-language-add .modal-title').html('Cập nhật ngoại ngữ1');
		$('#modal-language-add #inputAddName').val("");
	}
	$('#modal-language-add .tab_edit_language[data-lang=' + lang + ']').parent().addClass('active');
}

app.LanguageFormSubmit = function(table) {
    $.ajax({
        url: base_admin + "/ajax/language",
        type: "post",
        data: $('#addLanguageForm').serialize(),
        success: function(response) {
            if (response.code == '200') {
                Lobibox.notify("success", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: response.msg
                });
                table.ajax.reload(null, true);
                //$('#LevelBtn').button('reset');
				$('#modal-language-add').modal('hide');
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
        error: function(jqXHR, textStatus, errorThrown) {
            Lobibox.notify("warning", {
                title: 'Thông báo',
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                icon: false,
                sound: false,
                msg: 'Có lỗi trong quá trình xử lý'
            });
        }
    });
}

app.UpdateLanguage = function(id, lang) {
    $.ajax({
        url: base_admin + "/ajax/language?lang=" + lang + "&id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.mSchoolLanguageTranslationsAll !== "undefined") {
                    $.each(response.data.mSchoolLanguageTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
							console.log(response.data.id);	
                            $('#modal-language-add #id').val(response.data.id);
                            $('#modal-language-add .tab_edit_language').attr('data-id', response.data.id)
							$('#modal-language-add #inputAddName').val(v.name);
                        }
                    });
				}
                $('#modal-language-add').modal('show');
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
        error: function(jqXHR, textStatus, errorThrown) {
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
};

app.DeleteLanguage = function(id, table) {
    $.ajax({
        url: base_admin + "/ajax/language?action=delete&id=" + id,
        type: "post",
        success: function(response) {
            if (response.code == '200') {
                Lobibox.notify("success", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    icon: false,
                    sound: false,
                    msg: response.msg
                });
                table.ajax.reload(null, true);
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
            $('#confirm-delete-modal #confirm-delete').button('reset');
            $('#confirm-delete-modal').modal('hide');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Lobibox.notify("warning", {
                title: 'Thông báo',
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                icon: false,
                sound: false,
                msg: 'Có lỗi trong quá trình xử lý'
            });
            $('#confirm-delete-modal #confirm-delete').button('reset');
            $('#confirm-delete-modal').modal('hide');
        }
    });
}

$(function () {
	app.init();
});
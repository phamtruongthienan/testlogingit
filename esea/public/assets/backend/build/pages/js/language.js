var app = app || {};

app.init = function () {

	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    	$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	var table_dynamic_language = $('.table-dynamic-language').DataTable({
		"processing": true,
        "serverSide": true,
        "ajax": base_admin+"/ajax/language",
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
			{"data": "action"}
		],
		'columnDefs': [
			{
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '200px',
				targets: [-1],
                orderable: false,
				class: 'text-center'
			},
			{
				width: '100px',
				targets: [0],
				class: 'text-center'
			}
		]		
	});

	$('#LanguageForm').validator().on('submit', function (e) {
		$('#LanguageBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
            app.LanguageFormSubmit(table_dynamic_language);
		} else {
			$('#LanguageBtn').button('reset');
		}
	});

	$(document).on('click', '.table-action-delete', function (e) {
		e.preventDefault();
        var id = $(this).data('id');
        $('#confirm-delete-modal #id').val(id);
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		});
	});

    $('#confirm-delete-modal').on('click', '#confirm-delete', function (e) {
        $('#confirm-delete-modal #confirm-delete').button('loading');
        var id = $('#confirm-delete-modal #id').val();
        app.DeleteLanguage(id, table_dynamic_language);
    });

	$(document).on('click', '.table-action-edit, #modal-language .tab_edit_language', function (e) {
		e.preventDefault();
        $('#LanguageForm #name').prop('required',false);
        $('#LanguageForm').validator('validate');
        $('#LanguageForm #name').prop('required',true);
        $('#LanguageForm').validator('update');
        var id = $(this).attr('data-id');
        var lang = $(this).attr('data-lang');
        app.ClearFormLanguage(lang, 'edit');
        app.UpdateLanguage(id, lang);
	});

	$(document).on('click', '#addLanguage', function (e) {
		e.preventDefault();
        $('#LanguageForm')[0].reset();
        var lang = $(this).attr('data-lang');
        app.ClearFormLanguage(lang, 'add');
        $('#modal-language .tab_edit_language').attr('data-id', 'null');
        $('#modal-language').modal('show');
	});

	$(document).on('click', '#LanguageBtn', function (e) {
		e.preventDefault();
		$('#LanguageForm').submit();
	});
};

app.ClearFormLanguage = function(lang, type) {
    if (type == "add") {
        $('#modal-language .nav-tabs').hide();
        $('#modal-language #ttlModal').html('Thêm ngoại ngữ mới');
        $('#modal-language #action').val('insert');
    } else {
        $('#modal-language .nav-tabs').show();
        $('#modal-language #ttlModal').html('Cập nhật ngoại ngữ');
        $('#modal-language #action').val('update');
    }
    $('#modal-language ul > li').removeClass('active');
    $('#modal-language .tab_edit_language[data-lang=' + lang + ']').parent().addClass('active');
    $('#modal-language #lang').val(lang);
    $('#modal-language #name').val('');
};

app.LanguageFormSubmit = function(table) {
    $.ajax({
        url: base_admin + "/ajax/language",
        type: "post",
        data: $('#LanguageForm').serialize(),
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
                $('#LanguageBtn').button('reset');
                $('#modal-language').modal('hide');
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
};

app.UpdateLanguage = function(id, lang) {
    $.ajax({
        url: base_admin + "/ajax/language?lang=" + lang + "&id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.mSchoolLanguageTranslationsAll !== "undefined") {
                    $.each(response.data.mSchoolLanguageTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
                            $('#modal-language #id').val(response.data.id);
                            $('#modal-language .tab_edit_language').attr('data-id', response.data.id);
                            $('#modal-language #name').val(v.name);
                        }
                    });
                }

                $('#modal-language').modal('show');
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
};

$(function() {
	app.init();
});
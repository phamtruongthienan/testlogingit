var app = app || {};

app.init = function () {

	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    	$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	var table_dynamic_type = $('.table-dynamic-type').DataTable({
		"processing": true,
        "serverSide": true,
		"ajax": base_admin+"/ajax/type",
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
				class: 'text-center'
			},
			{
				width: '100px',
				targets: [0],
				class: 'text-center'
			}
		]		
	});

	$('#TypeForm').validator().on('submit', function (e) {
		$('#TypeBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
            app.TypeFormSubmit(table_dynamic_type);
		} else {
			$('#TypeBtn').button('reset');
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
        app.DeleteType(id, table_dynamic_type);
    });

	$(document).on('click', '.table-action-edit, #modal-type .tab_edit_type', function (e) {
		e.preventDefault();
        $('#TypeForm #name').prop('required',false);
        $('#TypeForm').validator('validate');
        $('#TypeForm #name').prop('required',true);
        $('#TypeForm').validator('update');
        var id = $(this).attr('data-id');
        var lang = $(this).attr('data-lang');
        app.ClearFormType(lang, 'edit');
        app.UpdateType(id, lang);
	});

	$(document).on('click', '#addType', function (e) {
		e.preventDefault();
        $('#TypeForm')[0].reset();
        var lang = $(this).attr('data-lang');
        app.ClearFormType(lang, 'add');
        $('#modal-type .tab_edit_type').attr('data-id', 'null');
		$('#modal-type').modal('show');
	});

	$(document).on('click', '#TypeBtn', function (e) {
		e.preventDefault();
		$('#TypeForm').submit();
	});
}

app.ClearFormType = function(lang, type) {
    if (type == "add") {
        $('#modal-type .nav-tabs').hide();
        $('#modal-type #ttlModal').html('Thêm loại trường mới');
        $('#modal-type #action').val('insert');
    } else {
        $('#modal-type .nav-tabs').show();
        $('#modal-type #ttlModal').html('Cập nhật loại trường');
        $('#modal-type #action').val('update');
    }
    $('#modal-type ul > li').removeClass('active');
    $('#modal-type .tab_edit_type[data-lang=' + lang + ']').parent().addClass('active');
    $('#modal-type #lang').val(lang);
    $('#modal-type #name').val('');
}

app.TypeFormSubmit = function(table) {
    $.ajax({
        url: base_admin + "/ajax/type",
        type: "post",
        data: $('#TypeForm').serialize(),
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
                $('#TypeBtn').button('reset');
                $('#modal-type').modal('hide');
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

app.UpdateType = function(id, lang) {
    $.ajax({
        url: base_admin + "/ajax/type?lang=" + lang + "&id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.mSchoolTypeTranslationsAll !== "undefined") {
                    $.each(response.data.mSchoolTypeTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
                            $('#modal-type #id').val(response.data.id);
                            $('#modal-type .tab_edit_type').attr('data-id', response.data.id)
                            $('#modal-type #name').val(v.name);
                        }
                    });
                }

                $('#modal-type').modal('show');
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

app.DeleteType = function(id, table) {
    $.ajax({
        url: base_admin + "/ajax/type?action=delete&id=" + id,
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
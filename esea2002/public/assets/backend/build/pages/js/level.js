var app = app || {};

app.init = function () {

	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    	$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	var table_dynamic_level = $('.table-dynamic-level').DataTable({
		"processing": true,
        "serverSide": true,
		"ajax": base_admin+"/ajax/level",
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

	$('#LevelForm').validator().on('submit', function (e) {
		$('#LevelBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
            app.LevelFormSubmit(table_dynamic_level);
		} else {
			$('#LevelBtn').button('reset');
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
        app.DeleteLevel(id, table_dynamic_level);
    });

	$(document).on('click', '.table-action-edit, #modal-level .tab_edit_level', function (e) {
		e.preventDefault();
        $('#LevelForm #name').prop('required',false);
        $('#LevelForm').validator('validate');
        $('#LevelForm #name').prop('required',true);
        $('#LevelForm').validator('update');
        var id = $(this).attr('data-id');
        var lang = $(this).attr('data-lang');
        app.ClearFormLevel(lang, 'edit');
        app.UpdateLevel(id, lang);
	});

	$(document).on('click', '#addLevel', function (e) {
		e.preventDefault();
        $('#LevelForm')[0].reset();
        var lang = $(this).attr('data-lang');
        app.ClearFormLevel(lang, 'add');
        $('#modal-level .tab_edit_course').attr('data-id', 'null')
		$('#modal-level').modal('show');
	});

	$(document).on('click', '#LevelBtn', function (e) {
		e.preventDefault();
		$('#LevelForm').submit();
	});
}

app.ClearFormLevel = function(lang, type) {
    if (type == "add") {
        $('#modal-level .nav-tabs').hide();
        $('#modal-level #ttlModal').html('Thêm cấp bậc trường mới');
        $('#modal-level #action').val('insert');
    } else {
        $('#modal-level .nav-tabs').show();
        $('#modal-level #ttlModal').html('Cập nhật cấp bậc trường');
        $('#modal-level #action').val('update');
    }
    $('#modal-level ul > li').removeClass('active');
    $('#modal-level .tab_edit_level[data-lang=' + lang + ']').parent().addClass('active');
    $('#modal-level #lang').val(lang);
    $('#modal-level #name').val('');
}

app.LevelFormSubmit = function(table) {
    $.ajax({
        url: base_admin + "/ajax/level",
        type: "post",
        data: $('#LevelForm').serialize(),
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
                $('#LevelBtn').button('reset');
                $('#modal-level').modal('hide');
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

app.UpdateLevel = function(id, lang) {
    $.ajax({
        url: base_admin + "/ajax/level?lang=" + lang + "&id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.mSchoolLevelTranslationsAll !== "undefined") {
                    $.each(response.data.mSchoolLevelTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
                            $('#modal-level #id').val(response.data.id);
                            $('#modal-level .tab_edit_level').attr('data-id', response.data.id);
                            $('#modal-level #name').val(v.name);
                        }
                    });
                }

                $('#modal-level').modal('show');
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

app.DeleteLevel = function(id, table) {
    $.ajax({
        url: base_admin + "/ajax/level?action=delete&id=" + id,
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

$(function() {
	app.init();
});
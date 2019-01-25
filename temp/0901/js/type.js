var app = app || {};

app.init = function () {

	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	var table_dynamic_type = $('.table-dynamic-type').DataTable({
		"processing": true,
		"ajax":  base_admin + "/ajax/type",
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

	$('#addTypeForm').validator().on('submit', function (e) {
		$('#addTypeBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				app.TypeFormSubmit(table_dynamic_type)
				setTimeout(function () {
						$('#alert_msg').removeClass('no-display');
						$('#addTypeBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#addTypeBtn').button('reset');
		}
	});
	
	$('#editTypeForm').validator().on('submit', function (e) {
		$('#editTypeBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg_edit').removeClass('no-display');
						$('#editTypeBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#editTypeBtn').button('reset');
		}
	});

	$(document).on('click', '.table-action-delete', function (e) {
		e.preventDefault();
		var row = $(this);
		var table = $(this).parents('table').DataTable();
		app.ClearFormType(lang, 'delete');
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		}).one('click', '#confirm-delete', function (e) {
			app.TypeFormSubmit(table_dynamic_type);
			table.row(row.parents('tr')).remove().draw();
		});
	});

	$(document).on('click', '.table-action-edit,#modal-type .tab_edit_type', function (e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		var lang = $(this).attr('data-lang');
		app.ClearFormType(lang, 'update');
		app.UpdateType(id,lang);
		$('#modal-type').modal('show');
	});

	$(document).on('click', '#addType', function (e) {
		e.preventDefault();
		app.ClearFormType(lang, 'add');
		$('#modal-type').modal('show');
	});

	$(document).on('click', '#addTypeBtn', function (e) {
		e.preventDefault();	
		$('#addTypeForm').submit();
	});

	$(document).on('click', '#editTypeBtn', function (e) {
		e.preventDefault();
		$('#editTypeForm').submit();
	});
}
app.ClearFormType = function(lang, type) {
	$('#modal-type ul > li').removeClass('active');
	$('#modal-type #lang').val(lang);
    if (type == "add") {
		$('#modal-type .nav-tabs').hide();
		$('#modal-type .modal-title').html('Thêm loại trường ngữ mới');
		$('#modal-type #action').val("insert");
		$('#modal-type #inputAddName').val("");
		return;
    } else if(type == "update"){
		$('#modal-type .nav-tabs').show();
		$('#modal-type #action').val("update");
        $('#modal-type .modal-title').html('Cập nhật loại trường');
		$('#modal-type #inputAddName').val("");
	}
	else{
		$('#modal-type #action').val("delete");
		$('#modal-type #inputAddName').val("delete");
		return;
	}
	$('#modal-type .tab_edit_type[data-lang=' + lang + ']').parent().addClass('active');
}

app.TypeFormSubmit = function(table) {
    $.ajax({
        url: base_admin + "/ajax/type",
        type: "post",
        data: $('#addTypeForm').serialize(),
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
				$('#modal-type #inputAddName').val(response.data.mSchoolTypeTranslationsAll[0].name);
                if (typeof response.data.mSchoolTypeTranslationsAll !== "undefined") {
                    $.each(response.data.mSchoolTypeTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
							console.log(id + lang + v.name)
                            $('#modal-type #id').val(response.data.id);
                            $('#modal-type .tab_edit_type').attr('data-id', response.data.id)
							$('#modal-type #inputAddName').val(v.name);
							
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

$(function() {
	app.init();
});
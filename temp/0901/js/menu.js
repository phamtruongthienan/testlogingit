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
		$('#modal-menu input[type="radio"]:first').iCheck('check');
		// $('#modal-menu-edit input[type="radio"]:first').iCheck('check');
		$('#ckbSelect, #ckbEditSelect').hide();
		app.toggleElement($('input[type="radio"]#inputLink'), $('#ckbLink'), $('#ckbSelect'), $("#addMenuForm"));
		app.toggleElement($('input[type="radio"]#inputEditLink'),  $('#ckbEditLink'), $('#ckbEditSelect'), $("#editMenuForm"));		
		app.toggleElement($('input[type="radio"]#inputSelect'), $('#ckbSelect'), $('#ckbLink'), $("#addMenuForm"));
		app.toggleElement($('input[type="radio"]#inputEditSelect'), $('#ckbEditSelect'), $('#ckbEditLink'), $("#editMenuForm"));	
	});

	var table_dynamic_menu = $('.table-dynamic-menu').DataTable({
		"processing": true,
		"ajax":  base_admin + "/ajax/menu",
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
			{"data": "slug"},
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

	$('#addMenuForm').validator().on('submit', function (e) {
		$('#addMenuBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg').removeClass('no-display');
						$('#addMenuBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#addMenuBtn').button('reset');
		}
	});
	
	$('#editMenuForm').validator().on('submit', function (e) {
		$('#editMenuBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg_edit').removeClass('no-display');
						$('#editMenuBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#editMenuBtn').button('reset');
		}
	});

	$(document).on('click', '.table-action-delete', function (e) {
		e.preventDefault();
		var row = $(this);
		var table = $(this).parents('table').DataTable();
		var id = $(this).data('id');
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		}).one('click', '#confirm-delete', function (e) {
			app.DeleteMenu(id,table_dynamic_menu);
			table.row(row.parents('tr')).remove().draw();
		});
	});

	$(document).on('click', '.table-action-edit,#modal-menu .tab_edit', function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		var lang = $(this).attr('data-lang');
		app.ClearFormMenu(lang,'update');
		app.LoadFormMenu(id,lang);
	});

	$(document).on('click', '#addMenu', function (e) {
		e.preventDefault();
		var lang = $(this).attr('data-lang');
		console.log(lang);
		app.ClearFormMenu(lang, 'add');
	});

	$(document).on('click', '#addMenuBtn', function (e) {
		e.preventDefault();
		if($("#inputLink").is(":checked")){
			console.log("linklink");
			// $("#addMenuForm").validate({
			// 	rules: {
			// 		inputAddName: "required",
			// 		inputAddPosition: "required",
			// 		inputAddLink:"required"
			// 	},
			// 	messages: {
			// 		inputAddName: "Vui lòng nhập tên menu",
			// 		inputAddPosition: "Vui lòng nhập vị trí",
			// 		inputAddLink:"Vui lòng nhập Link"
			// 	}
			// });
		}
		else if($("#inputSelect").is(":checked")){
			console.log("linkli222nk");
			// $("#addMenuForm").validate({
			// 	rules: {
			// 		inputAddName: "required",
			// 		inputAddPosition: "required",
			// 		inputAddSelect:"required"
			// 	},
			// 	messages: {
			// 		inputAddName: "Vui lòng nhập tên menu",
			// 		inputAddPosition: "Vui lòng nhập vị trí",
			// 		inputAddSelect:"Vui lòng nhập bài viết"
			// 	}
			// });
		}
		app.MenuFormSubmit(table_dynamic_menu);
	});

	$(document).on('click', '#editMenuBtn', function (e) {
		e.preventDefault();
		// $('#editMenuForm').submit();
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

app.ClearFormMenu = function(lang, type) {
	$('#modal-menu ul > li').removeClass('active');
	$('#modal-menu #lang').val(lang);
    if (type == "add") {
		$('#modal-menu .nav-tabs').hide();
		$('#modal-menu .modal-title').html('Thêm menu mới');
		$('#modal-menu #action').val("insert");
		$('#modal-menu #inputAddName').val("");
		$('#modal-menu #inputAddPosition').val("");
		$('#modal-menu #inputAddLink').val("");
		$('#modal-menu #inputAddSelect').val("");
		$('#modal-menu #id').val("");
		$('#modal-menu').modal('show');
    } else {
		$('#modal-menu .nav-tabs').show();
		$('#modal-menu #action').val("update");
		$('#modal-menu .modal-title').html('Cập nhật menu');
		$('#modal-menu').modal('show');
	}
	$('#modal-menu .tab_edit[data-lang=' + lang + ']').parent().addClass('active');
}

app.MenuFormSubmit = function(table) {
    $.ajax({
        url: base_admin + "/ajax/menu",
        type: "post",
        data: $('#addMenuForm').serialize(),
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
                $('#addMenuBtn').button('reset');
				$('#modal-menu').modal('hide');
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

app.LoadFormMenu = function(id, lang) {
    $.ajax({
        url: base_admin + "/ajax/menu?lang=" + lang + "&id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.mMenuTranslationsAll !== "undefined") {
                    $.each(response.data.mMenuTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
                            $('#modal-menu #id').val(response.data.id);
                            $('#modal-menu .tab_edit').attr('data-id', response.data.id)			
							$('#modal-menu #inputAddName').val(v.name);
							$('#modal-menu #inputAddPosition').val(response.data.position).trigger('change');
							$('#modal-menu #inputAddLink').val(v.slug);
							$('#modal-menu #inputAddSelect').val(response.data.news_id).trigger('change');
                        }
                    });
				}
                $('#modal-menu').modal('show');
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

app.DeleteMenu = function(id, table) {
    $.ajax({
        url: base_admin + "/ajax/menu?action=delete&id=" + id,
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
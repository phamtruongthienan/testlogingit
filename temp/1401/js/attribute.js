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
		"ajax": base_admin + "/ajax/attributegroup",
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
			},
		]		
	});

	var table_dynamic_attribute = $('.table-dynamic-attribute').DataTable({
		"processing": true,
		"ajax": base_admin + "/ajax/attribute",
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
			{"data": 'action'}
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

	$('#GroupAttributeForm').validator().on('submit', function (e) {
		$('#AttributeBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				app.AttributeGroupFormSubmit(table_dynamic_groupAttribute);
				// setTimeout(function () {
				// 		$('#alert_msg').removeClass('no-display');
				// 		$('#AttributeBtn').button('reset');
				// 		setTimeout(function () {
				// 				$('.alert').addClass('no-display');
				// 		}, 3000);
				// }, 1000);
		} else {
				$('#AttributeBtn').button('reset');
		}
	});
	
	$('#AttributeForm').validator().on('submit', function (e) {
		$('#addAttributeBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				app.AttributeFormSubmit(table_dynamic_attribute);
				// setTimeout(function () {
				// 		$('#alert_msg_edit').removeClass('no-display');
				// 		$('#editAttributeBtn').button('reset');
				// 		setTimeout(function () {
				// 				$('.alert').addClass('no-display');
				// 		}, 3000);
				// }, 1000);
				$('#addAttributeBtn').button('reset');
		} else {
				$('#addAttributeBtn').button('reset');
		}
	});

	$(document).on('click', '.table-dynamic-groupAttribute .table-action-delete', function (e) {
		e.preventDefault();
		console.log("table-action-delete group");
		var row = $(this);
		var table = $(this).parents('table').DataTable();
		var id = $(this).data('id');
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		}).one('click', '#confirm-delete', function (e) {
			table.row(row.parents('tr')).remove().draw();
			app.DeleteAttributeGroup(id,table_dynamic_groupAttribute);
		});
	});

	// $(document).on('click', '.table-dynamic-attribute .table-action-delete', function (e) {
	// 	e.preventDefault();
	// 	console.log("table-action-delete attribute");
	// 	var row = $(this);
	// 	var table = $(this).parents('table').DataTable();
	// 	id = $(this).data('id');
	// 	$('#confirm-delete-modal').modal({
	// 			backdrop: 'static',
	// 			keyboard: false
	// 	}).one('click', '#confirm-delete', function (e) {
	// 		table.row(row.parents('tr')).remove().draw();
	// 		app.DeleteAttribute(id,table_dynamic_attribute);
	// 	});
	// });

	$(document).on('click', '.table-dynamic-attribute .table-action-delete', function (e) {
		e.preventDefault();
		console.log("table-action-delete attribute");
		var row = $(this);
		var table = $(this).parents('table').DataTable();
		id = $(this).data('id');
		remove = table.row(row.parents('tr'));
		$('#confirm-delete-modal').modal('show');
	});

	$(document).on('click', '#confirm-delete', function (e) {
		e.preventDefault();
		console.log("table-action-delete attribute");
		remove.remove().draw();
		app.DeleteAttribute(id,table_dynamic_attribute);
	});

	$(document).on('click', '.table-dynamic-attribute .table-action-edit, #modal-attribute .tab_edit', function (e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		var lang = $(this).attr('data-lang');
		app.ClearFormAttribute(lang,'update');
		app.LoadFormAttribute(id,lang);
	});

	$(document).on('click', '.table-dynamic-groupAttribute .table-action-edit, #modal-groupAttribute .tab_edit', function (e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		var lang = $(this).attr('data-lang');
		app.ClearFormAttributeGroup(lang,'update');
		app.LoadFormAttributeGroup(id,lang);
	});
	
	$(document).on('click', '#addGroupAttribute', function (e) {
		e.preventDefault();
		var lang = $(this).attr('data-lang');
		app.ClearFormAttributeGroup(lang, 'add');	
	});

	$(document).on('click', '#addAttribute', function (e) {
		e.preventDefault();
		var lang = $(this).attr('data-lang');
		app.ClearFormAttribute(lang, 'add');	
	});

	$(document).on('click', '#AttributeBtn', function (e) {
		e.preventDefault();
		$('#GroupAttributeForm').submit();
	});

	$(document).on('click', '#addAttributeBtn', function (e) {
		e.preventDefault();
		$('#AttributeForm').submit();
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
app.ClearFormAttributeGroup = function(lang, type) {
	$('#GroupAttributeForm')[0].reset();
    if (type == "add") {	
		$('#modal-groupAttribute .nav-tabs').hide();
		$('#modal-groupAttribute .modal-title').html('Thêm nhóm thuộc tính mới');
		$('#modal-groupAttribute #action').val("insert");
    } else {
		$('#modal-groupAttribute .nav-tabs').show();
		$('#modal-groupAttribute #action').val("update");
		$('#modal-groupAttribute .modal-title').html('Cập nhật nhóm thuộc tính');
	}
	$('#modal-groupAttribute').modal('show');
	$('#modal-groupAttribute ul > li').removeClass('active');
	$('#modal-groupAttribute #lang').val(lang);
	$('#modal-groupAttribute .tab_edit[data-lang=' + lang + ']').parent().addClass('active');
}

app.LoadFormAttributeGroup = function(id, lang) {
    $.ajax({
        url: base_admin + "/ajax/attributegroup?lang=" + lang + "&id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.mSchoolCategoryTranslationsAll !== "undefined") {
                    $.each(response.data.mSchoolCategoryTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
                            $('#modal-groupAttribute #id').val(response.data.id);
                            $('#modal-groupAttribute .tab_edit').attr('data-id', response.data.id)			
							$('#modal-groupAttribute #inputAddName').val(v.name);
                        }
                    });
				}
				var elements = $('.addOption .form-group:not(:last)');
                $.each( elements, function( key, value ) {
                    value.remove();
				});
				
				if (typeof response.data.mSchoolClassAddons !== "undefined") {
					// $('.addOption .addOptionItem').empty();
					var clone = $('.addOption').find('.form-group');
					var element = $('.addOption').find('.form-group').clone();
					$('.addOption').find('.form-group').remove();
                    $.each(response.data.mSchoolClassAddons, function(k, v) {
                        element.find('.idaddon').attr('value', v.id);
                        if (typeof v.mSchoolClassAddonTranslationsAll !== "undefined") {
                            $.each(v.mSchoolClassAddonTranslationsAll, function(k, v) {
                                if (lang == v.language_id) {
                                    element.find('.nameaddon').attr('value', v.name);
                                    element.find('.contentaddon').attr('value', v.content);
                                }
                            });
						}			
						$('.addOption ').append('<div class="form-group">' + element.html() + '</div>');
						$('.addOption').find('.form-group .addElement').removeClass('fa-plus').addClass('fa-minus');
						$('.addOption').find('.form-group .addElement').removeClass('addElement').addClass('removeElement');
					});
					$('.addOption ').append('<div class="form-group">' + clone.html() + '</div>');
					
                }
                $('#modal-groupAttribute').modal('show');
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

app.AttributeGroupFormSubmit = function(table) {
    $.ajax({
        url: base_admin + "/ajax/attributegroup",
        type: "post",
        data: $('#GroupAttributeForm').serialize(),
        success: function(response) {
            if (response.code == '200') {
                Lobibox.notify("success", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
                    //continueDelayOnInactiveTab: false,
                    icon: false,
					sound: false,
					delay: 1000,
                    msg: response.msg
                });
                table.ajax.reload(null, true);
                $('#addMenuBtn').button('reset');
				$('#modal-groupAttribute').modal('hide');
            } else {
                Lobibox.notify("warning", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
                    //continueDelayOnInactiveTab: false,
                    icon: false,
					sound: false,
					delay: 1000,
                    msg: response.msg
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Lobibox.notify("warning", {
                title: 'Thông báo',
                pauseDelayOnHover: true,
                //continueDelayOnInactiveTab: false,
                icon: false,
				sound: false,
				delay: 1000,
                msg: 'Có lỗi trong quá trình xử lý'
            });
        }
    });
}

app.DeleteAttributeGroup = function(id, table) {
    $.ajax({
        url: base_admin + "/ajax/attributegroup?action=delete&id=" + id,
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

app.ClearFormAttribute = function(lang, type) {
	$('#AttributeForm')[0].reset();
	$('#modal-attribute #type').val(null).trigger('change');
	$('#modal-attribute #group_attribute').val(null).trigger('change');
    if (type == "add") {	
		$('#modal-attribute .nav-tabs').hide();
		$('#modal-attribute .modal-title').html('Thêm nhóm thuộc tính mới');
		$('#modal-attribute #action').val("insert");
    } else {
		$('#modal-attribute .nav-tabs').show();
		$('#modal-attribute #action').val("update");
		$('#modal-attribute .modal-title').html('Cập nhật nhóm thuộc tính');
	}
	$('#modal-attribute').modal('show');
	$('#modal-attribute ul > li').removeClass('active');
	$('#modal-attribute #lang').val(lang);
	$('#modal-attribute .tab_edit[data-lang=' + lang + ']').parent().addClass('active');
}

app.LoadFormAttribute = function(id, lang) {
    $.ajax({
        url: base_admin + "/ajax/attribute?lang=" + lang + "&id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.mSchoolAttributeTranslationsAll !== "undefined") {
                    $.each(response.data.mSchoolAttributeTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
                            $('#modal-attribute #id').val(response.data.id);
                            $('#modal-attribute .tab_edit').attr('data-id', response.data.id);		
							$('#modal-attribute #inputAddName').val(v.name);
							// $('#modal-attribute #type').val(v.name); // loại trường.
							$('#modal-attribute #group_attribute').val(response.data.mSchoolCategory.id).trigger('change');
							$('#modal-attribute #type_attribute').val(response.data.type).trigger('change');
							$('#modal-attribute #inputAddValue').val(v.content);
							$('#modal-attribute #inputAddUnit').val(v.unit);
							if(response.data.search == 1)
								$('#modal-attribute #addActive').iCheck('check');
							else
								$('#modal-attribute #addActive').iCheck('uncheck');
                        }
                    });
				}
                $('#modal-attribute').modal('show');
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

app.AttributeFormSubmit = function(table) {
    $.ajax({
        url: base_admin + "/ajax/attribute",
        type: "post",
        data: $('#AttributeForm').serialize(),
        success: function(response) {
            if (response.code == '200') {
                Lobibox.notify("success", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
                    //continueDelayOnInactiveTab: false,
                    icon: false,
					sound: false,
					delay: 1000,
                    msg: response.msg
                });
                table.ajax.reload(null, true);
                $('#addMenuBtn').button('reset');
				$('#modal-attribute').modal('hide');
            } else {
                Lobibox.notify("warning", {
                    title: 'Thông báo',
                    pauseDelayOnHover: true,
                    //continueDelayOnInactiveTab: false,
                    icon: false,
					sound: false,
					delay: 1000,
                    msg: response.msg
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Lobibox.notify("warning", {
                title: 'Thông báo',
                pauseDelayOnHover: true,
                //continueDelayOnInactiveTab: false,
                icon: false,
				sound: false,
				delay: 1000,
                msg: 'Có lỗi trong quá trình xử lý'
            });
        }
    });
}

app.DeleteAttribute = function(id, table) {
    $.ajax({
        url: base_admin + "/ajax/attribute?action=delete&id=" + id,
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
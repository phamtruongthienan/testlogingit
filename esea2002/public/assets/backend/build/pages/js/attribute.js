var app = app || {};

app.init = function () {
	$('#ckbAttribute').hide();
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
        "serverSide": true,
        "ajax": base_admin + "/ajax/attribute?table=attributegroup",
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

	var table_dynamic_attribute = $('.table-dynamic-attribute').DataTable({
		"processing": true,
        "serverSide": true,
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
			{"data": "action"}
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
				targets: [-1],
				orderable: false
			}
		]		
	});

    $('#GroupAttributeForm').validator().on('submit', function (e) {
        $('#GroupAttributeBtn').button('loading');
        $('#GroupAttributeForm .table').val('attributegroup');
        $('.alert').addClass('no-display');
        if (!e.isDefaultPrevented()) {
            e.preventDefault();
            app.AttributeFormSubmit('#GroupAttributeForm', table_dynamic_groupAttribute, '#GroupAttributeBtn', '#modal-groupAttribute');
        } else {
            $('#GroupAttributeBtn').button('reset');
        }
    });

	$('#AttributeForm').validator().on('submit', function (e) {
		$('#AttributeBtn').button('loading');
        $('#AttributeForm .table').val('attribute');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
            app.AttributeFormSubmit('#AttributeForm', table_dynamic_attribute, '#AttributeBtn', '#modal-attribute');
		} else {
			$('#AttributeBtn').button('reset');
		}
	});

	$(document).on('click', '.table-dynamic-groupAttribute .table-action-delete', function (e) {
		e.preventDefault();
        var id = $(this).attr('data-id');
        $('#confirm-delete-modal #id').val(id);
        $('#confirm-delete-modal #module').val('attributegroup');
        $('#confirm-delete-modal #table').val('table_dynamic_groupAttribute');
		$('#confirm-delete-modal').modal({
				backdrop: 'static',
				keyboard: false
		});
	});

    $(document).on('click', '.table-dynamic-attribute .table-action-delete', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('#confirm-delete-modal #id').val(id);
        $('#confirm-delete-modal #module').val('attribute');
        $('#confirm-delete-modal #table').val('table_dynamic_attribute');
        $('#confirm-delete-modal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });

    $('#confirm-delete-modal').on('click', '#confirm-delete', function (e) {
        $('#confirm-delete-modal #confirm-delete').button('loading');
        var id = $('#confirm-delete-modal #id').val();
        var module = $('#confirm-delete-modal #module').val();
        var table = $('#confirm-delete-modal #table').val();
        switch (table) {
            case 'table_dynamic_attribute':
                app.DeleteAttribute(id, table_dynamic_attribute, module);
                break;
            default:
                app.DeleteAttribute(id, table_dynamic_groupAttribute, module);
        }
    });

	$(document).on('click', '.table-dynamic-attribute .table-action-edit, #modal-attribute .tab_edit_attribute', function (e) {
		e.preventDefault();
        $('#AttributeForm .name').prop('required',false);
        $('#AttributeForm').validator('validate');
        $('#AttributeForm .name').prop('required',true);
        $('#AttributeForm').validator('update');
        var id = $(this).attr('data-id');
        var lang = $(this).attr('data-lang');
        app.ClearFormAttribute('#AttributeForm', '#modal-attribute', lang, 'edit');
        app.UpdateAttribute(id, lang);
	});

	$(document).on('click', '.table-dynamic-groupAttribute .table-action-edit, #modal-groupAttribute .tab_edit_group_attribute', function (e) {
		e.preventDefault();
        $('#GroupAttributeForm .name').prop('required',false);
        $('#GroupAttributeForm').validator('validate');
        $('#GroupAttributeForm .name').prop('required',true);
        $('#GroupAttributeForm').validator('update');
		var id = $(this).attr('data-id');
		var lang = $(this).attr('data-lang');
        app.ClearFormAttribute('#GroupAttributeForm', '#modal-groupAttribute', lang, 'edit');
        app.UpdateAttributeGroup(id, lang);
	});
	
	$(document).on('click', '#addGroupAttribute', function (e) {
		e.preventDefault();
        var lang = $(this).attr('data-lang');
        app.ClearFormAttribute('#GroupAttributeForm', '#modal-groupAttribute', lang, 'add');
	});

	$(document).on('click', '#addAttribute', function (e) {
		e.preventDefault();
        var lang = $(this).attr('data-lang');
        app.ClearFormAttribute('#AttributeForm', '#modal-attribute', lang, 'add');
	});

    $(document).on('click', '#GroupAttributeBtn', function (e) {
        e.preventDefault();
        $('#GroupAttributeForm').submit();
    });

	$(document).on('click', '#AttributeBtn', function (e) {
		e.preventDefault();
		$('#AttributeForm').submit();
	});
	app.changeSelect($('#type'), $('#inputAttribute'), $('#ckbAttribute'));
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: base_admin + "/ajax/attribute?table=attributegroup"
    }).then(function (data) {
        $.map(data.data, function (item) {
            var option = new Option(item.group, item.id, false, false);
            $('#school_category_id').append(option);
        })
    });

    function iformat(icon) {
        var originalOption = icon.element;
        return $('<span><i class="' + $(originalOption).attr('value') + '"></i> ' + $(originalOption).attr('value') + '</span>');
    }

    $('#icon').select2({
        templateSelection: iformat,
        templateResult: iformat,
        allowHtml: true
    });
};

app.changeSelect = function(element, contentOne, contentTwo) {
	element.on("change", function (e) {
		var value = $(this).val();
		if(value == "1") {
			contentTwo.hide();
			contentOne.show();
            $('#AttributeForm #value').prop('required',true);
            $('#AttributeForm').validator('update');
		} else {
            $('#AttributeForm #value').prop('required',false);
            $('#AttributeForm').validator('validate');
			contentTwo.show();
			contentOne.hide();
		}
	});
};

app.ClearFormAttribute = function(form, modal, lang, type) {
    $(form)[0].reset();
    if (type == "add") {
        $(modal + ' .nav-tabs').hide();
        switch (modal) {
            case '#modal-groupAttribute':
                $(modal + ' .ttlModal').html('Thêm nhóm thuộc tính mới');
                break;
            default:
                $(modal + ' .ttlModal').html('Thêm thuộc tính mới');
        }
        $(modal + ' .action').val("insert");
    } else {
        $(modal + ' .nav-tabs').show();
        $(modal + ' .action').val("update");
        switch (modal) {
            case '#modal-groupAttribute':
                $(modal + ' .ttlModal').html('Cập nhật nhóm thuộc tính');
                break;
            default:
                $(modal + ' .ttlModal').html('Cập nhật thuộc tính');
        }
    }
    $(modal).modal('show');
    $(modal + ' ul > li').removeClass('active');
    $(modal + ' .lang').val(lang);
    $(modal + ' [class*="tab_edit_"][data-lang=' + lang + ']').parent().addClass('active');
};

app.AttributeFormSubmit = function(form, table, button, modal) {
    $.ajax({
        url: base_admin + "/ajax/attribute",
        type: "post",
        data: $(form).serialize(),
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
                $(button).button('reset');
                $(modal).modal('hide');
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

app.UpdateAttributeGroup = function(id, lang) {
    $.ajax({
        url: base_admin + "/ajax/attribute?table=attributegroup&lang=" + lang + "&id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.mSchoolCategoryTranslationsAll !== "undefined") {
                    $.each(response.data.mSchoolCategoryTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
                            $('#modal-groupAttribute .id').val(response.data.id);
                            $('#modal-groupAttribute .tab_edit_group_attribute').attr('data-id', response.data.id);
                            $('#modal-groupAttribute .name').val(v.name);
                        }
                    });
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

app.UpdateAttribute = function(id, lang) {
    $.ajax({
        url: base_admin + "/ajax/attribute?table=attribute&lang=" + lang + "&id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.mSchoolAttributeTranslationsAll !== "undefined") {
                    $.each(response.data.mSchoolAttributeTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
                            $('#modal-attribute .id').val(response.data.id);
                            $('#modal-attribute .tab_edit_attribute').attr('data-id', response.data.id);
                            $('#modal-attribute .name').val(v.name);
                            $('#modal-attribute #school_category_id').val(response.data.mSchoolCategory.id).trigger('change.select2');
                            $('#modal-attribute #type').val(response.data.type).trigger('change.select2');
                            if(response.data.type == 1) {
                                $('#modal-attribute #unit').val(v.unit).trigger('change.select2');
                                $('#modal-attribute #value').val(v.content);
                                $('#ckbAttribute').hide();
                                $('#inputAttribute').show();
                                $('#AttributeForm #value').prop('required',true);
                                $('#AttributeForm').validator('update');
                            } else {
                                $('#ckbAttribute').show();
                                $('#inputAttribute').hide();
                                $('#AttributeForm #value').prop('required',false);
                                $('#AttributeForm').validator('validate');
                                if(v.content == 1) {
                                    $('#modal-attribute #ckbvalue').iCheck('check');
                                } else {
                                    $('#modal-attribute #ckbvalue').iCheck('uncheck');
                                }
                            }
                            $('#modal-attribute #icon').val(response.data.icon).trigger('change.select2');
                            if(response.data.search == 1) {
                                $('#modal-attribute #search').iCheck('check');
                            } else {
                                $('#modal-attribute #search').iCheck('uncheck');
                            }
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

app.DeleteAttribute = function(id, table, module) {
    $.ajax({
        url: base_admin + "/ajax/attribute?action=delete&id=" + id + "&table=" + module,
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
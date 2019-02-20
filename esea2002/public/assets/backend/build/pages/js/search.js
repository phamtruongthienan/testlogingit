var app = app || {};
var arrayTypeName = '', schoolName = '';

app.init = function () {
	$('#name').select2({
		tags: true,
		tokenSeparators: [',', ' '],
		placeholder: {
			id: '',
			text: 'Từ khóa'
		}
	});
	$('#typename, #school_id').select2({
    	placeholder: {
    	    id: '',
            text: 'Chọn'
        }
	});
    $('#modal-typePriority').on( 'shown.bs.modal', function (e) {
        $('#modal-typePriority #typename').val(arrayTypeName).trigger('change.select2');
    });
    $('#modal-school').on( 'show.bs.modal', function (e) {
        var schoolSelect = $('#school_id');
        schoolSelect.empty();
        var lang = $(this).find('.lang').val();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: base_admin + "/ajax/school"
        }).then(function (data) {
            $.map(data.data, function (item) {
                var option = new Option(item.name, item.id, false, false);
                schoolSelect.append(option);
            })
        });
    });
    $('#modal-school').on( 'shown.bs.modal', function (e) {
        $('#modal-school #school_id').val(schoolName).trigger('change.select2');
    });
	// $('#name').on('change', function () {
	// 	$(this).trigger('blur');
	// 	console.log('aa');
	// });
	$('.modal').on( 'show.bs.modal', function (e) {
		if ($('input[type="radio"], input[type="checkbox"]').length > 0) {
			$('input[type="radio"], input[type="checkbox"]').iCheck({
				checkboxClass: 'icheckbox_minimal-blue',
				radioClass: 'iradio_minimal-blue'
			});
		}
	});
	var table_dynamic_search = $('.table-dynamic-search').DataTable({
		"processing": true,
        "serverSide": true,
        "ajax": base_admin+"/ajax/search?table=keyword",
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
	var table_dynamic_listSchool, table_dynamic_typePriority;
	$('.modal').on( 'shown.bs.modal', function (e) {
		$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    	$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	$('#SearchForm').validator().on('submit', function (e) {
		$('#SearchBtn').button('loading');
        $('#SearchForm .table').val('keyword');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
            app.SearchFormSubmit('#SearchForm', table_dynamic_search, '#SearchBtn', '#modal-search');
		} else {
			$('#SearchBtn').button('reset');
		}
	});

    $('#TypePriorityForm').validator().on('submit', function (e) {
        $('#TypePriorityBtn').button('loading');
        $('#TypePriorityForm .table').val('prioty');
        $('.alert').addClass('no-display');
        if (!e.isDefaultPrevented()) {
            e.preventDefault();
            app.SearchFormSubmit('#TypePriorityForm', table_dynamic_typePriority, '#TypePriorityBtn', '#modal-typePriority');
        } else {
            $('#TypePriorityBtn').button('reset');
        }
    });

    $('#SchoolForm').validator().on('submit', function (e) {
        $('#SchoolBtn').button('loading');
        $('#SchoolForm .table').val('school');
        $('.alert').addClass('no-display');
        if (!e.isDefaultPrevented()) {
            e.preventDefault();
            app.SearchFormSubmit('#SchoolForm', table_dynamic_listSchool, '#SchoolBtn', '#modal-school');
        } else {
            $('#SchoolBtn').button('reset');
        }
    });

	$(document).on('click', '.table-dynamic-search .table-action-delete', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('#confirm-delete-modal #id').val(id);
        $('#confirm-delete-modal #module').val('keyword');
        $('#confirm-delete-modal #table').val('table_dynamic_search');
        $('#confirm-delete-modal').modal({
            backdrop: 'static',
            keyboard: false
        });
	});

    $(document).on('click', '.table-dynamic-typePriority .table-action-delete', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('#confirm-delete-modal #id').val(id);
        $('#confirm-delete-modal #module').val('prioty');
        $('#confirm-delete-modal #table').val('table_dynamic_typePriority');
        $('#confirm-delete-modal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });

    $(document).on('click', '.table-dynamic-listSchool .table-action-delete', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('#confirm-delete-modal #id').val(id);
        $('#confirm-delete-modal #module').val('school');
        $('#confirm-delete-modal #table').val('table-dynamic-listSchool');
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
            case 'table_dynamic_search':
                app.DeleteSearch(id, table_dynamic_search, module);
                break;
            case 'table_dynamic_typePriority':
                app.DeleteSearch(id, table_dynamic_typePriority, module);
                break;
            default:
                app.DeleteSearch(id, table_dynamic_listSchool, module);
        }
    });

	$(document).on('click', '.table-dynamic-search .table-action-edit, #modal-search .tab_edit_keyword', function (e) {
		e.preventDefault();
        $('#SearchForm #name').prop('required',false);
        $('#SearchForm').validator('validate');
        $('#SearchForm #name').prop('required',true);
        $('#SearchForm').validator('update');
        var id = $(this).attr('data-id');
        var lang = $(this).attr('data-lang');
        $('#SearchForm .addTypePriority').attr('data-id', id);
        $('#SearchForm .btnAddSchool').attr('data-id', id);
        $('#SearchForm .addTypePriority').attr('data-lang', lang);
        $('#SearchForm .btnAddSchool').attr('data-lang', lang);
        app.ClearFormSearch("#modal-search", lang, 'edit');
        app.UpdateKeyWord(id, lang);
        if ($.fn.DataTable.isDataTable('.table-dynamic-typePriority')) {
            $('.table-dynamic-typePriority').DataTable().destroy();
        }
        table_dynamic_typePriority = $('.table-dynamic-typePriority').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": base_admin + "/ajax/search?table=prioty&keyword_id=" + id + "&lang=" + lang,
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
                {"data": "type"},
                {"data": "name"},
                {"data": "status"},
                {"data": "action"}
            ],
            'columnDefs': [
                {
                    width: '150px',
                    targets: [-1],
                    ordering: false,
                    class: 'text-center'
                },
                {
                    width: '200px',
                    targets: [2],
                    class: 'text-center'
                },
                {
                    width: '100px',
                    targets: [0, -2],
                    class: 'text-center'
                }
            ]
        });
        if ($.fn.DataTable.isDataTable('.table-dynamic-listSchool')) {
            $('.table-dynamic-listSchool').DataTable().destroy();
        }
        table_dynamic_listSchool = $('.table-dynamic-listSchool').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": base_admin + "/ajax/search?table=school&keyword_id=" + id + "&lang=" + lang,
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
                {"data": "school"},
                {"data": "sort"},
                {"data": "status"},
                {"data": "action"}
            ],
            'columnDefs': [
                {
                    width: '150px',
                    targets: [-1],
                    ordering: false,
                    class: 'text-center'
                },
                {
                    width: '100px',
                    targets: [0, -2, 2],
                    class: 'text-center'
                }
            ]
        });
	});

	$(document).on('click', '.table-dynamic-typePriority .table-action-edit, #modal-typePriority .tab_edit_keyword_prioty', function (e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
        var lang = $(this).attr('data-lang');
        app.ClearFormSearch("#modal-typePriority", lang, 'edit');
        app.UpdateKeyWordPriority(id, lang);
	});

	$(document).on('click', '.table-dynamic-listSchool .table-action-edit', function (e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
        var lang = $(this).attr('data-lang');
        app.ClearFormSearch("#modal-school", lang, 'edit');
        app.UpdateKeyWordSchool(id, lang);
	});

	$(document).on('click', '#addSearch', function (e) {
		e.preventDefault();
        $('#SearchForm')[0].reset();
        $('#name').trigger('change.select2');
        $('#name').val([]);
        var lang = $(this).attr('data-lang');
        app.ClearFormSearch('#modal-search', lang, 'add');
        $('#modal-search .tab_edit_keyword').attr('data-id', 'null');
		$('#modal-search').modal('show');
	});

    $(document).on('click', '.addTypePriority', function (e) {
        e.preventDefault();
        $('#TypePriorityForm')[0].reset();
        arrayTypeName = '';
        var lang = $(this).attr('data-lang');
        var keyword_id = $(this).attr('data-id');
        $('#modal-typePriority #type').val('').trigger('change.select2');
        $('#modal-typePriority .keyword_id').val(keyword_id);
        app.ClearFormSearch('#modal-typePriority', lang, 'add');
        $('#modal-typePriority .tab_edit_keyword_prioty').attr('data-id', 'null');
        $('#modal-typePriority').modal('show');
    });

	$(document).on('click', '.btnAddSchool', function (e) {
		e.preventDefault();
        $('#SchoolForm')[0].reset();
        schoolName = '';
        var lang = $(this).attr('data-lang');
        var keyword_id = $(this).attr('data-id');
        $('#modal-school .keyword_id').val(keyword_id);
        app.ClearFormSearch('#modal-school', lang, 'add');
        $('#modal-school .tab_edit_keyword_school').attr('data-id', 'null');
		$('#modal-school').modal('show');
	});

	$(document).on('click', '#SearchBtn', function (e) {
		e.preventDefault();
		$('#SearchForm').submit();
	});

    $(document).on('click', '#TypePriorityBtn', function (e) {
        e.preventDefault();
        $('#TypePriorityForm').submit();
    });

    $(document).on('click', '#SchoolBtn', function (e) {
        e.preventDefault();
        $('#SchoolForm').submit();
    });

    $("#type").select2({
        placeholder: {
            id: '', // the value of the option
            text: 'Chọn loại ưu tiên'
        },
        allowClear: true
    }).on('select2:select', function (e) {
        var data = e.params.data;
        app.switchFunction(data.id);
    });
    $('#type').on('select2:unselect', function (e) {
        $('#typename').empty();
    });
};

app.switchFunction = function (data) {
    var typeNameSelect = $('#typename');
    typeNameSelect.empty();
    switch (data) {
        case '1':
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: base_admin + "/ajax/place?table=district"
            }).then(function (data) {
                $.map(data.data, function (item) {
                    var option = new Option(item.name, item.id, false, false);
                    typeNameSelect.append(option);
                })
            });
            break;
        case '2':
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: base_admin + "/ajax/type"
            }).then(function (data) {
                $.map(data.data, function (item) {
                    var option = new Option(item.name, item.id, false, false);
                    typeNameSelect.append(option);
                })
            });
            break;
        default:
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: base_admin + "/ajax/level"
            }).then(function (data) {
                $.map(data.data, function (item) {
                    var option = new Option(item.name, item.id, false, false);
                    typeNameSelect.append(option);
                });
            });
    }
};

app.ClearFormSearch = function(modal, lang, type) {
    if (type == "add") {
        $(modal + ' .modal-body > .nav-tabs-custom > .nav-tabs').hide();
        switch (modal) {
            case '#modal-search':
                $(modal + ' .ttlModal').html('Thêm tìm kiếm mới');
                break;
            case '#modal-typePriority':
                $(modal + ' .ttlModal').html('Thêm loại ưu tiên');
                break;
            default:
                $(modal + ' .ttlModal').html('Thêm trường vào danh sách tìm kiếm');
        }
        $(modal + ' .action').val('insert');
        $(modal + ' .tab-content .nav-tabs-custom').hide();
    } else {
        switch (modal) {
            case '#modal-search':
                $(modal + ' .modal-body > .nav-tabs-custom > .nav-tabs').show();
                $(modal + ' .ttlModal').html('Cập nhật tìm kiếm');
                $(modal + ' .tab-content .nav-tabs-custom').show();
                break;
            case '#modal-typePriority':
                $(modal + ' .modal-body > .nav-tabs-custom > .nav-tabs').hide();
                $(modal + ' .ttlModal').html('Cập nhật loại ưu tiên');
                $(modal + ' .tab-content .nav-tabs-custom').hide();
                break;
            default:
                $(modal + ' .modal-body > .nav-tabs-custom > .nav-tabs').hide();
                $(modal + ' .ttlModal').html('Cập nhật trường trong danh sách tìm kiếm');
                $(modal + ' .tab-content .nav-tabs-custom').hide();
        }
        $(modal + ' .action').val('update');
    }
    $(modal + ' .modal-body > .nav-tabs-custom > ul > li').removeClass('active');
    $(modal + ' a[class*="tab_edit_"][data-lang=' + lang + ']').parent().addClass('active');
    $(modal + ' .lang').val(lang);
};

app.UpdateKeyWord = function(id, lang) {
    $.ajax({
        url: base_admin + "/ajax/search?table=keyword&lang=" + lang + "&id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.mKeywordTranslationsAll !== "undefined") {
                    $.each(response.data.mKeywordTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
                            $('#modal-search .id').val(response.data.id);
                            $('#modal-search .tab_edit_keyword').attr('data-id', response.data.id);
                            $('#modal-search #name').empty();
                            if(v.name) {
                                var name = v.name.split(",");
                                $('#modal-search #name').select2({
                                    data: name,
                                    tags: true,
                                    tokenSeparators: [',', ' '],
                                    placeholder: {
                                        id: '', // the value of the option
                                        text: 'Từ khóa'
                                    }
								}).val(name).trigger('change.select2');
							}
                        }
                    });
                }

                $('#modal-search').modal('show');
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

app.UpdateKeyWordPriority = function(id, lang) {
    $.ajax({
        url: base_admin + "/ajax/search?table=prioty&lang=" + lang + "&id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.mKeywordPriotyTranslationsAll !== "undefined") {
                    $.each(response.data.mKeywordPriotyTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
                            $('#modal-typePriority .id').val(response.data.id);
                            $('#modal-typePriority .tab_edit_keyword_prioty').attr('data-id', response.data.id);
                            $('#modal-typePriority #type').val(v.type).trigger('change.select2');
                            app.switchFunction(v.type.toString());
                            if(v.district_id) {
                                arrayTypeName = v.district_id;
                            } else if(v.school_level_id) {
                                arrayTypeName = v.school_level_id;
                            } else {
                                arrayTypeName = v.school_type_id;
                            }
                        }
                    });
                }
                $('#modal-typePriority').modal('show');
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

app.UpdateKeyWordSchool = function(id, lang) {
    $.ajax({
        url: base_admin + "/ajax/search?table=school&lang=" + lang + "&id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.mKeywordSchoolTranslationsAll !== "undefined") {
                    $.each(response.data.mKeywordSchoolTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
                            $('#modal-school .id').val(response.data.id);
                            $('#modal-school .tab_edit_keyword_school').attr('data-id', response.data.id);
                            schoolName = v.school_id;
                            if(v.status == 1) {
                                $('#modal-school #status').iCheck('check');
                            } else {
                                $('#modal-school #status').iCheck('uncheck');
                            }
                            $('#modal-school #sort').val(v.sort);
                        }
                    });
                }
                $('#modal-school').modal('show');
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

app.SearchFormSubmit = function(form, table, btn, modal) {
    $.ajax({
        url: base_admin + "/ajax/search",
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
                $(btn).button('reset');
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

app.DeleteSearch = function(id, table, module) {
    $.ajax({
        url: base_admin + "/ajax/search?action=delete&id=" + id + "&table=" + module,
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
var app = app || {};
var arrayTarget = [];

app.init = function () {
    changeImage('#logoImage', 'input[id="logo"]', '#EventForm');
	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    	$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	$('#modal-event').on( 'show.bs.modal', function (e) {
        if ($('input[type="radio"], input[type="checkbox"]').length > 0) {
            $('input[type="radio"], input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
        }
        var popup = $(this);
        $('#date').daterangepicker({
            parentEl: popup,
            locale: {
                format: 'DD/MM/YYYY'
            }
        });
    });

    $('#modal-event').on( 'shown.bs.modal', function (e) {
        $('#modal-event #target').val(arrayTarget).trigger('change');
    });

	var table_dynamic_event = $('.table-dynamic-event').DataTable({
		"processing": true,
        "serverSide": true,
		"ajax": base_admin+"/ajax/event",
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
			{"data": "type"},
			{"data": "time"},
			{"data": "discount"},
			{"data": "code"},
			{"data": "status"},
			{"data": "action"}
		],
		'columnDefs': [
			{
				width: '150px',
				targets: [3, 5],
				class: 'text-center'
			},
			{
				width: '100px',
				targets: [0, 4, 6],
				class: 'text-center'
			},
			{
				width: '200px',
				targets: [2, -1],
				class: 'text-center'
			},
			{
				targets: [-1],
				orderable: false
			}
		],
        'drawCallback': function(settings) {
            $('[data-toggle="tooltip"]').tooltip();
        },
        'initComplete': function(settings, json) {
            $('[data-toggle="tooltip"]').tooltip();
        }
	});

	$('#EventForm').validator().on('submit', function (e) {
		$('#addEventBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
            e.preventDefault();
            app.EventFormSubmit(table_dynamic_event);
		} else {
            $('#EventBtn').button('reset');
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
        app.DeleteEvent(id, table_dynamic_event);
    });

	$(document).on('click', '.table-action-edit, #modal-event .tab_edit_event', function (e) {
        e.preventDefault();
        $('#EventForm #name').prop('required',false);
        $('#EventForm #slug').prop('required',false);
        $('#EventForm #discount').prop('required',false);
        $('#EventForm #code').prop('required',false);
        $('#EventForm').validator('validate');
        $('#EventForm #name').prop('required',true);
        $('#EventForm #slug').prop('required',true);
        $('#EventForm #discount').prop('required',true);
        $('#EventForm #code').prop('required',true);
        $('#EventForm').validator('update');
        var id = $(this).attr('data-id');
        var lang = $(this).attr('data-lang');
        app.ClearFormEvent(lang, 'edit');
        app.UpdateEvent(id, lang);
	});

	$(document).on('click', '#addEvent', function (e) {
		e.preventDefault();
        $('#EventForm')[0].reset();
        var lang = $(this).attr('data-lang');
        app.ClearFormEvent(lang, 'add');
        $('#modal-event .tab_edit_event').attr('data-id', 'null');
        arrayTarget = [];
        $('#target').empty();
		$('#modal-event').modal('show');
	});

	$(document).on('click', '#EventBtn', function (e) {
		e.preventDefault();
		$('#EventForm').submit();
	});

    $("#type").select2({
        placeholder: "Chọn đối tượng",
        allowClear: true
    }).on('select2:select', function (e) {
        var data = e.params.data;
        app.switchFunction(data.id);
    });
    $('#type').on('select2:unselect', function (e) {
        $('#target').empty();
    });
};

app.ClearFormEvent = function(lang, type) {
    if (type == "add") {
        $('#modal-event .nav-tabs').hide();
        $('#modal-event #ttlModal').html('Thêm sự kiện mới');
        $('#modal-event #action').val('insert');
    } else {
        $('#modal-event .nav-tabs').show();
        $('#modal-event #ttlModal').html('Cập nhật sự kiện');
        $('#modal-event #action').val('update');
    }
    $('#modal-event ul > li').removeClass('active');
    $('#modal-event .tab_edit_event[data-lang=' + lang + ']').parent().addClass('active');
    $('#modal-event #lang').val(lang);
    $('#EventForm')[0].reset();
    $('#modal-event #logoImage').attr('src', base_url+'/assets/backend/img/avatar.png');
    $('#modal-event #content').summernote('code', '');
    $('#modal-event #target').val([]).trigger('change');
    $('#modal-event #type').val('').trigger('change');
};

app.EventFormSubmit = function(table) {
    $.ajax({
        url: base_admin + "/ajax/event",
        type: "post",
        data: $('#EventForm').serialize(),
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
                $('#EventBtn').button('reset');
                $('#modal-event').modal('hide');
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

app.UpdateEvent = function(id, lang) {
    $.ajax({
        url: base_admin + "/ajax/event?lang=" + lang + "&id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.mSchoolEventTranslationsAll !== "undefined") {
                    $.each(response.data.mSchoolEventTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
                            $('#modal-event #id').val(response.data.id);
                            $('#modal-event .tab_edit_event').attr('data-id', response.data.id);
                            $('#modal-event #name').val(v.name);
                            $('#modal-event #slug').val(v.slug);
                            if(v.logo != null) {
                                $('#modal-event #logoImage').attr('src', base_url+'/img/'+v.logo)
                            }
                            $('#modal-event #content').summernote('code', v.content);
                        }
                    });
                }

                if(response.data.date_type == 1) {
                    $('#modal-event #date_type_forever').iCheck('check');
                } else {
                    $('#modal-event #date_type_period').iCheck('check');
                }
                if(response.data.start_date && response.data.end_date) {
                    var start_date = new Date(response.data.start_date);
                    var end_date = new Date(response.data.end_date);
                    $('#date').val(start_date.getDate() + '/' +  (start_date.getMonth() + 1) + '/' + start_date.getFullYear() + ' - ' + end_date.getDate() + '/' +  (end_date.getMonth() + 1) + '/' + end_date.getFullYear());
				} else {
                    $('#date').val('');
				}
                if(response.data.discount_type == 1) {
                    $('#modal-event #discount_type_percent').iCheck('check');
                } else {
                    $('#modal-event #discount_type_cash').iCheck('check');
                }
                $('#modal-event #discount').val(response.data.discount);
                $('#modal-event #code').val(response.data.code);
                $('#modal-event #type').val(response.data.type).trigger('change');
                arrayTarget = response.data.target.split(',');
                app.switchFunction(response.data.type.toString());
                $('#modal-event #position').val(response.data.position).trigger('change');
                if(response.data.status == 1) {
                    $('#modal-event #status').iCheck('check');
                } else {
                    $('#modal-event #status').iCheck('uncheck');
                }

                $('#modal-event').modal('show');
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

app.DeleteEvent = function(id, table) {
    $.ajax({
        url: base_admin + "/ajax/event?action=delete&id=" + id,
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

app.switchFunction = function (data) {
    var targetSelect = $('#target');
    targetSelect.empty();
    switch (data) {
        case '1':
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: base_admin + "/ajax/type"
            }).then(function (data) {
                $.map(data.data, function (item) {
                    var option = new Option(item.name, item.id, false, false);
                    targetSelect.append(option);
                })
            }).then(function (data) {
                $('#modal-event #target').val(arrayTarget).trigger('change');
            });
            break;
        case '2':
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: base_admin + "/ajax/school"
            }).then(function (data) {
                $.map(data.data, function (item) {
                    var option = new Option(item.name, item.id, false, false);
                    targetSelect.append(option);
                })
            });
            break;
        case '3':
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: base_admin + "/ajax/customer"
            }).then(function (data) {
                $.map(data.data, function (item) {
                    var option = new Option(item.name, item.id, false, false);
                    targetSelect.append(option);
                })
            });
            break;
        default:
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: base_admin + "/ajax/customer"
            }).then(function (data) {
                $.map(data.data, function (item) {
                    var option = new Option(item.name, item.id, false, false);
                    targetSelect.append(option);
                });
            });
    }
};

$(function() {
	app.init();
});
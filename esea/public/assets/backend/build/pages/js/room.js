var app = app || {};

app.init = function () {

	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    	$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	var table_dynamic_room = $('.table-dynamic-room').DataTable({
		"processing": true,
        "serverSide": true,
		"ajax": base_admin+"/ajax/room",
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
			{"data": "action"}
		],
		'columnDefs': [
			{
				width: '200px',
				targets: [-1],
                orderable: false,
				class: 'text-center'
			},
			{
				width: '300px',
				targets: [-2],
				class: 'text-center'
			},
			{
				width: '100px',
				targets: [0],
				class: 'text-center'
			}
		]		
	});

	$('#RoomForm').validator().on('submit', function (e) {
		$('#RoomBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
            app.RoomFormSubmit(table_dynamic_room);
		} else {
			$('#RoomBtn').button('reset');
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
        app.DeleteRoom(id, table_dynamic_room);
    });

	$(document).on('click', '.table-action-edit, #modal-room .tab_edit_room', function (e) {
		e.preventDefault();
        $('#RoomForm #name').prop('required',false);
        $('#RoomForm #position').prop('required',false);
        $('#RoomForm').validator('validate');
        $('#RoomForm #name').prop('required',true);
        $('#RoomForm #position').prop('required',true);
        $('#RoomForm').validator('update');
        var id = $(this).attr('data-id');
        var lang = $(this).attr('data-lang');
        app.ClearFormRoom(lang, 'edit');
        app.UpdateRoom(id, lang);
	});

	$(document).on('click', '#addRoom', function (e) {
		e.preventDefault();
        var elements = $('.addOption .form-group:not(:last)');
        $.each( elements, function( key, value ) {
            value.remove();
        });
        var last = $('.addOption .form-group');
        last.find('.idaddon').attr('value', "");
        last.find('.nameaddon').attr('value', "");
        last.find('.contentaddon').attr('value', "");
        var lang = $(this).attr('data-lang');
        app.ClearFormRoom(lang, 'add');
        $('#modal-room .tab_edit_room').attr('data-id', 'null');
		$('#modal-room').modal('show');
	});

	$(document).on('click', '#RoomBtn', function (e) {
		e.preventDefault();
		$('#RoomForm').submit();
	});

	$(document).on('click', '.addElement', function (e) {
		var element = $(this).parents('.form-group').clone();
        element.find('.idaddon').attr('value', "");
        element.find('.nameaddon').attr('value', "");
        element.find('.contentaddon').attr('value', "");
		var parent = $(this).parents('.addOption');
		parent.append('<div class="form-group">' + $(element).html() + '</div>');
        parent.find('.form-group:not(:last) .addElement').removeClass('addElement').addClass('removeElement');
        parent.find('.form-group .removeElement').removeClass('fa-plus').addClass('fa-minus');
	});

    $(document).on('click', '.removeElement', function (e) {
        var element = $(this).parents('.form-group');
        element.remove();
    });
    $('.addOption').find('.form-group:not(:last) .addElement').removeClass('addElement').addClass('removeElement');
    $('.addOption').find('.form-group .removeElement').removeClass('fa-plus').addClass('fa-minus');
    $('#modal-room').on('blur', '.nameaddon', function() {
        if($(this).val()) {
            $(this).parent().next().find('.contentaddon').prop('required',true);
            $('#RoomForm').validator('update');
        } else {
            $(this).parent().next().find('.contentaddon').prop('required',false);
            $('#RoomForm').validator('update');
        }
    });
};

app.ClearFormRoom = function(lang, type) {
    if (type == "add") {
        $('#modal-room .nav-tabs').hide();
        $('#modal-room #ttlModal').html('Thêm phòng học mới');
        $('#modal-room #action').val('insert');
    } else {
        $('#modal-room .nav-tabs').show();
        $('#modal-room #ttlModal').html('Cập nhật phòng học');
        $('#modal-room #action').val('update');
    }
    $('#modal-room ul > li').removeClass('active');
    $('#modal-room .tab_edit_room[data-lang=' + lang + ']').parent().addClass('active');
    $('#modal-room #lang').val(lang);
    $('#RoomForm')[0].reset();
};

app.RoomFormSubmit = function(table) {
    $.ajax({
        url: base_admin + "/ajax/room",
        type: "post",
        data: $('#RoomForm').serialize(),
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
                $('#RoomBtn').button('reset');
                $('#modal-room').modal('hide');
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

app.UpdateRoom = function(id, lang) {
    $.ajax({
        url: base_admin + "/ajax/room?lang=" + lang + "&id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.mSchoolClassTranslationsAll !== "undefined") {
                    $.each(response.data.mSchoolClassTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
                            $('#modal-room #id').val(response.data.id);
                            $('#modal-room .tab_edit_room').attr('data-id', response.data.id);
                            $('#modal-room #name').val(v.name);
                            $('#modal-room #position').val(v.position);
                        }
                    });
                }

                var elements = $('.addOption .form-group:not(:last)');
                $.each( elements, function( key, value ) {
                    value.remove();
                });
                var element = $('.addOption .form-group');
                element.find('.idaddon').attr('value', "");
                element.find('.nameaddon').attr('value', "");
                element.find('.contentaddon').attr('value', "");
                element.find('.contentaddon').prop('required',false);
                $('#RoomForm').validator('update');

                if (typeof response.data.mSchoolClassAddons !== "undefined" && response.data.mSchoolClassAddons.length > 0) {
                    var copyelement = $('.addOption .form-group').clone();
                    $.each(response.data.mSchoolClassAddons.reverse(), function(k, v) {
                        copyelement.find('.idaddon').attr('value', v.id);
                        if (typeof v.mSchoolClassAddonTranslationsAll !== "undefined") {
                            $.each(v.mSchoolClassAddonTranslationsAll, function(k, v) {
                                if (lang == v.language_id) {
                                    copyelement.find('.nameaddon').attr('value', v.name);
                                    copyelement.find('.contentaddon').attr('value', v.content);
                                }
                            });
                        }
                        $('.addOption').prepend('<div class="form-group">' + copyelement.html() + '</div>');
                    });
                }
                $('.addOption').find('.form-group:not(:last) .addElement').removeClass('addElement').addClass('removeElement');
                $('.addOption').find('.form-group:last .removeElement').removeClass('removeElement').addClass('addElement');
                $('.addOption').find('.form-group .removeElement').removeClass('fa-plus').addClass('fa-minus');
                $('.addOption').find('.form-group .addElement').removeClass('fa-minus').addClass('fa-plus');
                $('#modal-room').modal('show');
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

app.DeleteRoom = function(id, table) {
    $.ajax({
        url: base_admin + "/ajax/room?action=delete&id=" + id,
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
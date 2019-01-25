var app = app || {};

app.init = function () {

	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

	var table_dynamic_room = $('.table-dynamic-room').DataTable({
		"processing": true,
		"ajax": base_admin + "/ajax/room",
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
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '200px',
				targets: [-1],
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
			},
		]		
	});

	$('#addRoomForm').validator().on('submit', function (e) {
		$('#addRoomBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				app.RoomFormSubmit(table_dynamic_room);
				// setTimeout(function () {
				// 		$('#alert_msg').removeClass('no-display');
				// 		$('#addRoomBtn').button('reset');
				// 		setTimeout(function () {
				// 				$('.alert').addClass('no-display');
				// 		}, 3000);
				// }, 1000);
				$('#addRoomBtn').button('reset');
		} else {
				$('#addRoomBtn').button('reset');
		}
	});
	
	$('#editRoomForm').validator().on('submit', function (e) {
		$('#editRoomBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				setTimeout(function () {
						$('#alert_msg_edit').removeClass('no-display');
						$('#editRoomBtn').button('reset');
						setTimeout(function () {
								$('.alert').addClass('no-display');
						}, 3000);
				}, 1000);
		} else {
				$('#editRoomBtn').button('reset');
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
			app.DeleteRoom(id,table_dynamic_room);
			table.row(row.parents('tr')).remove().draw();
		});
	});

	$(document).on('click', '.table-action-edit,#modal-room .tab_edit', function (e) {
		e.preventDefault();
		var id = $(this).data('id');
		var lang = $(this).attr('data-lang');
		app.ClearFormRoom(lang,'update');
		app.LoadFormRoom(id,lang);
	});

	$(document).on('click', '#addRoom', function (e) {
		e.preventDefault();
		var lang = $(this).attr('data-lang');
		app.ClearFormRoom(lang, 'add');
	});

	$('#modal-room').on('blur', '.nameaddon', function() {
        if($(this).val()) {
            $(this).parent().next().find('.contentaddon').prop('required',true);
            $('#addRoomForm').validator('update');
        }
	});

	$('#modal-room').on('blur', '.contentaddon', function() {
        if($(this).val()) {
            $(this).parent().prev().find('.nameaddon').prop('required',true);
            $('#addRoomForm').validator('update');
        }
	});
	
	$(document).on('click', '#addRoomBtn', function (e) {
		e.preventDefault();
		// $.each($('.inputAddValueOption'), function (index, value) {
		// 	console.log(index + ':' + $(this).val());
		//   });
		$('#addRoomForm').submit();
	});

	$(document).on('click', '#editRoomBtn', function (e) {
		e.preventDefault();
		$('#editRoomForm').submit();
	});

	// $(document).on('click', '.addElement', function (e) {
	// 	var element = $(this).parents('.form-group');
	// 	var parent = $(this).parents('.addOption');
	// 	console.log(element);
	// 	console.log(parent);
	// 	parent.append('<div class="form-group">' + $(element).html() + '</div>');
	// 	parent.find('.form-group:not(:last) .addElement').removeClass('addElement').addClass('removeElement');
	// 	// parent.find('.form-group:not(:last) .addElement').hide();
	// });

	$(document).on('click', '.addElement', function (e) {
		var element = $(this).parents('.form-group').clone();
        element.find('.idaddon').attr('value', "");
        element.find('.nameaddon').attr('value', "");
		element.find('.contentaddon').attr('value', "");
		element.find('.contentaddon').prop('required',false);
		element.find('.nameaddon').prop('required',false);
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
}

app.ClearFormRoom = function(lang, type) {
	$('#addRoomForm')[0].reset();
    if (type == "add") {	
		$('#modal-room .nav-tabs').hide();
		$('#modal-room .modal-title').html('Thêm phòng học mới');
		$('#modal-room #action').val("insert");
		$('#modal-room').modal('show');
    } else {
		$('#modal-room .nav-tabs').show();
		$('#modal-room #action').val("update");
		$('#modal-room .modal-title').html('Cập nhật phòng học');
		$('#modal-room').modal('show');
	}
	var elements = $('.addOption .form-group:not(:last)');
                $.each( elements, function( key, value ) {
                    value.remove();
				});
	$('#modal-room ul > li').removeClass('active');
	$('#modal-room #lang').val(lang);
	$('#modal-room .tab_edit[data-lang=' + lang + ']').parent().addClass('active');
}

app.RoomFormSubmit = function(table) {
    $.ajax({
        url: base_admin + "/ajax/room",
        type: "post",
        data: $('#addRoomForm').serialize(),
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
				$('#modal-room').modal('hide');
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

app.LoadFormRoom = function(id, lang) {
    $.ajax({
        url: base_admin + "/ajax/room?lang=" + lang + "&id=" + id,
        type: "get",
        success: function(response) {
            if (response.code == '200') {
                if (typeof response.data.mSchoolClassTranslationsAll !== "undefined") {
                    $.each(response.data.mSchoolClassTranslationsAll, function(k, v) {
                        if (lang == v.language_id) {
                            $('#modal-room #id').val(response.data.id);
                            $('#modal-room .tab_edit').attr('data-id', response.data.id)			
							$('#modal-room #inputAddName').val(v.name);
							$('#modal-room #inputAddPosition').val(v.position);
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
}

$(function() {
	app.init();
});
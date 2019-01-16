var app = app || {};

app.init = function () {
    var table_dynamic_district, table_dynamic_ward;
	$('.select2').select2();

	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    	$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

    $(document).on('show.bs.tab', 'a[href="#tab_district"]', function (e) {
        table_dynamic_district.ajax.reload(null, true);
    });

    $(document).on('show.bs.tab', 'a[href="#tab_ward"]', function (e) {
        table_dynamic_ward.ajax.reload(null, true);
    });

	var table_dynamic_place = $('.table-dynamic-place').DataTable({
		"processing": true,
        "serverSide": true,
        "ajax": base_admin + "/ajax/place",
		'responsive': true,
		'paging': true,
		'lengthChange': true,
		'searching': true,
		'ordering': true,
		'info': true,
		'autoWidth': true,
		'scrollX': true,
		'scrollCollapse': true,
        'order': [[0, 'desc']],
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
				width: '100px',
				targets: [0],
				class: 'text-center'
			},
			{
				width: '200px',
				targets: [-1],
				orderable: false,
				class: 'text-center'
			}
		]
	});

	$('#addCityForm').validator().on('submit', function (e) {
		$('#addCityBtn').button('loading');
        $('#addCityForm .table').val('city');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
            e.preventDefault();
            app.submitForm('#listPlace', table_dynamic_place, '#addCityForm', '#addCityBtn');
            $('#modal-city-add').modal('hide');
            $('#addCityBtn').button('reset');
		} else {
			$('#addCityBtn').button('reset');
		}
	});

	$('#editCityForm').validator().on('submit', function (e) {
		$('#editCityBtn').button('loading');
        $('#editCityForm .table').val('city');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
			e.preventDefault();
            app.submitForm('#listPlace', table_dynamic_place, '#editCityForm', '#editCityBtn');
            $('#modal-city-edit').modal('hide');
            $('#editCityBtn').button('reset');
		} else {
			$('#editCityBtn').button('reset');
		}
	});

    $('#DistrictForm').validator().on('submit', function (e) {
        $('#DistrictBtn').button('loading');
        $('#DistrictForm .table').val('district');
        $('.alert').addClass('no-display');
        if (!e.isDefaultPrevented()) {
            e.preventDefault();
            app.submitForm('#tab_district', table_dynamic_district, '#DistrictForm', '#DistrictBtn');
            $('#modal-district').modal('hide');
            $('#DistrictBtn').button('reset');
        } else {
            $('#DistrictBtn').button('reset');
        }
    });

	$('#WardForm').validator().on('submit', function (e) {
		$('#WardBtn').button('loading');
        $('#WardForm .table').val('ward');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
            e.preventDefault();
            app.submitForm('#tab_ward', table_dynamic_ward, '#WardForm', '#WardBtn');
            $('#modal-ward').modal('hide');
            $('#WardBtn').button('reset');
		} else {
            $('#WardBtn').button('reset');
		}
	});

	$(document).on('click', '.table-dynamic-place .table-action-delete', function (e) {
		e.preventDefault();
        app.clearForm('#editCityForm', 'delete');
        $('#editCityForm .id').val($(this).data('id'));
        $('#editCityForm .table').val('city');
        $('#confirm-delete-modal #module').val('city');
		$('#confirm-delete-modal').modal({
            backdrop: 'static',
            keyboard: false
		});
	});

    $(document).on('click', '.table-dynamic-district .table-action-delete', function (e) {
        e.preventDefault();
        app.clearForm('#DistrictForm', 'delete');
        $('#DistrictForm .id').val($(this).data('id'));
        $('#DistrictForm .table').val('district');
        $('#confirm-delete-modal #module').val('district');
        $('#confirm-delete-modal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });

    $(document).on('click', '.table-dynamic-ward .table-action-delete', function (e) {
        e.preventDefault();
        app.clearForm('#WardForm', 'delete');
        $('#WardForm .id').val($(this).data('id'));
        $('#WardForm .table').val('ward');
        $('#confirm-delete-modal #module').val('ward');
        $('#confirm-delete-modal').modal({
            backdrop: 'static',
            keyboard: false
        });
    });

    $('#confirm-delete-modal').on('click', '#confirm-delete', function (e) {
        var table = $('#confirm-delete-modal #module').val();
        switch (table) {
            case 'city':
                app.submitForm('#listPlace', table_dynamic_place, '#editCityForm', '#editCityBtn');
                break;
            case 'district':
                app.submitForm('#tab_district', table_dynamic_district, '#DistrictForm', '#DistrictBtn');
                break;
            default:
                app.submitForm('#tab_ward', table_dynamic_ward, '#WardForm', '#WardBtn');
        }
        $('#confirm-delete-modal').modal('hide');
    });

	$(document).on('click', '.table-dynamic-place .table-action-edit', function (e) {
		e.preventDefault();
        app.clearForm('#editCityForm', 'update');
		var id = $(this).data('id');
		$('#city_id').val(id);
        $.ajax({
            url: base_admin + "/ajax/place?id=" + id + "&type=detail",
            type: "get",
            success: function (response) {
                if (response.code == '200') {
                    $('#editCityForm .id').val(response.data.id);
                    $('#editCityForm .name').val(response.data.name);
                    $('#modal-city-edit').modal('show');
                } else {
                    $('#error-modal').modal('show');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
            }
        });
        table_dynamic_district = $('.table-dynamic-district').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": base_admin + "/ajax/place?id=" + id + "&type=district",
            'responsive': true,
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            'scrollX': true,
            'scrollCollapse': true,
            'destroy': true,
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
                    width: '100px',
                    targets: [0],
                    class: 'text-center'
                },
                {
                    width: '200px',
                    targets: [-1],
                    orderable: false,
                    class: 'text-center'
                }
            ]
        });
        table_dynamic_ward = $('.table-dynamic-ward').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": base_admin + "/ajax/place?id=" + id + "&type=ward",
            'responsive': true,
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            'scrollX': true,
            'scrollCollapse': true,
            'destroy': true,
            "columns": [
                {"data": "id"},
                {"data": "district"},
                {"data": "name"},
                {"data": "action"}
            ],
            'columnDefs': [
                {
                    targets: [1],
                    class: 'text-ellipsis'
                },
                {
                    width: '300px',
                    targets: [2],
                    class: 'text-center'
                },
                {
                    width: '100px',
                    targets: [0],
                    class: 'text-center'
                },
                {
                    width: '200px',
                    targets: [-1],
                    orderable: false,
                    class: 'text-center'
                }
            ]
        });
        $("#district_id").select2({
            placeholder: "Chọn quận/huyện",
            allowClear: true,
            delay: 250,
            ajax: {
                url: base_admin + "/ajax/place?id=" + id + "&type=district",
                dataType: 'json',
                type: "GET",
                processResults: function (data) {
                    return {
                        results: $.map(data.data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
	});

	$(document).on('click', '#addCity', function (e) {
        $('#addCityForm')[0].reset();
		e.preventDefault();
        app.clearForm('#modal-city-add', 'insert');
		$('#modal-city-add').modal('show');		
	});

	$(document).on('click', '#addDistrict', function (e) {
        $('#DistrictForm')[0].reset();
        $('#DistrictForm .table').val('district');
        $('#modal-district .ttlModal').html('Thêm quận mới');
		e.preventDefault();
        app.clearForm('#modal-district', 'insert');
		$('#modal-district').modal('show');
	});

	$(document).on('click', '#addWard', function (e) {
        $('#WardForm')[0].reset();
        $('#modal-ward .ttlModal').html('Thêm phường mới');
		e.preventDefault();
        app.clearForm('#modal-ward', 'insert');
		$('#modal-ward').modal('show');
		$('#WardForm #district_id').empty();
	});

	$(document).on('click', '.table-dynamic-district .table-action-edit', function (e) {
        $('#DistrictForm .name').prop('required',false);
        $('#DistrictForm').validator('validate');
        $('#DistrictForm .name').prop('required',true);
        $('#DistrictForm').validator('update');
        $('#modal-district .ttlModal').html('Cập nhật quận');
        e.preventDefault();
        app.clearForm('#DistrictForm', 'update');
        var id = $(this).data('id');
        $.ajax({
            url: base_admin + "/ajax/place?id=" + id + "&table=district",
            type: "get",
            success: function (response) {
                if (response.code == '200') {
                    $('#DistrictForm .id').val(response.data.id);
                    $('#DistrictForm .name').val(response.data.name);
                    $('#modal-district').modal('show');
                } else {
                    $('#error-modal').modal('show');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
            }
        });

		$('#modal-district').modal('show');
	});

	$(document).on('click', '.table-dynamic-ward .table-action-edit', function (e) {
        $('#WardForm .name').prop('required',false);
        $('#WardForm').validator('validate');
        $('#WardForm .name').prop('required',true);
        $('#WardForm').validator('update');
        $('#modal-ward .ttlModal').html('Cập nhật phường');
		e.preventDefault();
        app.clearForm('#WardForm', 'update');
        var id = $(this).data('id');
        $.ajax({
            url: base_admin + "/ajax/place?id=" + id + "&table=ward",
            type: "get",
            success: function (response) {
                if (response.code == '200') {
                    $('#WardForm .id').val(response.data.id);
                    $('#WardForm .name').val(response.data.name);
                    $("#WardForm #district_id").select2("trigger", "select", {
                        data: { id: response.data.district_id, text: response.data.configDistrict.name }
                    });
                    $('#modal-ward').modal('show');
                } else {
                    $('#error-modal').modal('show');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
            }
        });
		$('#modal-ward').modal('show');
	});

	$(document).on('click', '#addCityBtn', function (e) {
		e.preventDefault();
		$('#addCityForm').submit();
	});

	$(document).on('click', '#editCityBtn', function (e) {
		e.preventDefault();
		$('#editCityForm').submit();
	});

    $(document).on('click', '#DistrictBtn', function (e) {
        e.preventDefault();
        $('#DistrictForm').submit();
    });

	$(document).on('click', '#WardBtn', function (e) {
		e.preventDefault();
		$('#WardForm').submit();
	});
}

app.submitForm = function (content, table, form, button) {
    $.ajax({
        url: base_admin + "/ajax/place",
        data: $(form).serialize(),
        type: "post",
        success: function (response) {
            if (response.code == '200') {
                table.ajax.reload(null, true);
                $(content + ' > #error_msg').hide();
                $(content + ' > .row #alert_msg').removeClass('no-display').find('span').html(response.msg);
                $(button).button('reset');
            } else {
                $(content + ' > #error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $(content + ' > #error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
        }
    });
}

app.clearForm = function (modal, action) {
    $(modal + ' .action').val(action);
    $(modal + ' .id').val('');
    $(modal + ' .name').val('');
}

$(function() {
	app.init();
});
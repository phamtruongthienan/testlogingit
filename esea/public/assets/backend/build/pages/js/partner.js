var app = app || {};
var table_dynamic_partner;

app.init = function () {
	changeImage('#logoImage', 'input[id="logo"]', '#PartnerForm');
	$('[data-mask]').inputmask();
    $('.select2').select2();
	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
    	$.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
	});

    autocompleteSchool(".single-select2", base_admin+"/ajax/client/school");

	$('#modal-client').on( 'show.bs.modal', function (e) {
		if ($('input[type="checkbox"]').length > 0) {
			$('input[type="checkbox"]').iCheck({
				checkboxClass: 'icheckbox_minimal-blue'
			});
		}
	});

	table_dynamic_partner = $('.table-dynamic-partner').DataTable({
		"processing": true,
        "serverSide": true,
		"ajax": base_admin+"/ajax/client",
		'responsive': true,
		'paging': true,
		'lengthChange': true,
		'searching': true,
		'ordering': true,
		'info': true,
		'autoWidth': true,
		'scrollX': true,
		'scrollCollapse': true,
        'order': [[6, 'desc']],
		"columns": [
			{"data": "id"},
			{"data": "name"},
			{"data": "address"},
			{"data": "email"},
			{"data": "phone"},
			{"data": "status"},
			{"data": "sort"},
			{"data": "action"}
		],
		'columnDefs': [
			{
				targets: [1],
				class: 'text-ellipsis'
			},
			{
				width: '150px',
				targets: [3, 4, 5, 6],
				class: 'text-center'
			},
			{
				width: '100px',
				targets: [0],
				class: 'text-center'
			},
			{
				width: '300px',
				targets: [2],
				class: 'text-ellipsis'
			},
			{
				width: '200px',
				targets: [-1],
				class: 'text-center'
			}
		],
		'drawCallback': function(){
            $('.table-dynamic-partner tr:nth-child(1) .upBtn').remove();
			$('.table-dynamic-partner tr:last .downBtn').remove();
			$('.upBtn').unbind('click');
			$('.downBtn').unbind('click');
			$('.upBtn').on('click', function(){
				app.moveUp($(this));
			});
			$('.downBtn').on('click', function(){
				app.moveDown($(this));
			});
		}
	});

	$('#PartnerForm').validator().on('submit', function (e) {
		$('#PartnerBtn').button('loading');
		$('.alert').addClass('no-display');
		if (!e.isDefaultPrevented()) {
				e.preventDefault();
				app.submitForm(table_dynamic_partner);
				$('#modal-client').modal('hide');
				$('#PartnerBtn').button('reset');
		} else {
				$('#PartnerBtn').button('reset');
		}
	});

	$(document).on('click', '.table-action-delete', function (e) {
		e.preventDefault();
        app.clearForm('delete');
        $('#modal-client #id').val($(this).data('id'));
		$('#confirm-delete-modal').modal({
			backdrop: 'static',
			keyboard: false
		});
	});

    $('#confirm-delete-modal').on('click', '#confirm-delete', function (e) {
        app.submitForm(table_dynamic_partner);
        $('#confirm-delete-modal').modal('hide');
    });

	$(document).on('click', '.table-dynamic-partner .table-action-edit', function (e) {
	    $('#ttlModal').html('Cập nhật đối tác mới');
		e.preventDefault();
        app.clearForm('update');
		var id = $(this).data('id');
        $.ajax({
            url: base_admin + "/ajax/client?id=" + id,
            type: "get",
            success: function (response) {
                if (response.code == '200') {
                    $('#modal-client #id').val(response.data.id);
                    $('#modal-client #name').val(response.data.mClientTranslations[0].name);
                    $('#modal-client #address').val(response.data.mClientTranslations[0].address);
                    $('#modal-client #email').val(response.data.mClientTranslations[0].email);
                    $('#modal-client #phone').val(response.data.mClientTranslations[0].phone);
                    $('#modal-client #fax').val(response.data.mClientTranslations[0].fax);
                    $('#modal-client #website').val(response.data.mClientTranslations[0].website);
                    $('#modal-client #school_name').val(response.data.mClientTranslations[0].mSchool.mSchoolTranslations[0].name);
                    $('#modal-client #school_id').val(response.data.id);
                    $('#modal-client #job').val(response.data.mClientTranslations[0].job);
                    $('#modal-client #content').summernote('code', response.data.mClientTranslations[0].content);
                    $('#modal-client #investment').val(response.data.mClientTranslations[0].investment);
                    $('#modal-client #staff').val(response.data.mClientTranslations[0].staff);
                    if(response.data.mClientTranslations[0].logo != null) {
                        $('#modal-client #logoImage').attr('src', base_url+'/img/'+response.data.mClientTranslations[0].logo)
                    }
                    if(response.data.status == 1) {
                        $('#modal-client #status').iCheck('check');
                    } else {
                        $('#modal-client #status').iCheck('uncheck');
                    }
                    $('#modal-client').modal('show');
                } else {
                    $('#error-modal').modal('show');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
            }
        });
	});

	$(document).on('click', '#addPartner', function (e) {
        $('#ttlModal').html('Thêm đối tác mới');
		e.preventDefault();
        app.clearForm('insert');
		$('#modal-client').modal('show');
	});

	$(document).on('click', '#PartnerBtn', function (e) {
		e.preventDefault();
		$('#PartnerForm').submit();
	});
}

app.moveUp = function (element) {
    var fid = element.data('id');
    var tr = element.parents('tr');
    $.ajax({
        url: base_admin + "/ajax/client?action=update&up=1&id=" + fid,
        type: "post",
        success: function (response) {
            app.moveRow(tr, 'up');
            table_dynamic_partner.ajax.reload(null, false);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
        }
    });
}

app.moveDown = function (element) {
    var fid = element.data('id');
    var tr = element.parents('tr');
    $.ajax({
        url: base_admin + "/ajax/client?action=update&down=1&id=" + fid,
        type: "post",
        success: function (response) {
            app.moveRow(tr, 'down');
            table_dynamic_partner.ajax.reload(null, false);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
        }
    });
}

app.moveRow = function (row, direction) {
    var index = table_dynamic_partner.row(row).index();

    var order = -1;
    if (direction === 'down') {
        order = 1;
    }

    var data1 = table_dynamic_partner.row(index).data();
    data1.sort += order;

    var data2 = table_dynamic_partner.row(index + order).data();
    data2.sort += -order;

    table_dynamic_partner.row(index).data(data2);
    table_dynamic_partner.row(index + order).data(data1);

    table_dynamic_partner.draw(false);
}

app.submitForm = function (table_dynamic_partner) {
    $.ajax({
        url: base_admin + "/ajax/client",
        data: $('#PartnerForm').serialize(),
        type: "post",
        success: function (response) {
            if (response.code == '200') {
                table_dynamic_partner.ajax.reload(null, true);
                $('#error_msg').hide();
                $('#alert_msg').removeClass('no-display').find('span').html(response.msg);
                $('#PartnerBtn').button('reset');
            } else {
                $('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#error_msg').html('<i class="fas fa-exclamation-triangle"></i> ' + response.msg).show();
        }
    });
}

app.clearForm = function (action) {
    $('#modal-client #action').val(action);
    $('#modal-client #id').val('');
    $('#modal-client #name').val('');
    $('#modal-client #address').val('');
    $('#modal-client #email').val('');
    $('#modal-client #phone').val('');
    $('#modal-client #fax').val('');
    $('#modal-client #website').val('');
    $('#modal-client #school_name').val('');
    $('#modal-client #school_id').val('');
    $('#modal-client #job').val('');
    $('#modal-client #content').summernote('code', '');
    $('#modal-client #investment').val('');
    $('#modal-client #staff').val('');
    $('#modal-client #logoImage').attr('src', base_url+'/assets/backend/img/no_image.png');
    $('#modal-client #image_hash').val('');
    $('#modal-client #status').iCheck('uncheck');
}

$(function() {
	app.init();
});